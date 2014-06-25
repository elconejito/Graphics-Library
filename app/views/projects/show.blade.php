@extends('layouts.base')

@section('meta_description', $project->name.' :: Graphics Library')
@section('meta_title', $project->name.' :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1><small>{{ $project->agency->name }}</small><br />{{ $project->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @if ( $project->graphics->count() > 0 )
            <div class="navigation">
                <p>{{ $graphics->count() }} of {{ $project->graphics->count() }} graphics ({{ link_to_action('GraphicsController@index', 'view all', array('project_id'=>$project->id)) }})</p>
            </div>
                @foreach ( $graphics as $graphic )
            <div class="col-md-4">
                <div class="thumbnail">
                    <a href="{{ action('GraphicsController@show', [ $project->id, $graphic->id ]) }}" >
                        <img src="{{ asset($graphic->getImageThumbnailPath()) }}" alt="{{ $graphic->title }}" class="img-responsive">
                    </a>
                    <div class="caption">
                        <h3><a href="{{ action('GraphicsController@show', [ $project->id, $graphic->id ]) }}" >{{ $graphic->title }}</a><br />
                            <small>{{ $graphic->control_number }}</small></h3>
                    </div>
                </div>
            </div>
                @endforeach
            @else
            <p>Sorry, there are no graphics here</p>
            @endif
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Project Tools</h3>
                </div>
                <div class="panel-body">
                    <div class="btn-group actions">
                        <a href="{{ action('GraphicsController@create',['project_id'=>$project->id]) }}" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-plus"></span> graphic</a>
                        @if ( !$project->cover )<a href="{{ action('CoversController@create', ['project_id'=>$project->id]) }}" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-plus"></span> cover</a>@endif
                        <a href="{{ action('ProjectsController@edit',['project_id'=>$project->id]) }}" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-pencil"></span> edit</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Information</h3>
                </div>
                <div class="panel-body">
                    <p>{{ $project->description }}</p>
                </div>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Short Name</strong>: {{ $project->shortname }}</li>
                    <li class="list-group-item"><strong>Date Submitted</strong>: {{ $project->submit_date }}</li>
                    <li class="list-group-item"><strong>Win/Loss</strong>: {{ $project->arWinLoss[$project->winloss] }}</li>
                    <li class="list-group-item"><strong>Agency</strong>: {{ link_to_action('AgenciesController@show', $project->agency->name, $project->agency->id) }}</li>
                    <li class="list-group-item"><strong>Tags</strong>: @foreach( $project->tags as $tag ){{ $tag->toHTML() }}@endforeach</li>
                </ul>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Proposal Cover</h3>
                </div>
                <div class="panel-body">
                    @if ( $project->cover )
                    <a href="{{ action('CoversController@show', [ $project->id,$project->cover->id ]) }}" ><img src="{{ asset($project->cover->getImageThumbnailPath()) }}" alt="{{ $project->name }}" class="img-responsive"></a>
                    @else
                    <p>Sorry, there is no cover.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop