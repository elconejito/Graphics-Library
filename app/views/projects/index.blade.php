@extends('layouts.base')

@section('meta_description', 'All Projects :: Graphics Library')
@section('meta_title', 'All Projects :: Graphics Library')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{ Breadcrumbs::render() }}
            <h1>All Projects</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @if ( $projects )
            <div class="navigation">
                {{ $projects->links('components.pagination') }}
                <p>{{ $projects->count() }} of {{ Project::count() }} projects</p>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Agency</th>
                            <th>Project Name</th>
                            <th># of Graphics</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $projects as $project )
                        <tr>
                            <td>{{ $agencies->find($project->agency)->shortname }}</td>
                            <td>{{ link_to_action('ProjectsController@show', $project->name, ['id'=>$project->id]) }}</td>
                            <td>{{ $project->countGraphics() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>no projects yet.</p>
            @endif
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Projects Tools</h3>
                </div>
                <div class="panel-body">
                    <div class="btn-group actions">
                        <a href="{{ action('ProjectsController@create') }}" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-plus"></span> project</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Search / Filters</h3>
                </div>
                <div class="panel-body">
                    @include('projects.components.filters')
                </div>
            </div>
        </div>
    </div>
</div>
@stop