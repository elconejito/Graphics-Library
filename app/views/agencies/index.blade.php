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
                {{ $agencies->links('components.pagination') }}
                <p>{{ $agencies->count() }} of {{ Agency::count() }} agencies</p>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Abbrev</th>
                        <th>Agency Name</th>
                        <th># of Projects</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ( $agencies as $agency )
                    <tr>
                        <td><a href="{{ action('AgenciesController@edit', $agency->id) }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></td>
                        <td>{{ $agency->shortname }}</td>
                        <td>{{ link_to_action('AgenciesController@show', $agency->name, $agency->id) }}</td>
                        <td>{{ $agency->projects()->count() }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>Sorry, there are no agencies here</p>
            @endif
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Agency Tools</h3>
                </div>
                <div class="panel-body">
                    <div class="btn-group actions">
                        <a href="{{ action('AgenciesController@create') }}" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-plus"></span> agency</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Search / Filters</h3>
                </div>
                <div class="panel-body">
                    @include('agencies.components.filters')
                </div>
            </div>
        </div>
    </div>
</div>
@stop