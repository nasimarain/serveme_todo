<?php
use Illuminate\Http\Request;


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

$router->group(['prefix' => 'api', 'middleware' => 'auth_api'], function () use ($router) {

    //Login, Signup, Logout
    $router->post('signup', 'SignupController@registerUser');
    $router->post('login', 'LoginController@doLogin');
    $router->get('logout', 'LoginController@logout');

    //Category
    $router->post('category', 'CategoryController@postCategory');

    //Category
    $router->post('todoitem', 'ToDoItemController@postToDoItems');



  });
