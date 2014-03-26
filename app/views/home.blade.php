@extends('layouts.base')

@section('meta_description', 'Graphics Library')
@section('meta_title', 'Graphics Library')

@section('content')
    <!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="jumbotron">
		<div class="container">
			<h1>JumboTron Text</h1>
			<p>env is {{ App::environment() }}</p>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Welcome</h1>
			</div>
		</div>
	</div>
@stop