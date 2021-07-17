<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];
    
    // users->questions
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    // questions->answers
    public function answers() {
        return $this->hasMany('App\Models\Answer');
    }

    // questiontypes->questions
    public function questiontype() {
        return $this->belongsTo('App\Models\Questiontype');
    }

    // questions->selections
    public function selections() {
        return $this->hasMany('App\Models\Selection');
    }
}
