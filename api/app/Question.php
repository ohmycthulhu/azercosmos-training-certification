<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'tutorial_questions';

    protected $fillable = [
        'tutorial_id', 'question', 'answer1', 'answer2', 'answer3', 'answer4', 'correct_answer', 'difficulty', 'author_id', 'verified',
    ];

    protected $with = ['file'];

    public function tutorial()
    {
        return $this->belongsTo('App\Tutorial', 'tutorial_id');
    }

    public function file() {
        return $this->morphOne(File::class, 'fileable');
    }
}
