<?php

class Agency extends \Eloquent {
    // Add your validation rules here
    public static $rules = [
        'name' => 'required|max:255',
        'shortname' => 'required|alpha_num|max:5',
    ];
    
    // Don't forget to fill this array
	protected $fillable = ['name','shortname'];
}