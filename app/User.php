<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * このユーザが所有する投稿
     */
    public function musics()
    {
        return $this->hasMany(Music::class);
    }

    /**
     * 管理者かどうかを判断する
     */
    public function isAdmin()
    {
        if ($this->role == '0'){
            return false;
        } else {
            return $this->role;
        }
    }

    /**
     * ユーザの一覧を取得する
     */
    public function getUsers(Request $req)
    {
        $users = DB::table('users');

        // id欄に入力あり
        if (isset($req->id) && ($req->id != '')){
            $users->where('id', '=', $req->id);
        }

        // name欄に入力あり
        if (isset($req->name) && ($req->name != '')){
            $users->where('name', 'like', "%$req->name%");
        }

        // email欄に入力あり
        if (isset($req->email) && ($req->email != '')){
            $users->where('email', 'like', "%$req->email%");
        }

        $result = $users->orderBy('id')->paginate(10);

        return $result;
    }
}
