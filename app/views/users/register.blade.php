@extends('layouts.base')

@section('meta_description', 'Register :: Graphics Library')
@section('meta_title', 'Register :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Register</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @include('users.forms.register')
        </div>
        <div class="col-md-4">
            <p>Register for an account.</p>
        </div>
    </div>
</div>  <!-- /container -->
@stop