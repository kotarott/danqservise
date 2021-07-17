<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questiontype extends Model
{
    use HasFactory;

    // questiontypes->questions
    public function questions() {
        return $this->hasMany('App\Models\Question');
    }
}
