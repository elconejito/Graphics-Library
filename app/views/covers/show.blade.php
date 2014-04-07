@extends('layouts.base')

@section('meta_description', $project->name.' Cover :: Graphics Library')
@section('meta_title', $project->name.' Cover :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1><small>{{ $project->name }}</small><br />Cover</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <img src="{{ asset($cover->getImageMainPath()) }}" alt="{{ $project->title }}" class="img-responsive img-thumbnail graphic-full">
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
                            <li><a href="{{ action('CoversController@edit', ['project_id'=>$project->id, 'id'=>$cover->id]) }}" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-pencil"></span> cover</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Information</h3>
                </div>
                <div class="panel-body">
                    <p>{{ $project->description }}</p>
                </div>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Project</strong>: {{ link_to_action('ProjectsController@show', $project->name, array('id'=>$project->id)) }}</li>
                    <li class="list-group-item"><strong>Date Submitted</strong>: {{ $project->submit_date }}</li>
                    <li class="list-group-item"><strong>Win/Loss</strong>: {{ $project->arWinLoss[$project->winloss] }}</li>
                </ul>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Download</h3>
                </div>
                <div class="panel-body">
                    <p>{{ link_to($cover->getImageMainPath(), 'Download Medium Image', ['class'=>'btn btn-primary btn-block']) }}</p>
                    <p>{{ link_to($cover->getImageFullsizePath(), 'Download Fullsize Image', ['class'=>'btn btn-primary btn-block']) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop