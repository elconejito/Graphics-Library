@extends('layouts.base')

@section('meta_description', 'Add Tag :: Graphics Library')
@section('meta_title', 'Add Tag :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1>Add Tag</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            {{ Form::open( ['action' => 'tags.store', 'class' => 'form-horizontal'] ) }}
            
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