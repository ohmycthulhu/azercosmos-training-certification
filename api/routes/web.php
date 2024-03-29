<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('tutorials', 'TutorialController@get');
$router->get('tutorials/{id}', 'TutorialController@getById');
$router->post('tutorials', 'TutorialController@add');
$router->put('tutorials/{id}', 'TutorialController@update');
$router->delete('tutorials/{id}', 'TutorialController@delete');
$router->get('tutorials/{id}/questions', 'TutorialController@getQuestions');

$router->post('tutorials/{id}/observers', 'TutorialController@addObserver');
$router->post('tutorials/{id}/moderators', 'TutorialController@addModerator');
$router->delete('tutorials/{id}/observers/{o_id}', 'TutorialController@deleteObserver');
$router->delete('tutorials/{id}/moderators/{m_id}', 'TutorialController@deleteModerator');

$router->get('questions', 'QuestionController@get');
$router->get('questions/{id}', 'QuestionController@getById');
$router->get('questions/by-tutorial/{id}', 'QuestionController@getByTutorial');
$router->post('questions', 'QuestionController@add');
$router->patch('questions', 'QuestionController@updateMany');
$router->put('questions/{id}', 'QuestionController@update');
$router->delete('questions/', 'QuestionController@deleteMany');
$router->delete('questions/{id}', 'QuestionController@delete');

$router->get('trainings', 'TrainingController@get');
$router->get('trainings/{id}', 'TrainingController@getById');
$router->post('trainings', 'TrainingController@add');
$router->put('trainings/{id}', 'TrainingController@update');
$router->post('trainings/{id}', 'TrainingController@update');
$router->delete('trainings/{id}', 'TrainingController@delete');
$router->get('trainings/{id}/questions', 'TrainingController@getQuestions');
$router->post('trainings/{id}/participants', 'TrainingController@passTest');
$router->patch('trainings/{id}/participants', 'TrainingController@notifyParticipants');
$router->get('trainings/{id}/participants', 'TrainingController@notifyParticipants');

$router->get('participants', 'ParticipantsController@get');
$router->get('participants/{id}', 'ParticipantsController@getById');
$router->post('participants', 'ParticipantsController@add');
$router->patch('participants', 'ParticipantsController@updateMany');
$router->put('participants/{id}', 'ParticipantsController@update');
$router->delete('participants/{id}', 'ParticipantsController@delete');

$router->get('users', 'UserController@get');
$router->get('user', 'UserController@getMyUser');
$router->get('user/tutorials', 'UserController@getTutorialsBySession');
$router->get('user/my-trainings', 'UserController@getMyTrainingsBySession');
$router->get('user/participating-trainings', 'UserController@getParticipatingTrainingsBySession');
$router->get('user/observing-trainings', 'UserController@getObservingTrainingsBySession');

$router->get('test', function () {
    $arr = array('f' => 1, 's' => 2);
    return $arr['a'] ?? $arr['f'] ?? 3;
});
$router->get('test/mailer', function () {
    try {
        dispatch(new \App\Jobs\ExampleJob('Tarlan'));
    } catch (Exception $e) {
        return 'Fail '.$e;
    } finally {
        return 'Successfully';
    }
});
