<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Novel extends Model
{
  use SoftDeletes;

  protected $fillable = ['user_id','title', 'novelimage', 'author', 'srsume'];


  public function user()
  {
      return $this->belongsTo(User::class);
  }



}
