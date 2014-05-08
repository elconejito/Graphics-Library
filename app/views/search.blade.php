@extends('layouts.base')

@section('meta_description', 'Search :: Graphics Library')
@section('meta_title', 'Search :: Graphics Library')

@section('content')
    
    <div class="container">
		<div class="row">
			<div class="col-md-12">
			    {{ Breadcrumbs::render() }}
				<h1>Search</h1>
			</div>
		</div>
		<div class="row">
    		<div class="col-md-8">
    			<h2>Graphics</h2>
    			
    			<h2>Projects</h2>
    			@if ( $projects )
                <div class="navigation">
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
                                <td>{{ $project->agency->shortname }}</td>
                                <td>{{ link_to_action('ProjectsController@show', $project->name, ['id'=>$project->id]) }}</td>
                                <td>{{ $project->graphics->count() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p>no projects yet.</p>
                @endif
    			
    			<h2>Tags</h2>
    			
    			<h2>Agencies</h2>
    		</div>
    		<div class="col-md-4">
    		    <h3>Search<br /><small>Search by Keyword</small></h3>
				@include('components.forms.search')
    		</div>
		</div>  <!-- /row -->
	</div>
	
@stop