@extends('layouts.base')

@section('meta_description', 'Edit Tag :: Graphics Library')
@section('meta_title', 'Edit Tag :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1>Edit Tag<br /><small>{{ $tag->name }}</small></h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            {{ Form::model( $tag, ['method'=>'PUT', 'action' => ['tags.update', $tag->id], 'class' => 'form-horizontal'] ) }}
            
            @if( count($errors->all()) > 0 )
                @include('components.errors')
            @endif
            
            @include('tags.components.form')
            
            {{ Form::close() }}
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
@stop