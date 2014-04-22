<?php

class Tag extends \Eloquent {
	// Add your validation rules here
    public static $rules = [
        'name' => 'required|alpha_spaces|max:255',
    ];
    
    // Don't forget to fill this array
	protected $fillable = ['name'];
	
	public function projects() {
	    return $this->belongsToMany('Project');
	}
}