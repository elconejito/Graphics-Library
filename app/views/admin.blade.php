@extends('layouts.base')

@section('meta_description', 'Administration :: Graphics Library')
@section('meta_title', 'Administration :: Graphics Library')

@section('content')
    
    <div class="container">
		<div class="row">
			<div class="col-md-12">
			    {{ Breadcrumbs::render() }}
				<h1>Administration</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
                <ul class="list-group">
				    <li class="list-group-item">{{ link_to_action('AgenciesController@create', 'Add Agency') }}</li>
                    <li class="list-group-item">{{ link_to_action('ProjectsController@create', 'Add Project') }}</li>
                </ul>
			</div>
		</div>  <!-- /row -->
	</div>
	
@stop