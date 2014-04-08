<div class="form-group @if($errors->first('name'))has-error@endif">
    {{ Form::label('name','Agency/Client Name', array('class' => 'control-label col-md-3')) }}
    <div class="col-md-9">
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder'=>'Agency/Client Name')) }}
    </div>
</div>
<div class="form-group @if($errors->first('shortname'))has-error@endif">
    {{ Form::label('shortname','Abbreviation', array('class' => 'control-label col-md-3')) }}
    <div class="col-md-9">
        {{ Form::text('shortname', Input::old('shortname'), array('class' => 'form-control', 'placeholder'=>'Abbreviation', 'maxlength'=>'5')) }}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-3 col-md-9">
        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    </div>
</div>