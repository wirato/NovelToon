<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manga extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id','title', 'mangaimage', 'author', 'resume'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
