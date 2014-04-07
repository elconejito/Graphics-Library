<div class="alert alert-danger alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p><span class="glyphicon glyphicon-warning-sign"></span> <strong>Warning!</strong> The form has some errors!</p>
	<ul>
	@foreach( $errors->all('<li>:message</li>') as $message )
        {{ $message }}
    @endforeach
    </ul>
</div>