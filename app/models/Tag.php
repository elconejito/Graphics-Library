<?php

class Tag extends \Eloquent {
	protected $fillable = [];
	
	public function projects() {
	    return $this->belongsToMany('Project');
	}
}