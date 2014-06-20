@extends('layouts.base')

@section('meta_description', 'Dashboard :: Graphics Library')
@section('meta_title', 'Dashboard :: Graphics Library')

@section('content')
    
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Graphics Library</h1>
			</div>
		</div>
		
		<div class="row">
            <div class="col-md-6">
                <h3>Projects<br /><small>Browse by Project</small></h3>
                <ul class="list-group">
                    @if ( count($projects) > 0 )
                    @foreach ( $projects as $project )
                    <li class="list-group-item">{{ link_to_action('ProjectsController@show', $project->agency->shortname .' '. $project->name, array('id'=>$project->id)) }} <span class="badge">{{ $project->graphics()->count() }} <span class="glyphicon glyphicon-picture"></span></span></li>
                    @endforeach
                    <li class="list-group-item list-group-item-info">{{ link_to_action('ProjectsController@index', 'browse all projects') }}</li>
                    @else
                    <li class="list-group-item">No Projects</li>
                    @endif
                </ul>
            </div>
			<div class="col-md-3">
				<h3>Agencies<br /><small>Browse by Agency</small></h3>
				<ul class="list-group">
				@if ( count($agencies) > 0 )
				    @foreach ( $agencies as $agency )
				    <li class="list-group-item">{{ link_to_action('AgenciesController@show', $agency->shortname, array('id'=>$agency->id)) }} <span class="badge">{{ $agency->projects()->count() }} <span class="glyphicon glyphicon-book"></span></span></li>
				    @endforeach
                    <li class="list-group-item list-group-item-info">{{ link_to_action('AgenciesController@index', 'browse all Agencies') }}</li>
				@else
				    <li class="list-group-item">No Agencies</li>
				@endif
				</ul>
			</div>
			<div class="col-md-3">
				<h3>Tags<br /><small>Browse by Tag</small></h3>
				<ul class="list-group">
				@if ( count($tags) > 0 )
				    @foreach ( $tags as $tag )
				    <li class="list-group-item">{{ link_to_action('TagsController@show', $tag->name, array('id'=>$tag->id)) }} <span class="badge">{{ $tag->graphics()->count() }} <span class="glyphicon glyphicon-picture"></span></span> <span class="badge">{{ $tag->projects()->count() }} <span class="glyphicon glyphicon-book"></span></span></li>
				    @endforeach
                    <li class="list-group-item list-group-item-info">{{ link_to_action('TagsController@index', 'browse all Tags') }}</li>
				@else
				    <li class="list-group-item">No Tags</li>
				@endif
				</ul>
            </div>
		</div>  <!-- /row -->
	</div>
	
@stop