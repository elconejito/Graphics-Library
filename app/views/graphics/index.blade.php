@extends('layouts.base')

@section('meta_description', 'Graphics :: Graphics Library')
@section('meta_title', 'Graphics :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>breadcrumbs</p>
            <h1><small>Graphics for</small><br />{{ $project->name }}</h1>
            <p>{{ link_to_action('GraphicsController@create', 'add graphic to this project', array('project_id'=>$project->id)) }}</p>
        </div>
    </div>
    <div class="row">
        @if ( $graphics )
            @foreach ( $graphics as $graphic )
        <div class="col-md-3">
            <div class="thumbnail">
                <a href="{{ action('GraphicsController@show', [$graphic->project_id,$graphic->id]) }}" >
                    <img src="{{ asset($graphic->getImageThumbnailPath()) }}" alt="{{ $graphic->title }}" class="img-responsive">
                </a>
                <div class="caption">
                    <h3><a href="{{ action('GraphicsController@show', [$graphic->project_id,$graphic->id]) }}" >{{ $graphic->title }}</a><br />
                        <small>{{ $graphic->control_number }}</small></h3>
                    <p>desc</p>
                </div>
            </div>
        </div>
            @endforeach
        @else
        <p>Sorry, there are no graphics here</p>
        @endif
    </div>
</div>
@stop