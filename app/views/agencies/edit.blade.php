@extends('layouts.base')

@section('meta_description', 'Edit Agency :: Graphics Library')
@section('meta_title', 'Edit Agency :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1>Edit Agency</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            {{ Form::model( $agency, ['method' => 'PUT', 'action' => ['agencies.update', $agency->id], 'class' => 'form-horizontal'] ) }}

            @if( count($errors->all()) > 0 )
                @include('components.errors')
            @endif

            @include('agencies.components.form')

            {{ Form::close() }}
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
@stop