            <div class="form-group @if($errors->first('path'))has-error@endif">
                {{ Form::label('image','Image', array('class' => 'control-label col-md-2')) }}
                <div class="col-md-10">
                    {{ Form::file('image') }}
                </div>
            </div>
            <div class="form-group">
            	<div class="col-sm-offset-2 col-sm-10">
            		{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
            	</div>
            </div>