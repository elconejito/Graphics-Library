@extends('layouts.base')

@section('meta_description', 'Add Project :: Graphics Library')
@section('meta_title', 'Add Project :: Graphics Library')

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
            <h1>Add Project</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            {{ Form::open( array( 'action' => 'projects.store', 'class' => 'form-horizontal' )) }}

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