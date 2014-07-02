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

    /**
     * @return string
     */
    public function toHTML() {
        return '<span class="tm-tag"><span><a href="'.action('TagsController@show', $this->id).'">'.$this->name.'</a></span></span>';
    }
    
    /**
     * @param array $strings
     * @return mixed
     */
    public static function getTagsByString(Array $strings) {
        return Tag::whereIn('name', $strings)->get();
    }
}