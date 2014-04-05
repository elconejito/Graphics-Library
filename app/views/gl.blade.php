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
                <p>Browse by Project</p>
				<ul class="list-group">
				@if ( $projects )
				    @foreach ( $projects as $project )
				    <li class="list-group-item">{{ link_to_action('ProjectsController@show', $project->name, array('id'=>$project->id)) }}</li>
				    @endforeach
                    <li class="list-group-item">{{ link_to_action('ProjectsController@index', 'browse all projects') }}</li>
				@else
				    <li class="list-group-item">No Projects</li>
				@endif
				</ul>
			</div>
			<div class="col-md-4">
				<h3>Agencies</h3>
                <p>Browse by Agency</p>
				<ul class="list-group">
				@if ( $agencies )
				    @foreach ( $agencies as $agency )
				    <li class="list-group-item">{{ link_to_action('AgenciesController@show', $agency->shortname, array('id'=>$agency->id)) }}</li>
				    @endforeach
				@else
				    <li class="list-group-item">No Agencies</li>
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