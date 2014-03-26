@extends('layouts.base')

@section('meta_description', 'Graphics Create :: Graphics Library')
@section('meta_title', 'Graphics Create :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Add Graphic<br /><small>for project {{ $project->name }}</small></h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            {{ Form::open( ['action' => 'projects.graphics.store', 'class' => 'form-horizontal', 'files' => true] ) }}
            {{ Form::hidden('project_id', $project->id) }}

            @if( count($errors->all()) > 0 )
            <div class="alert alert-danger alert-dismissable">
            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            	<p><span class="glyphicon glyphicon-warning-sign"></span> <strong>Warning!</strong> The form has some errors!</p>
            	<ul>
            	@foreach( $errors->all('<li>:message</li>') as $message )
                    {{ $message }}
                @endforeach
                </ul>
            </div>
            @endif
            
            <div class="form-group @if($errors->first('title'))has-error@endif">
            	{{ Form::label('title','Graphic Title', array('class' => 'control-label col-md-2')) }}
            	<div class="col-md-10">
            		{{ Form::text('title', Input::old('title'), array('class' => 'form-control', 'placeholder'=>'Graphic Title')) }}
            	</div>
            </div>
            <div class="form-group @if($errors->first('control_number'))has-error@endif">
                {{ Form::label('control_number','Control Number', array('class' => 'control-label col-md-2')) }}
                <div class="col-md-10">
                    {{ Form::text('control_number', $project->control_prefix, array('class' => 'form-control', 'placeholder'=>'Control Number')) }}
                </div>
            </div>
            <div class="form-group @if($errors->first('path'))has-error@endif">
                {{ Form::label('image','Image', array('class' => 'control-label col-md-2')) }}
                <div class="col-md-10">
                    {{ Form::file('image') }}
                </div>
            </div>
            <div class="form-group">
            	<div class="col-sm-offset-2 col-sm-10">
            		{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
            	</div>
            </div>
            
            {{ Form::close() }}
        </div>
        <div class="col-md-4">
            <p>Create a new Graphic.</p>
        </div>
    </div>
</div>
@stop