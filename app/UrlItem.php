<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlItem extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Generate a "random" alpha-numeric string.
     * @param  int  $length
     * @return string
     */
    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    /**
     * @param  string  $short_url
     * @return mixed
     */
    public static function getByShortUrl($short_url)
    {
        return self::where('short_url', '=', $short_url)->first();

    }
}
