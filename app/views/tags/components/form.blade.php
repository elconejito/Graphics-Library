
            <div class="form-group @if($errors->first('title'))has-error@endif">
            	{{ Form::label('name','Tag', array('class' => 'control-label col-md-3')) }}
            	<div class="col-md-9">
            		{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
            	</div>
            </div>
            <div class="form-group">
            	<div class="col-md-offset-3 col-md-3">
            		{{ Form::submit('Save', array('name' => 'save', 'class' => 'btn btn-primary')) }}
            	</div>
            	@if ( ends_with(Route::currentRouteName(),'create') )
            	<div class="col-md-3">
            		{{ Form::submit('Save &amp; Create Another', array('name' => 'new', 'class' => 'btn btn-default')) }}
            	</div>
            	@endif
            </div>
