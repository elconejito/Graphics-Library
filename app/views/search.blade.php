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
    			<h2>Graphics</h2>
                @if ( $graphics->count() > 0 )
                <div class="navigation">
                    <p>{{ $graphics->count() }} of {{ Graphic::count() }} graphics match</p>
                </div>
                <ul class="list-group">
                    @foreach ( $graphics as $graphic )
                    <li class="list-group-item">{{ link_to_action('GraphicsController@show', $graphic->title, array('project_id'=>$graphic->project->id, 'id'=>$graphic->id)) }}</li>
                    @endforeach
                </ul>
                @else
                <div class="navigation">
                    <p>0 of {{ Graphic::count() }} graphics match</p>
                </div>
                @endif
    			
    			<h2>Projects</h2>
    			@if ( $projects->count() > 0 )
                <div class="navigation">
                    <p>{{ $projects->count() }} of {{ Project::count() }} projects match</p>
                </div>
                <ul class="list-group">
                    @foreach ( $projects as $project )
                    <li class="list-group-item">{{ link_to_action('ProjectsController@show', $project->name, array('id'=>$project->id)) }}</li>
                    @endforeach
                </ul>
                @else
                <div class="navigation">
                    <p>0 of {{ Project::count() }} projects match</p>
                </div>
                @endif
    			
    			<h2>Tags</h2>
                @if ( $tags->count() > 0 )
                <div class="navigation">
                    <p>{{ $tags->count() }} of {{ Tag::count() }} tags match</p>
                </div>
                <ul class="list-group">
                    @foreach ( $tags as $tag )
                    <li class="list-group-item">{{ link_to_action('TagsController@show', $tag->title, array('id'=>$tag->id)) }}</li>
                    @endforeach
                </ul>
                @else
                <div class="navigation">
                    <p>0 of {{ Tag::count() }} tags match</p>
                </div>
                @endif
    			
    			<h2>Agencies</h2>
                @if ( $agencies->count() > 0 )
                <div class="navigation">
                    <p>{{ $agencies->count() }} of {{ Agency::count() }} agencies match</p>
                </div>
                <ul class="list-group">
                    @foreach ( $agencies as $agency )
                    <li class="list-group-item">{{ link_to_action('AgencyController@show', $agency->name, array('id'=>$agency->id)) }}</li>
                    @endforeach
                </ul>
                @else
                <div class="navigation">
                    <p>0 of {{ Agency::count() }} agencies match</p>
                </div>
                @endif
    		</div>
    		<div class="col-md-4">
    		    <h3>Search<br /><small>Search by Keyword</small></h3>
				@include('components.forms.search')
    		</div>
		</div>  <!-- /row -->
	</div>
	
@stop