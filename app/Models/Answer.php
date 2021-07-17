<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    // users->answers
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    // questions->answers
    public function question() {
        return $this->belongsTo('App\Models\Question');
    }

    // privacies->answers
    public function privacy() {
        return $this->belongsTo('App\Models\Privacy');
    }
}
