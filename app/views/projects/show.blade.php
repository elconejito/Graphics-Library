@extends('layouts.base')

@section('meta_description', 'Projects Show :: Graphics Library')
@section('meta_title', 'Projects Show :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1>Project: {{ $project->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @if ( count($graphics) > 0 )
            <div class="navigation">
                <ul class="pagination pagination-sm pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
                <p>{{ count($graphics) }} graphics ({{ link_to_action('GraphicsController@index', 'view all', array('project_id'=>$project->id)) }})</p>
            </div>
                @foreach ( $graphics as $graphic )
            <div class="col-md-4">
                <div class="thumbnail">
                    <a href="{{ action('GraphicsController@show', [$graphic->project_id,$graphic->id]) }}" >
                        <img src="{{ asset($graphic->getImageThumbnailPath()) }}" alt="{{ $graphic->title }}" class="img-responsive">
                    </a>
                    <div class="caption">
                        <h3><a href="{{ action('GraphicsController@show', [$graphic->project_id,$graphic->id]) }}" >{{ $graphic->title }}</a><br />
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
            <nav class="navbar navbar-default toolbar" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <span class="navbar-text">Tools</span>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ action('GraphicsController@create',['project_id'=>$project->id]) }}" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-plus"></span> graphic</a></li>
                            <li><a href="{{ action('CoversController@create', ['project_id'=>$project->id]) }}" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-plus"></span> cover</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Information</h3>
                </div>
                <div class="panel-body">
                    <p>desc</p>
                </div>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Short Name</strong>: {{ $project->shortname }}</li>
                    <li class="list-group-item"><strong>Date Submitted</strong>: {{ $project->submit_date }}</li>
                    <li class="list-group-item"><strong>Win/Loss</strong>: {{ $project->arWinLoss[$project->winloss] }}</li>
                    <li class="list-group-item"><strong>Agency</strong>:</li>
                    <li class="list-group-item"><strong>Tags</strong>:</li>
                </ul>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Proposal Cover</h3>
                </div>
                <div class="panel-body">
                    @if ( $cover )
                    <a href="{{ action('CoversController@show', [ $project->id,$cover->id ]) }}" ><img src="{{ asset($cover->getImageThumbnailPath()) }}" alt="{{ $project->name }}" class="img-responsive"></a>
                    @else
                    <p>Sorry, there is no cover.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop