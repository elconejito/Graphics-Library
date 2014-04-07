@extends('layouts.base')

@section('meta_description', 'Agencies :: Graphics Library')
@section('meta_title', 'Agencies :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1>All Agencies</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @if ( $agencies )
            <div class="navigation">
                <p>{{ $agencies->count() }} Agencies</p>
            </div>
            <ul class="list-group">
                @foreach ( $agencies as $agency )
                <li class="list-group-item">[{{ $agency->shortname }}] {{ $agency->name }}</li>
                @endforeach
            <ul>
            @else
            <p>Sorry, there are no agencies here</p>
            @endif
        </div>
        <div class="col-md-4">
            <nav class="navbar navbar-default toolbar" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <span class="navbar-text">Tools</span>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ action('AgenciesController@create') }}" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-plus"></span> agency</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
@stop