@extends('layouts.base')

@section('meta_description', 'Tags :: Graphics Library')
@section('meta_title', 'Tags :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1>All Tags</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @if ( $tags )
            <div class="navigation">
                <p>{{ $tags->count() }} Tags</p>
            </div>
            <ul class="list-group">
                @foreach ( $tags as $tag )
                <li class="list-group-item">[{{ $tag->name }}] {{ link_to_action('TagsController@show', $tag->name, $tag->id) }} <a href="{{ action('TagsController@edit', $tag->id) }}" class="btn btn-default btn-xs pull-right"><span class="glyphicon glyphicon-pencil"></span></a></li>
                @endforeach
            <ul>
            @else
            <p>Sorry, there are no tags here</p>
            @endif
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>
@stop