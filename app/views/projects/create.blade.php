@extends('layouts.base')

@section('meta_description', 'Projects Create :: Graphics Library')
@section('meta_title', 'Projects Create :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Add New Project</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            {{ Form::open( array( 'action' => 'projects.store', 'class' => 'form-horizontal' )) }}

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
            
            <div class="form-group @if($errors->first('name'))has-error@endif">
            	{{ Form::label('name','Project Name', array('class' => 'control-label col-md-2')) }}
            	<div class="col-md-10">
            		{{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder'=>'Project Name')) }}
            	</div>
            </div>
            <div class="form-group @if($errors->first('shortname'))has-error@endif">
                {{ Form::label('shortname','Short Name', array('class' => 'control-label col-md-2')) }}
                <div class="col-md-10">
                    {{ Form::text('shortname', Input::old('shortname'), array('class' => 'form-control', 'placeholder'=>'Short Name')) }}
                </div>
            </div>
            <div class="form-group @if($errors->first('control_prefix'))has-error@endif">
                {{ Form::label('control_prefix','Control Prefix', array('class' => 'control-label col-md-2')) }}
                <div class="col-md-10">
                    {{ Form::text('control_prefix', Input::old('control_prefix'), array('class' => 'form-control', 'placeholder'=>'Control Prefix')) }}
                </div>
            </div>
            <div class="form-group @if($errors->first('control_prefix'))has-error@endif">
                {{ Form::label('control_prefix','Control Prefix', array('class' => 'control-label col-md-2')) }}
                <div class="col-md-10">
                    {{ Form::text('control_prefix', Input::old('control_prefix'), array('class' => 'form-control', 'placeholder'=>'Control Prefix')) }}
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
        </div>
    </div>
</div>
@stop