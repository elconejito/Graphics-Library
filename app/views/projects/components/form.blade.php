
            <div class="form-group @if($errors->first('agency'))has-error@endif">
                {{ Form::label('agency_id','Agency/Client', array('class' => 'control-label col-md-3')) }}
                <div class="col-md-9">
                    {{ Form::select('agency_id', $agencies, null, array('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group @if($errors->first('name'))has-error@endif">
            	{{ Form::label('name','Project Name', array('class' => 'control-label col-md-3')) }}
            	<div class="col-md-9">
            		{{ Form::text('name', null, array('class' => 'form-control', 'placeholder'=>'Project Name')) }}
            	</div>
            </div>

            <div class="form-group @if($errors->first('shortname'))has-error@endif">
                {{ Form::label('shortname','Short Name', array('class' => 'control-label col-md-3')) }}
                <div class="col-md-9">
                    {{ Form::text('shortname', null, array('class' => 'form-control', 'placeholder'=>'Short Name')) }}
                </div>
            </div>

            <div class="form-group @if($errors->first('control_prefix'))has-error@endif">
                {{ Form::label('control_prefix','Control Prefix', array('class' => 'control-label col-md-3')) }}
                <div class="col-md-9">
                    {{ Form::text('control_prefix', null, array('class' => 'form-control', 'placeholder'=>'Control Prefix')) }}
                </div>
            </div>

            <div class="form-group @if($errors->first('description'))has-error@endif">
                {{ Form::label('description','Description', array('class' => 'control-label col-md-3')) }}
                <div class="col-md-9">
                    {{ Form::textarea('description', null, array('class' => 'form-control', 'placeholder'=>'Description')) }}
                </div>
            </div>

            <div class="form-group @if($errors->first('submit_date'))has-error@endif">
                {{ Form::label('submit_date','Date Submitted', array('class' => 'control-label col-md-3')) }}
                <div class="col-md-3">
                    {{ Form::text('submit_date', null, array('class' => 'form-control', 'placeholder'=>'YYYY-MM-DD')) }}
                </div>
                <div class="col-md-3">
                    <p class="form-control-static">YYYY-MM-DD</p>
                </div>
            </div>

            <div class="form-group @if($errors->first('winloss'))has-error@endif">
                {{ Form::label('winloss','Win/Loss', array('class' => 'control-label col-md-3')) }}
                <div class="col-md-3">
                    {{ Form::select('winloss', ["0"=>"Unknown", "1"=>"Win", "2"=>"Loss"], null, array('class' => 'form-control')) }}
                </div>
            </div>
            
            <div class="form-group">
                {{ Form::label('tags','Tags', array('class' => 'control-label col-md-3')) }}
                <div class="col-md-9 tm-group">
                    <div class="tags-container"></div>
                    {{ Form::text('tags', null, array('class' => 'form-control tm-input tm-input-info', 'placeholder'=>'Tags', 'autocomplete'=>'off')) }}
                </div>
            </div>

            <div class="form-group">
            	<div class="col-md-offset-3 col-md-9">
            		{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
            	</div>
            </div>