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
                <p>{{ count($projects) }} of {{ Project::count() }} projects</p>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th># of Graphics</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $projects as $project )
                        <tr>
                            <td>{{ link_to_action('ProjectsController@show', $project->name, array('id'=>$project->id)) }}</td>
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
                            <li><a href="{{ action('ProjectsController@create') }}" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-plus"></span> project</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Search / Filters</h3>
                </div>
                <div class="panel-body">
                    <p>search box here</p>
                    <p>some filters here</p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop