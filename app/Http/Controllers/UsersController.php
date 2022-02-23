<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;

class UsersController extends Controller
{
    //
    /**
     * ユーザ情報編集ページを表示
     */
    public function edit($id)
    {
        $login = User::findOrFail(\Auth::id());

        // 認証ユーザが編集しようとしているユーザと同一であること
        if ((\Auth::id() == $id) || ($login->isAdmin())){

        } else {
            // ToDo: 'result'ではなく、$errorsにメッセージを返したい
            return back()->with('result', '編集する権限がありません');
        }

        // ユーザ情報取得
        $user = User::findOrFail($id);

        return view('users.edit',['user' => $user]);
    }

    /**
     * ユーザ情報更新
     */
    public function update(Request $req, $id)
    {
        //
        // バリデーション
        //
        $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',"unique:users,email,$id"],
            'password' => ['present','string', 'min:4', 'confirmed'],
            // ToDo: 'nowpassword' パスワード欄に入力がある場合必須で現在のパスワードと合致していること
        ]);

        //
        // 編集対象データを取得
        //
        $user = User::findOrFail($id);

        // ユーザ情報保存
        //
        $user->update([
            'name' => $req->name,
            'email' => $req->email,
            'profile' => $req->profile,
        ]);

        // パスワードの変更
        if (!is_null($user->password) && ($user->password !== '')){
            $user->update([
                'password' => Hash::make($req->password),
            ]);
        }

        return back()->with('result', '１件更新されました。');
    }

}
