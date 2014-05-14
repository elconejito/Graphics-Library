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
                {{ $tags->links('components.pagination') }}
                <p>{{ $tags->count() }} of {{ Tag::count() }} tags</p>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Tag Name</th>
                        <th># of Graphics</th>
                        <th># of Projects</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ( $tags as $tag )
                    <tr>
                        <td><a href="{{ action('TagsController@edit', ['id'=>$tag->id]) }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></td>
                        <td>{{ link_to_action('TagsController@show', $tag->name, ['id'=>$tag->id]) }}</td>
                        <td>{{ $tag->graphics()->count() }}</td>
                        <td>{{ $tag->projects()->count() }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>Sorry, there are no tags here</p>
            @endif
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tag Tools</h3>
                </div>
                <div class="panel-body">
                    <div class="btn-group actions">
                        <a href="{{ action('TagsController@create') }}" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-plus"></span> tag</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Search / Filters</h3>
                </div>
                <div class="panel-body">
                    @include('tags.components.filters')
                </div>
            </div>
        </div>
    </div>
</div>
@stop