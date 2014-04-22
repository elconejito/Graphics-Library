{{ Form::open( ['class' => 'form-inline'] ) }}

@if( count($errors->all()) > 0 )
    @include('components.errors')
@endif

<div class="input-group @if($errors->first('title'))has-error@endif">
	{{ Form::label('search','Graphic Title', array('class' => 'sr-only')) }}
	{{ Form::text('search', Input::old('search'), array('class' => 'form-control', 'placeholder'=>'Search')) }}
	<span class="input-group-btn">
	    {{ Form::submit('Search', array('name' => 'search', 'class' => 'btn btn-primary')) }}
    </span>
</div>
<div class="form-group">
	
</div>

{{ Form::close() }}