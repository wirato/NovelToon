<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostEpisodemanga extends Model
{
  use SoftDeletes;

  protected $dates = ['deleted_at'];

  protected $fillable = ['manga_id', 'manga_title', 'ep', 'title'];


  public function manga()
  {
      return $this->belongsTo(Manga::class);
  }
}
