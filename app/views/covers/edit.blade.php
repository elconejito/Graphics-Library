@extends('layouts.base')

@section('meta_description', 'Edit Cover :: Graphics Library')
@section('meta_title', 'Edit Cover :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1>Edit Cover<br /><small>{{ $project->name }}</small></h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            {{ Form::open( [ 'method' => 'PUT', 'action' => ['projects.covers.update', $project->id, $cover->id], 'class' => 'form-horizontal', 'files' => true] ) }}
            {{ Form::hidden('project_id', $project->id) }}

            @if( count($errors->all()) > 0 )
                @include('components.errors')
            @endif

            @include('covers.components.form')
            
            {{ Form::close() }}
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Current Proposal Cover</h3>
                </div>
                <div class="panel-body">
                    @if ( $cover )
                    <img src="{{ asset($cover->getImageThumbnailPath()) }}" alt="{{ $project->name }}" class="img-responsive">
                    @else
                    <p>Sorry, there is no cover.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop