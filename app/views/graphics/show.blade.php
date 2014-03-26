@extends('layouts.base')

@section('meta_description', 'Graphics Show :: Graphics Library')
@section('meta_title', 'Graphics Show :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>breadcrumbs</p>
            <h1><small>{{ $graphic->control_number }}</small><br />{{ $graphic->title }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <img src="{{ asset($graphic->getImageMainPath()) }}" alt="{{ $graphic->title }}" id="graphic-full" class="img-responsive img-thumbnail">
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Information</h3>
                </div>
                <div class="panel-body">
                    <p>desc</p>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">Control #: {{ $graphic->control_number }}</li>
                    <li class="list-group-item">Title: {{ $graphic->title }}</li>
                    <li class="list-group-item">Project: {{ link_to_action('ProjectsController@show', $project->name, array('id'=>$project->id)) }}</li>
                    <li class="list-group-item">agency</li>
                    <li class="list-group-item">tags</li>
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