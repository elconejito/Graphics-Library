@extends('layouts.base')

@section('meta_description', 'Search :: Graphics Library')
@section('meta_title', 'Search :: Graphics Library')

@section('content')
    
    <div class="container">
		<div class="row">
			<div class="col-md-12">
			    {{ Breadcrumbs::render() }}
                @if ( $query )
                <h1><small>Search</small><br />Results for &quot;{{ $query }}&quot;</h1>
                @else
                <h1>Search</h1>
                @endif
			</div>
		</div>
		<div class="row">
    		<div class="col-md-8">
    			<h2>Graphics<br /><small>{{ $graphics->count() }} matches</small></h2>
                @if ( $graphics->count() > 0 )
                <ul class="list-group">
                    @foreach ( $graphics as $graphic )
                    <li class="list-group-item">{{ link_to_action('GraphicsController@show', $graphic->control_number .'_'. $graphic->title, array('project_id'=>$graphic->project->id, 'id'=>$graphic->id)) }}</li>
                    @endforeach
                </ul>
                @endif
    			
    			<h2>Projects<br /><small>{{ $projects->count() }} matches</small></h2>
    			@if ( $projects->count() > 0 )
                <ul class="list-group">
                    @foreach ( $projects as $project )
                    <li class="list-group-item">{{ link_to_action('ProjectsController@show', $project->agency->shortname .' '. $project->name, array('id'=>$project->id)) }} <span class="badge">{{ $project->graphics()->count() }} <span class="glyphicon glyphicon-picture"></span></span></li>
                    @endforeach
                </ul>
                @endif
    			
    			<h2>Tags<br /><small>{{ $tags->count() }} matches</small></h2>
                @if ( $tags->count() > 0 )
                <ul class="list-group">
                    @foreach ( $tags as $tag )
                    <li class="list-group-item">{{ link_to_action('TagsController@show', $tag->name, array('id'=>$tag->id)) }} <span class="badge">{{ $tag->graphics()->count() }} <span class="glyphicon glyphicon-picture"></span></span> <span class="badge">{{ $tag->projects()->count() }} <span class="glyphicon glyphicon-book"></span></span></li>
                    @endforeach
                </ul>
                @endif
    			
    			<h2>Agencies<br /><small>{{ $agencies->count() }} matches</small></h2>
                @if ( $agencies->count() > 0 )
                <ul class="list-group">
                    @foreach ( $agencies as $agency )
                    <li class="list-group-item">{{ link_to_action('AgenciesController@show', $agency->name, array('id'=>$agency->id)) }} <span class="badge">{{ $agency->projects()->count() }} <span class="glyphicon glyphicon-book"></span></span></li>
                    @endforeach
                </ul>
                @endif
    		</div>
    		<div class="col-md-4">
    		    <h3>Search<br /><small>Search by Keyword</small></h3>
				@include('components.forms.search')
    		</div>
		</div>  <!-- /row -->
	</div>
	
@stop