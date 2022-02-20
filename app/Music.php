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
        $levels = [
            '0' => '低',
            '1' => '中',
            '2' => '高',
            '9' => '最高',
        ];
        return $levels[$this->level];
    }

}
