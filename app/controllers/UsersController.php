<?php

class UsersController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Users Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
        $this->beforeFilter('auth', array('only'=>'getDashboard'));
    }

	public function getRegister()
	{
        return View::make('users.register');
	}

    public function getLogin()
    {
        if (Auth::check()) {
            // Redirect to homepage
            return Redirect::intended('gl');
        }
        return View::make('users.login');
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('users/login')->with('message', 'Your are now logged out!');
    }

    public function getSettings()
    {
        return View::make('users.settings');
    }

    public function getDashboard() {
        return View::make('gl');
    }

    public function postCreate()
    {
        // Declare the rules for the form validation. All Input, $rules from User model
        $validator = Validator::make(Input::all(), User::$rules);

        if ($validator->passes()) {
            // validation has passed, save user in DB
            $user = new User;
            $user->firstname = Input::get('firstname');
            $user->lastname = Input::get('lastname');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            return Redirect::to('users/login')->with('message', 'Thanks for registering! You may login below.');
        } else {
            // validation has failed, display error messages
            return Redirect::to('users/register')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function postLogin() {
        // Declare the rules for the form validation.
        $rules = array(
            'email'  => 'required|email',
            'password'  => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ( $validator->passes() ) {
            if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
                // Successfully authenticated, continue to dashboard
                return Redirect::intended('gl')->with('message', 'You have logged in!');
            } else {
                // Failed to authenticate
                return Redirect::to('users/login')
                    ->withErrors(array('password' => 'Password invalid'))
                    ->withInput();
            }
        } else {
            return Redirect::to('users/login')
                ->withErrors($validator)
                ->withInput();
        }
    }

}