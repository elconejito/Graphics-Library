@extends('layouts.base')

@section('meta_description', 'Projects :: Little Rabbit Studios')
@section('meta_title', 'Projects :: Little Rabbit Studios')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>breadcrumbs</p>
            <h1>Projects</h1>
            <p>{{ link_to_action('ProjectsController@create', 'add new project') }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 table-responsive">
            @if ( $projects )
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
                        <td>0</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>no projects yet.</p>
            @endif
        </div>
        <div class="col-md-4">
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