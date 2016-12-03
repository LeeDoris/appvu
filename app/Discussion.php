<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model {


    protected $table = 'discussion';
    public $timestamps = true;
    protected $fillable = [ 'body', 'chatter_category_id', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id');
    }

    public function replys()
    {
        return $this->hasMany(Reply::class, 'chatter_discussion_id');
    }

    public function reply(){
        return $this->hasMany(Reply::class, 'chatter_discussion_id')->orderBy('created_at', 'ASC');
    }

    public function replyCount()
    {
        return $this->replys()
            ->selectRaw('chatter_discussion_id, count(*) as total')
            ->groupBy('chatter_discussion_id');
    }
    public static function stringToColorCode($str) {
        $code = dechex(crc32($str));
        $code = substr($code, 0, 6);
        return $code;
    }

}
