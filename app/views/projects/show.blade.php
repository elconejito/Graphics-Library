@extends('layouts.base')

@section('meta_description', 'Projects Show :: Graphics Library')
@section('meta_title', 'Projects Show :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>breadcrumbs</p>
            <h1>Project: {{ $project->name }}</h1>
            <p>details here</p>
            <p>{{ link_to_action('GraphicsController@create', 'add graphic to this project', array('project_id'=>$project->id)) }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @if ( count($graphics) > 0 )
            <p>{{ link_to_action('GraphicsController@index', 'view all graphics', array('project_id'=>$project->id)) }}</p>
                @foreach ( $graphics as $graphic )
            <div class="col-md-4">
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
            <div class="col-md-12">
                <p>Sorry, there are no graphics here</p>
            </div>
            @endif
        </div>
        <div class="col-md-4">
            <p>cover</p>
        </div>
    </div>
</div>
@stop