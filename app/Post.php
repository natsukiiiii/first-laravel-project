<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body','user_id'];
    // fillable : $fillableに設定したもの以外のカラムはユーザーが変更できないようにできます。

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
