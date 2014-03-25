{{ Form::open(array(
	'url' => 'contact',
	'class' => 'form-horizontal'
)) }}

@if( count($errors->all()) > 0 )
<div class="alert alert-danger alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p><span class="glyphicon glyphicon-warning-sign"></span> <strong>Warning!</strong> The form has some errors!</p>
	<ul>
	@foreach( $errors->all('<li>:message</li>') as $message )
        {{ $message }}
    @endforeach
    </ul>
</div>
@endif

<div class="form-group @if($errors->first('name'))has-error@endif">
	{{ Form::label('name','Your Name', array('class' => 'control-label col-md-2')) }}
	<div class="col-md-10">
		{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
	</div>
</div>
<div class="form-group @if($errors->first('email'))has-error@endif">
	{{ Form::label('email','Your Email', array('class' => 'control-label col-md-2')) }}
	<div class="col-md-10">
		{{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
	</div>
</div>
<div class="form-group @if($errors->first('message'))has-error@endif">
	{{ Form::label('comment','Your Message', array('class' => 'control-label col-md-2')) }}
	<div class="col-md-10">
		{{ Form::textarea('comment', Input::old('comment'), array('class' => 'form-control')) }}
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		{{ Form::submit('Send', array('class' => 'btn btn-primary')) }}
	</div>
</div>

{{ Form::close() }}