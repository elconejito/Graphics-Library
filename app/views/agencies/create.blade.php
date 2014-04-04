@extends('layouts.base')

@section('meta_description', 'Add Agency :: Graphics Library')
@section('meta_title', 'Add Agency :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1>Add Agency</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            {{ Form::open( ['action' => 'agencies.store', 'class' => 'form-horizontal'] ) }}

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
            	{{ Form::label('name','Agency/Client Name', array('class' => 'control-label col-md-3')) }}
            	<div class="col-md-9">
            		{{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder'=>'Agency/Client Name')) }}
            	</div>
            </div>
            <div class="form-group @if($errors->first('shortname'))has-error@endif">
            	{{ Form::label('shortname','Abbreviation', array('class' => 'control-label col-md-3')) }}
            	<div class="col-md-9">
            		{{ Form::text('shortname', Input::old('shortname'), array('class' => 'form-control', 'placeholder'=>'Abbreviation', 'maxlength'=>'5')) }}
            	</div>
            </div>
            <div class="form-group">
            	<div class="col-md-offset-3 col-md-9">
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