@extends('layouts.base')

@section('meta_description', 'Add Graphic :: Graphics Library')
@section('meta_title', 'Add Graphic :: Graphics Library')

@section('js')
    <!-- jQuery 2.0.3 -->
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	{{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/typeahead.bundle.min.js') }}
    {{ HTML::script('js/tagmanager.js') }}
    {{ HTML::script('js/main.js') }}
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1>Add Graphic<br /><small>{{ $project->name }}</small></h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            {{ Form::open( ['action' => 'projects.graphics.store', 'class' => 'form-horizontal', 'files' => true] ) }}
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