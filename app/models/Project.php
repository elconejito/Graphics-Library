<?php

class Project extends \Eloquent {
    public $arWinLoss = [
        "0" => "Unknown",
        "1" => "Win",
        "2" => "Loss"
        ];

    // Add your validation rules here
    public static $rules = [
        'name' => 'required',
        'shortname' => 'required',
        'control_prefix' => 'required|alpha_num',
        'submit_date' => 'date',
        'winloss' => 'required|integer',
        'agency_id' => 'required|integer'
    ];

    // Don't forget to fill this array
    protected $fillable = ['name','shortname','control_prefix','description','graphicsfolder','submit_date','winloss'];
    
    public function cover() {
        return $this->hasOne('Cover');
    }
    
    public function graphics() {
        return $this->hasMany('Graphic');
    }
    
    public function tags() {
        return $this->belongsToMany('Tag');
    }
    
    public function agency() {
        return $this->belongsTo('Agency');
    }
    
    public function getGraphicFolderPath() {
        // get the root for this project
        $path = public_path().'/data/'.$this->graphicsfolder.'/';
        
        // check if proper folders exist > main, thumbnails, fullsize. create if not there
        if ( ! File::exists($path) ) File::makeDirectory($path);
        if ( ! File::exists($path . 'thumbnail/') ) File::makeDirectory($path . 'thumbnail/');
        if ( ! File::exists($path . 'main/') ) File::makeDirectory($path . 'main/');
        if ( ! File::exists($path . 'fullsize/') ) File::makeDirectory($path . 'fullsize/');
        
        //return the path
        return $path;
    }

    public function countGraphics() {
        return Graphic::where('project_id','=',$this->id)->count();
    }
    
    public function scopeSearch($query, $search) {
        return $query->where('name', 'LIKE', "%$search%")
            ->orWhere('shortname', 'LIKE', "%$search%")
            ->orWhere('description', 'LIKE', "%$search%");
    }
}