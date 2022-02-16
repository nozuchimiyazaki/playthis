<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    /**
     * fillable
     */
    protected $fillable = [
        'url',
    ];

    /**
     * YouTubeの動画IDを取得
     */
    public function getYoutubeIdAttribute()
    {
        $url = parse_url($this->url);

        if (strpos($url['host'],'youtube.com') !== false){
            $tmp = str_replace('v=','',$url['query']);
            return substr($tmp, 0, strpos($tmp,'&') ? strpos($tmp,'&') : strlen($tmp));

        } elseif (strpos($url['host'],'youtu.be') !== false) {
            $tmp = substr($url['path'],1);
            return substr($tmp, 0, strpos($tmp,'/') ? strpos($tmp,'/') : strlen($tmp));

        } else {
            return '';
        }

    }
}
