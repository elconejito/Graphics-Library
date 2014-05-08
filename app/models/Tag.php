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
	
	public function graphics() {
	    return $this->belongsToMany('Graphic');
	}
	
	public function scopeSearch($query, $search) {
        return $query->where('name', 'LIKE', "%$search%");
    }
}