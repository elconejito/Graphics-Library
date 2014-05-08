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
    $agencies = Agency::orderby('shortname')
        ->take(5)
        ->get();
    $tags = Tag::orderby('name')
        ->take(5)
        ->get();
    
    return View::make('gl', compact('projects','agencies','tags'));
    
}])->before('auth');

Route::get('/admin', ['as' => 'admin', function() {
    
    return View::make('admin');
    
}])->before('auth');

Route::get('/search', ['as' => 'search', function() {
    $query = Request::get('q');
    
    if ( $query ) {
        $projects = Project::search($query)
            ->take(5)
            ->get();
        $agencies = Agency::search($query)
            ->take(5)
            ->get();
        $tags = Tag::search($query)
            ->take(5)
            ->get();
        $graphics = Graphic::search($query)
            ->take(5)
            ->get();
    }
    return View::make('search', compact('projects','agencies','tags','graphics'));
    
}])->before('auth');


/*
 * Routes to resources
 *
 */
Route::resource('clients', 'ClientsController');
Route::resource('tags', 'TagsController');
Route::resource('agencies', 'AgenciesController');
Route::resource('projects', 'ProjectsController');
Route::resource('projects.graphics', 'GraphicsController');
Route::resource('projects.covers', 'CoversController');

/*
 * Routes to controllers
 *
 */

Route::controller('users', 'UsersController');
Route::controller('graphics', 'GraphicsController');