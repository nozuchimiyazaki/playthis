<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Music;

use DB;

class MusicsController extends Controller
{
    /**
     * トップページの一覧を表示
     */
    public function index()
    {
        $musics = Music::orderBy('created_at', 'desc')->take(20)->get();

        $search = '最新20件';
        $order = '新着順';

        $data = [
            'search' => $search,
            'order' => $order,
            'musics' => $musics,
        ];

        // トップページ表示
        return view('welcome', $data);
    }

    /**
     * 曲の詳細情報表示
     */
    public function show($id)
    {
        $music = \App\Music::findOrFail($id);

        foreach($music->comments as $comment) {
            if (is_null($comment->user_id)){
                $comment->username = 'ゲスト';
                $comment->email = 'dummy@dummy.com';
            } else {
                $comm = \App\User::findOrFail($comment->user_id);
                $comment->username = $comm->name;
                $comment->email = $comm->email;
            }
        }

        return view('musics.show', ['music' => $music]);
    }

    /**
     * 新規曲投稿ページ表示
     */
    public function create()
    {
        // ジャンルマスタ取得
        $genres = \App\Genre::orderBy('order', 'asc', 'id', 'asc')->get();

        // プレイスタイルマスタ取得
        $styles = \App\Style::orderBy('order', 'asc', 'id', 'asc')->get();

        $data = [
            'genres' => $genres,
            'styles' => $styles,
        ];
        return view('musics.new', $data);
    }

    /**
     * 新規曲を保存
     */
    public function store(Request $req)
    {
        // バリデーション
        $req->validate([
            'music_name' => 'required|max:255',
            'artist' => 'required|max:255',
            'album' => 'max:255',
            'url1' => 'max:255',
            'url2' => 'max:255',
            'url3' => 'max:255',
        ]);

        // print_r($req->checkGenre);
        // var_dump($req->checkGenre);
        // exit();
        // トランザクション開始
        DB::beginTransaction();

        try{
            // 認証済みユーザの投稿として保存
            $music = $req->user()->musics()->create([
                'music_name' => $req->music_name,
                'artist' => $req->artist,
                'album' => $req->album,
                'level' => $req->radiolevel,
                'explanation' => $req->explanation,
                'search_music_name' => $this->cnvSearchStrings($req->music_name),
                'search_artist' => $this->cnvSearchStrings($req->artist),
                'search_album' => $this->cnvSearchStrings($req->album),
                'search_texts' => $this->cnvSearchStrings($req->music_name . $req->artist . $req->album . $req->explanation),

            ]);

            // ジャンル保存
            foreach($req->checkGenre as $genre){
                $music->genres()->attach($genre);
            }

            // プレイスタイル保存
            foreach($req->checkStyle as $style){
                $music->styles()->attach($style);
            }

            // YouTube URL保存
            for ($i=0;$i<3;$i++){
                if (!is_null($req->{"url" . $i}) && ($req->{"url" . $i} !== '')){
                    $music->movies()->create([
                        'url' => $req->{"url" . $i},
                    ]);
                }
            }

        }catch(Exception $e){
            // ロールバック
            DB::rollback();
            return back();
        }
        // トランザクションコミット
        DB::commit();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * コメント投稿
     */
    public function commentstore(Request $req, $music_id){
        $music = Music::findOrFail($music_id);

        $music->comments()->create([
            'user_id' => \Auth::id(),
            'comment_text' => $req->comment_text,
        ]);

        // 前のURLへリダイレクトする
        return back();
    }


    /**
     * 検索用項目文字列生成
     *
     * 空白文字の除去、英文字を半角英小文字に統一
     */
    public function cnvSearchStrings($str)
    {
        return $str;
    }
}
