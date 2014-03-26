@extends('layouts.base')

@section('meta_description', 'Login :: Graphics Library')
@section('meta_title', 'Login :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Login</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @include('users.forms.login')
        </div>
        <div class="col-md-4">
            <p>Login.</p>
            <p>If you don't already have an account, {{ link_to_action('UsersController@getRegister', 'Register') }}</p>
        </div>
    </div>
</div>
@stop