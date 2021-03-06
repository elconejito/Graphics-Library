@extends('layouts.base')

@section('meta_description', 'Graphics for '.$project->name.'  :: Graphics Library')
@section('meta_title', 'Graphics for '.$project->name.' :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1><small>Graphics for</small><br />{{ $project->agency->shortname }} {{ $project->name }}</h1>
        </div>
    </div>
    <div class="row">
        @if ( $graphics )
        <div class="navigation">
            {{ $graphics->links('components.pagination') }}
            <p>{{ $graphics->count() }} of {{ $project->countGraphics() }} graphics</p>
        </div>
            @foreach ( $graphics as $graphic )
        <div class="col-md-3">
            <div class="thumbnail">
                <a href="{{ action('GraphicsController@show', [$graphic->project->id,$graphic->id]) }}" >
                    <img src="{{ asset($graphic->getImageThumbnailPath()) }}" alt="{{ $graphic->title }}" class="img-responsive">
                </a>
                <div class="caption">
                    <h3><small>{{ $graphic->control_number }}</small><br />
                        <a href="{{ action('GraphicsController@show', [$graphic->project->id,$graphic->id]) }}" >{{ $graphic->title }}</a></h3>
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