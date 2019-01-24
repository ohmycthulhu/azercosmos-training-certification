<?php

namespace App\Http\Controllers;

use App\Tutorial;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    protected $tutorial;
    protected $rules = [];

    public function __construct(Tutorial $tutorial)
    {
        parent::__construct($tutorial, $this->rules);
        $this->tutorial = $tutorial;
    }

    public function add(Request $request)
    {
        $tutorial = parent::add($request);
        foreach($request['questions'] as $question) {
            $tutorial->questions()->create($question);
        }
        foreach($request->input('moderators') as $moderator) {
            $tutorial->moderators()->create($moderator);
        }
        foreach($request->input('observers') as $observer) {
            $tutorial->observers()->create($observer);
        }
        return $tutorial;
//        foreach ($request['question'])
    }

    public function getById($id)
    {
        return parent::getById($id)->load(['questions', 'moderators.user', 'observers.user']); // TODO: Change the autogenerated stub
    }

    public function getQuestions ($id, Request $request) {
        $tutorial = $this->tutorial::findOrFail($id);
        return array('unverified' => $tutorial->unverified_questions()->get(), 'verified' => $tutorial->verified_questions()->get());
    }

    public function addObserver ($id, Request $request) {
        return $this->tutorial::findOrFail($id)->observers()->create($request->all())->load('user');
    }

    public function addModerator ($id, Request $request) {
        return $this->tutorial::findOrFail($id)->moderators()->create($request->all())->load('user');
    }

    public function deleteObserver ($id, $o_id, Request $request) {
        $tutorial = $this->tutorial::findOrFail($id);
        $tutorial->observers()->where('id', $o_id)->delete();
        return $tutorial->observers()->with('user')->get();
    }

    public function deleteModerator ($id, $m_id, Request $request) {
        $tutorial = $this->tutorial::findOrFail($id);
        $tutorial->moderators()->where('id', $m_id)->delete();
        return $tutorial->moderators()->with('user')->get();
    }

    public function update(Request $request, $id)
    {
        $tutorial = $this->tutorial::findOrFail($id);
        $moderators = $request->input('moderators');
        if (is_array($moderators)) {

            $tutorial->moderators()->whereNotIn('id', $moderators)->delete();
            foreach($moderators as $m) {
                $tutorial->moderators()->firstOrCreate(['moderator_id' => $m]);
            }
        }
        $observers = $request->input('observers');
        if (is_array($observers)) {
            $tutorial->observers()->whereNotIn('id', $request->input('observers', []))->delete();
            foreach($observers as $o) {
                $tutorial->observers()->firstOrCreate(['observer_id' => $o]);
            }
        }
        $tutorial->fill($request->all())->save();
        return $tutorial->load('moderators.user', 'observers.user');
    }
}
