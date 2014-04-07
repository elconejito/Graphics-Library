@extends('layouts.base')

@section('meta_description', 'Add Cover :: Graphics Library')
@section('meta_title', 'Add Cover :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1>Add Cover<br /><small>{{ $project->name }}</small></h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            {{ Form::open( ['action' => 'projects.covers.store', 'class' => 'form-horizontal', 'files' => true] ) }}
            {{ Form::hidden('project_id', $project->id) }}

            @if( count($errors->all()) > 0 )
                @include('components.errors')
            @endif

            @include('projects.components.form')
            
            {{ Form::close() }}
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
@stop