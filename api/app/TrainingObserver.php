<?php
/**
 * Created by PhpStorm.
 * User: fruit
 * Date: 1/24/2019
 * Time: 5:00 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class TrainingObserver extends Model
{
    protected $fillable = [
        'observer_id', 'training_id'
    ];
    protected $table = 'observer_training';
    public function user() {
        return $this->belongsTo(User::class, 'observer_id');
    }

    public function training() {
        return $this->belongsTo(Training::class, 'training_id');
    }
}