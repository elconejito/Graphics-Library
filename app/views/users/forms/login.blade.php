{{ Form::open( array( 'url' => 'users/login', 'class' => 'form-horizontal' )) }}

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

<div class="form-group @if($errors->first('email'))has-error@endif">
    {{ Form::label('email','Email', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::email('email', Input::old('email'), array('class' => 'form-control', 'placeholder'=>'Email')) }}
    </div>
</div>
<div class="form-group @if($errors->first('password'))has-error@endif">
    {{ Form::label('password','Password', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::password('password', array('class' => 'form-control', 'placeholder'=>'Password')) }}
    </div>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		{{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
	</div>
</div>

{{ Form::close() }}