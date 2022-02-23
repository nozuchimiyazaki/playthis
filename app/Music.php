<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    // テーブル名を指定
    protected $table = 'musics';

    /**
     *
     */
    protected $fillable = [
        'music_name',
        'artist',
        'album',
        'level',
        'explanation',
        'search_music_name',
        'search_artist',
        'search_album',
        'search_texts',
    ];

    /**
     * レベルテーブル
     */
    protected $arrLevels = [
        '0' => '低',
        '1' => '中',
        '2' => '高',
        '9' => '最高',
    ];

    /**
     * この曲を投稿したユーザ
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * この曲の動画
     */
    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    /**
     * この曲が持つコメント
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at','desc');
    }

    /**
     * この曲につけられた「いいね」
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * この曲のジャンル
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'music_genre' ,'music_id', 'genre_id')->withTimestamps();
    }

    /**
     * この曲のプレイスタイル
     */
    public function styles()
    {
        return $this->belongsToMany(Style::class, 'music_style', 'music_id', 'style_id');
    }

    /**
     * この曲のレベル
     */
    public function getLevelNameAttribute()
    {
        return $this->getLevelName($this->level);
    }

    /**
     * レベルidからレベル名を取得
     */
    public function getLevelName($level){
        return $this->arrLevels[$level];
    }

    /**
     *  投稿曲一覧を取得する際のベースとなるクエリを返す
     */
    public function musicListQuery()
    {
        $columns = [
            'musics.id as musicid',
            'music_name',
            'artist',
            'level',
            'explanation',
            'musics.user_id as userid',
            'users.name as username',
            'users.email as email',
            'comments_count' => function ($query_comments) {
                $query_comments
                    ->selectRaw('count(*)')
                    ->from('comments')
                    ->whereRaw('musics.id = comments.music_id');
            },
            'likes_count' => function ($query_likes) {
                $query_likes
                    ->selectRaw('count(*)')
                    ->from('likes')
                    ->whereRaw('musics.id = likes.music_id');
            },
        ];

        return Music::select($columns)
                ->leftJoin('users', 'musics.user_id', '=', 'users.id')
                ->leftJoin('music_genre', 'musics.id', '=', 'music_genre.music_id')
                ->leftJoin('music_style', 'musics.id', '=', 'music_style.music_id')
                ->groupBy('musics.id');
                // ->orderByRaw("`musics`.`created_at` desc, `musics`.`id` asc")->paginate(10);

    }

}
