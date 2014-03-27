<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
 * Route Models
 *
 */

Route::model('project','Project');
Route::model('graphic','Graphic');
Route::model('user','User');

/*
 * General Routes
 *
 */

Route::get('/', function()
{
	return View::make('home');
});

Route::get('/gl', ['as' => 'gl', function() {
    $projects = Project::orderby('created_at')
        ->take(5)
        ->get();
    $graphics = Graphic::orderby('created_at')
        ->take(5)
        ->get();
    
    return View::make('gl', compact('projects','graphics'));
    
}])->before('auth');

Route::get('/contact', function()
{
	return View::make('contact');
});

/*
 * Routes to resources
 *
 */
Route::resource('clients', 'ClientsController');
Route::resource('tags', 'TagsController');
Route::resource('projects', 'ProjectsController');
Route::resource('projects.graphics', 'GraphicsController');
Route::resource('projects.covers', 'CoversController');

/*
 * Routes to controllers
 *
 */

Route::controller('users', 'UsersController');