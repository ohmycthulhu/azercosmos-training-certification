<?php
/**
 * Created by PhpStorm.
 * User: fruit
 * Date: 1/22/2019
 * Time: 11:08 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table;

    public function __construct() {
        $this->table = env('DB_ERP','admin_erp').'.PEOPLE';
    }

    public function observed_tutorials()
    {
        return $this->hasManyThrough(Tutorial::class, TutorialObserver::class, 'observer_id',
            'id', 'ID', 'tutorial_id')->groupBy('tutorial_id');
    }

    public function moderating_tutorials()
    {
        return $this->hasManyThrough(Tutorial::class, Moderator::class, 'moderator_id',
            'id', 'ID', 'tutorial_id')->groupBy('tutorial_id');
    }

    public function own_tutorials()
    {
        return $this->hasMany(Tutorial::class, 'author', 'ID');
    }

    public function observed_trainings()
    {
        return $this->hasManyThrough(Training::class, TrainingObserverView::class, 'observer_id',
            'id', 'ID', 'training_id')->groupBy('training_id');
    }

    public function own_trainings()
    {
        return $this->hasMany(Training::class, 'originator_id', 'ID');
    }

    public function participating_trainings()
    {
        return $this->hasMany(TrainingParticipant::class, 'participant_id', 'ID');
    }
}