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
$router->put('questions/{id}', 'QuestionController@update');
$router->delete('questions/{id}', 'QuestionController@delete');

$router->get('users', 'UserController@get');
$router->get('users/{id}/tutorials', 'UserController@getTutorials');
