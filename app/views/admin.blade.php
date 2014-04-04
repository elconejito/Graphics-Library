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
				<p>in progress</p>
				<p>{{ link_to_action('AgenciesController@create', 'New Agency') }}</p>
				<p>{{ link_to_action('AgenciesController@index', 'List Agencies') }}</p>
			</div>
		</div>  <!-- /row -->
	</div>
	
@stop