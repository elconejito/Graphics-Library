@extends('layouts.base')

@section('meta_description', 'Contact :: Graphics Library')
@section('meta_title', 'Contact :: Graphics Library')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Contact Us</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<p>Ask us (almost) anything!</p>
				<p>For a quote for our services or a general question please fill out the contact form and we'll get back to you shortly.</p>
			</div>
			<div class="col-md-8">
				@include('components.forms.contact')
			</div>
		</div>
	</div>  <!-- /container -->
@stop