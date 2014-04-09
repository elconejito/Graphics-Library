@extends('layouts.base')

@section('meta_description', $graphic->title.' :: Graphics Library')
@section('meta_title', $graphic->title.' :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1><small>{{ $graphic->control_number }}</small><br />{{ $graphic->title }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <img src="{{ asset($graphic->getImageMainPath()) }}" alt="{{ $graphic->title }}" class="img-responsive img-thumbnail graphic-full">
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Graphic Tools</h3>
                </div>
                <div class="panel-body">
                    <div class="btn-group actions">
                        <a href="{{ action('GraphicsController@edit', ['project_id'=>$project->id, 'id'=>$graphic->id]) }}" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> edit</a>
                        <a href="{{ action('GraphicsController@getDelete', ['id'=>$graphic->id]) }}" class="btn btn-danger" data-toggle="modal" data-target="#modalTarget"><span class="glyphicon glyphicon-remove"></span> delete</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Information</h3>
                </div>
                <div class="panel-body">
                    <p>{{ $graphic->description }}</p>
                </div>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Control #</strong>: {{ $graphic->control_number }}</li>
                    <li class="list-group-item"><strong>Title</strong>: {{ $graphic->title }}</li>
                    <li class="list-group-item"><strong>Project</strong>: {{ link_to_action('ProjectsController@show', $project->name, array('id'=>$project->id)) }}</li>
                    <li class="list-group-item"><strong>Agency</strong>: {{ $agencies[$project->agency] }}</li>
                    <li class="list-group-item"><strong>Tags</strong>:</li>
                </ul>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Download</h3>
                </div>
                <div class="panel-body">
                    <p>{{ link_to($graphic->getImageMainPath(), 'Download Medium Image', ['class'=>'btn btn-primary btn-block']) }}</p>
                    <p>{{ link_to($graphic->getImageFullsizePath(), 'Download Fullsize Image', ['class'=>'btn btn-primary btn-block']) }}</p>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Related</h3>
                </div>
                <div class="panel-body">
                    <p>other versions here</p>
                    <p>similar graphics here</p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop