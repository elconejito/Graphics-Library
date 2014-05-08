{{ Form::open( [ 'url' => 'search', 'method' => 'GET', 'class' => 'form-inline' ] ) }}

@if( count($errors->all()) > 0 )
    @include('components.errors')
@endif

<div class="input-group @if($errors->first('title'))has-error@endif">
	{{ Form::label('search','Graphic Title', array('class' => 'sr-only')) }}
	{{ Form::text('q', Input::old('q'), array('class' => 'form-control', 'placeholder'=>'Enter Keyword')) }}
	<span class="input-group-btn">
	    {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
    </span>
</div>
<div class="form-group">
	
</div>

{{ Form::close() }}