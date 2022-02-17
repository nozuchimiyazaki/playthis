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
        $genres = \App\Genre::orderByRaw("`order` asc, id asc")->get();

        // プレイスタイルマスタ取得
        $styles = \App\Style::orderByRaw("`order` asc, id asc")->get();

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
                if (!is_null($req->{"url" . ($i+1)}) && ($req->{"url" . ($i+1)} !== '')){
                    $music->movies()->create([
                        'url' => $req->{"url" . ($i+1)},
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
        return redirect('/')->with('result', '１件追加されました。');
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
     * 曲編集ページを表示
     */
    public function edit($music_id)
    {
        $music = Music::findOrFail($music_id);

        // YouTube URL取得
        $cnt = 1;
        foreach($music->movies as $movie){
            if ($cnt > 3){
                break;
            }
            $music->{'url'.$cnt} = $movie->url;
            $cnt++;
        }
        // ジャンルマスタ取得
        $genres = \App\Genre::orderByRaw("`order` asc, id asc")->get();
        // ジャンル入力値取得
        foreach($genres as $genre){
            $genre->selected = false;
            foreach($music->genres as $inputGenre){
                if ($genre->id == $inputGenre->id){
                    $genre->selected = true;
                    break;
                }
            }
        }

        // プレイスタイルマスタ取得
        $styles = \App\Style::orderByRaw("`order` asc, id asc")->get();
        // プレイスタイル入力値取得
        foreach($styles as $style){
            $style->selected = false;
            foreach($music->styles as $inputStyle){
                if ($style->id == $inputStyle->id){
                    $style->selected = true;
                    break;
                }
            }
        }

        $data = [
            'music' => $music,
            'genres' => $genres,
            'styles' => $styles,
        ];
        return view('musics.edit', $data);
    }

    /**
     * 曲を更新する
     */
    public function update(Request $req, $music_id)
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

        // トランザクション開始
        DB::beginTransaction();

        try{
            // 編集対象データを取得
            $music = Music::findOrFail($music_id);

            // 投稿として保存
            $music->update([
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
            $genres = \App\Genre::OrderBy('id')->get();
            foreach($genres as $genre){
                $flgSaveGenre = false;
                $flgInputGenre = false;
                // 曲-ジャンルテーブルに当該ジャンルのデータがあるか？
                foreach($music->genres as $saveGenre){
                    if ($genre->id === $saveGenre->id){
                        $flgSaveGenre = true;
                        break;
                    }
                }
                // 編集ページからの入力に当該ジャンルのチェックはあるか？
                foreach($req->checkGenre as $inputGenre){
                    if ($genre->id === (int)$inputGenre){
                        $flgInputGenre = true;
                        break;
                    }
                }

                if (($flgSaveGenre) && ($flgInputGenre)){
                    // 共にある場合：なにもしない（すでにレコードはある）
                }
                if ((!$flgSaveGenre) && ($flgInputGenre)){
                    // テーブルにレコードがなく、入力でチェックされている場合：レコード追加
                    $music->genres()->attach($genre->id);
                }
                if (($flgSaveGenre) && (!$flgInputGenre)){
                    // テーブルにレコードがあり、入力でチェックされていない場合：該当レコード削除
                    $music->genres()->detach($genre->id);
                }
                if ((!$flgSaveGenre) && (!$flgInputGenre)){
                    // 共にない場合：なにもしない（レコードもない）
                }
            }

            // プレイスタイル保存
            $styles = \App\Style::OrderBy('id')->get();
            foreach($styles as $style){
                $flgSaveStyle = false;
                $flgInputStyle = false;
                // 曲-スタイルテーブルに当該スタイルのデータがあるか？
                foreach($music->styles as $saveStyle){
                    if ($style->id === $saveStyle->id){
                        $flgSaveStyle = true;
                        break;
                    }
                }
                // 編集ページからの入力に当該スタイルのチェックはあるか？
                foreach($req->checkStyle as $inputStyle){
                    if ($style->id === (int)$inputStyle){
                        $flgInputStyle = true;
                        break;
                    }
                }

                if (($flgSaveStyle) && ($flgInputStyle)){
                    // 共にある場合：なにもしない（すでにレコードはある）
                }
                if ((!$flgSaveStyle) && ($flgInputStyle)){
                    // テーブルにレコードがなく、入力でチェックされている場合：レコード追加
                    $music->styles()->attach($style->id);
                }
                if (($flgSaveStyle) && (!$flgInputStyle)){
                    // テーブルにレコードがあり、入力でチェックされていない場合：該当レコード削除
                    $music->styles()->detach($style->id);
                }
                if ((!$flgSaveStyle) && (!$flgInputStyle)){
                    // 共にない場合：なにもしない（レコードもない）
                }
            }

            // YouTube URL保存
            for ($i=0;$i<3;$i++){
                $flgSaveUrl = false;
                $flgInputUrl = false;

                // 曲-動画テーブルに当該番目のデータがあるか？
                if (isset($music->movies[$i]->url)){
                    $flgSaveUrl = true;
                }
                // 編集ページからの入力に値はあるか？
                if (!is_null($req->{"url" . ($i+1)}) && ($req->{"url" . ($i+1)} !== '')){
                    $flgInputUrl = true;
                }

                if (($flgSaveUrl) && ($flgInputUrl)){
                    // テーブルにレコードがあり、入力欄に入力ありの場合：
                    if ($music->movies[$i]->url !== $req->{"url" . $i}){
                        $music->movies[$i]->update([
                            'url' => $req->{"url" . ($i+1)},
                        ]);
                    }
                }
                if ((!$flgSaveUrl) && ($flgInputUrl)){
                    // テーブルにレコードがなく、入力欄に入力ありの場合：レコード追加
                    $music->movies()->create([
                        'url' => $req->{"url" . ($i+1)},
                    ]);
                }
                if (($flgSaveUrl) && (!$flgInputUrl)){
                    // テーブルにレコードがあり、入力欄に入力なしの場合：レコード削除
                    $music->movies[$i]->delete();
                }
                if ((!$flgSaveUrl) && (!$flgInputUrl)){
                    // テーブルにレコードがなく、入力欄に入力なしの場合：なにもしない
                }
            }

        }catch(Exception $e){
            // ロールバック
            DB::rollback();
            return back();
        }
        // トランザクションコミット
        DB::commit();

        // 詳細ページへリダイレクトさせる
        return redirect('musics/' . $music_id . '/')->with('result', '１件更新されました。');

    }


    /**
     * 検索用項目文字列生成
     *
     * 空白文字の除去、英文字を半角英小文字に統一
     */
    public function cnvSearchStrings($str)
    {
        $str = mb_convert_kana($str, "KVas");   // 半角カタカナを全角カタカナへ（濁点考慮）、全角英数字を半角英数字へ、全角スペースを半角スペースへ変換
        $str = mb_strtolower($str);             // 英小文字へ変換
        $str = str_replace(" ","",$str);        // 半角空白削除
        return $str;
    }
}
