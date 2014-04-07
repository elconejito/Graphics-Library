@extends('layouts.base')

@section('meta_description', 'Edit Graphic :: Graphics Library')
@section('meta_title', 'Edit Graphic :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1>Edit Graphic<br /><small>{{ $project->name }}</small></h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            {{ Form::model( $graphic, ['method'=>'PUT', 'action' => ['projects.graphics.update', $project->id, $graphic->id], 'class' => 'form-horizontal', 'files' => true] ) }}
            {{ Form::hidden('project_id', $project->id) }}

            @if( count($errors->all()) > 0 )
                @include('components.errors')
            @endif

            @include('graphics.components.form')
            
            {{ Form::close() }}
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
@stop