@extends('layouts.base')

@section('meta_description', 'Edit Project :: Graphics Library')
@section('meta_title', 'Edit Project :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1>Edit<br /><small>{{ $project->name }}</small></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            {{ Form::model( $project, array( 'method' => 'PUT', 'action' => ['projects.update', $project->id], 'class' => 'form-horizontal' )) }}

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