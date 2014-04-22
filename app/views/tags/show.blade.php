@extends('layouts.base')

@section('meta_description', $tag->name.' :: Graphics Library')
@section('meta_title', $tag->name.' :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1><small>Tag</small><br />{{ $tag->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
@stop