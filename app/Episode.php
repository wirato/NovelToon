<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episode extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['novel_id', 'ep', 'title', 'detail'];

    /**
     * The belongs to Relationship
     *
     * @var array
     */
    public function novel()
    {
        return $this->belongsTo(Novel::class);
    }

}
