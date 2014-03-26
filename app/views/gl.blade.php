@extends('layouts.base')

@section('meta_description', 'Graphics Library')
@section('meta_title', 'Graphics Library')

@section('content')
    
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Graphics Library</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<h3>Projects</h3>
				<p>{{ link_to_action('ProjectsController@create', 'add new project') }}</p>
				<p>{{ link_to_action('ProjectsController@index', 'browse all projects') }}</p>
				<ul class="list-group">
				@if ( $projects )
				    @foreach ( $projects as $project )
				    <li class="list-group-item">{{ link_to_action('ProjectsController@show', $project->name, array('id'=>$project->id)) }}</li>
				    @endforeach
				@else
				    <li class="list-group-item">no projects</li>
				@endif
				</ul>
			</div>
			<div class="col-md-4">
				<h3>Graphics</h3>
				<ul class="list-group">
				@if ( $graphics )
				    @foreach ( $graphics as $graphic )
				    <li class="list-group-item">{{ link_to_action('GraphicsController@show', $graphic->control_number, array('id'=>$graphic->id)) }}<br />{{ $graphic->title }}</li>
				    @endforeach
				@else
				    <li class="list-group-item">no graphics</li>
				@endif
				</ul>
			</div>
			<div class="col-md-4">
				<h3>Search</h3>
				<p>search here</p>
			</div>
		</div>  <!-- /row -->
	</div>
	
@stop