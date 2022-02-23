<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use DB;

/**
 * ユーザ選択条件格納用
 */
class Conditions {
    public $id;
    public $name;
    public $email;
}

class AdminController extends Controller
{
    use AuthenticatesUsers;

    /**
     * 管理者ログインフォーム表示
     */
    public function showAdminLoginForm()
    {
        return view('admin.login');
    }

    /**
     * 管理者ログイン処理：
     */
    public function adminLogin(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);

    }

    /**
     * 管理者メニュー表示
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * ユーザ選択ページ表示
     */
    public function showUsers(Request $req)
    {
        //
        // フォームで指定された条件でユーザを取得
        //
        $users = new \App\User();
        $usersList = $users->getUsers($req);

        //
        // フォームに渡す検索条件を格納
        //
        $conditions = New Conditions;
        $conditions->id = $req->id;

        $data = [
            'users' => $usersList,                      // ユーザ一覧
            'conditions' => $conditions,                // ユーザ検索条件
            'result_count' => $usersList->total(),      // ユーザ一覧総件数
        ];

        return view('admin.users', $data);

    }

    /**
     * ユーザ情報編集ページ（管理者用）表示
     */
    public function editUser($id)
    {
        //
        // 編集対象データを取得
        //
        $user = \App\User::findOrFail($id);

        return view('admin.user',['user' => $user]);
    }

    /**
     * ユーザ情報更新
     */
    public function updateUser(Request $req, $id)
    {
        //
        // バリデーション
        //
        $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',"unique:users,email,$id"],
            'password' => ['present','string', 'min:4', 'confirmed'],
        ]);

        //
        // 編集対象データを取得
        //
        $user = \App\User::findOrFail($id);

        //
        // ユーザ情報保存
        //
        $user->update([
            'name' => $req->name,
            'email' => $req->email,
            'profile' => $req->profile,
            'role' => $req->radioRole,
        ]);

        //
        // パスワードの変更
        //
        if (!is_null($user->password) && ($user->password !== '')){
            $user->update([
                'password' => Hash::make($req->password),
            ]);
        }

        return back()->with('result', '１件更新されました。');
    }

    /**
     * プレイスタイル登録フォーム表示
     */
    public function editStyles()
    {
        //
        // プレイスタイルを全件取得
        //
        $styles = \App\Style::orderBy("order")->orderBy('id')->get();

        return view('admin.styles', ['styles' => $styles]);
    }

    /**
     * プレイスタイル登録
     */
    public function saveStyle(Request $req)
    {
        $msg = '';

        //
        // バリデーション
        //
        $req->validate([
            'name' => 'required|max:255',
            'order' => 'required|integer|max:255',
        ]);


        if ((isset($req->id)) && ($req->id != '')){
            // id欄に値がある場合：
            if (isset($req->delete)){
                //
                // ToDo: 削除処理を記述
                // 既に当該スタイルを利用されている場合は削除不可
                //
                $msg = '1件削除しました。';
            } else {
                //
                // データ更新
                //
                $style = \App\Style::findOrFail($req->id);
                $style->update([
                    'name' => $req->name,
                    'order' => $req->order,
                ]);
                $msg = '1件更新しました。';
            }

        } else {
            //
            // 追加処理
            //
            \App\Style::create([
                'name' => $req->name,
                'order' => $req->order,
            ]);
            $msg = '1件追加しました。';
        }

        return back()->with('result', $msg);
    }
}
