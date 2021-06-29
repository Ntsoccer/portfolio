<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weights extends Model
{
    //
    public function user(){
      return $this->belongsTo('App\USer');
    }

    protected $fillable = ['is_display'];

}