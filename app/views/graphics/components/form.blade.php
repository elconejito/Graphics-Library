
            <div class="form-group @if($errors->first('title'))has-error@endif">
            	{{ Form::label('title','Graphic Title', array('class' => 'control-label col-md-3')) }}
            	<div class="col-md-9">
            		{{ Form::text('title', Input::old('title'), array('class' => 'form-control', 'placeholder'=>'Graphic Title')) }}
            	</div>
            </div>
            <div class="form-group @if($errors->first('control_number'))has-error@endif">
                {{ Form::label('control_number','Control Number', array('class' => 'control-label col-md-3')) }}
                <div class="col-md-9">
                    {{ Form::text('control_number', Input::old('control_number', $next_control), array('class' => 'form-control', 'placeholder'=>'Control Number')) }}
                </div>
            </div>
            <div class="form-group @if($errors->first('description'))has-error@endif">
                {{ Form::label('description','Description', array('class' => 'control-label col-md-3')) }}
                <div class="col-md-9">
                    {{ Form::textarea('description', Input::old('description'), array('class' => 'form-control', 'placeholder'=>'Description')) }}
                </div>
            </div>
            <div class="form-group @if($errors->first('path'))has-error@endif">
                {{ Form::label('image','Image', array('class' => 'control-label col-md-3')) }}
                <div class="col-md-9">
                    {{ Form::file('image') }}
                </div>
            </div>
            <div class="form-group">
            	<div class="col-md-offset-3 col-md-9">
            		{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
            	</div>
            </div>
