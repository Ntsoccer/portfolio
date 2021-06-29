<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todos extends Model
{
    //
    public function user(){
      return $this->belongsTo('App\USer');
    }

    protected $fillable = ['complete'];
}