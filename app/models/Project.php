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
        'control_prefix' => 'required|alpha_num',
        'shortname' => 'required',
        'submit_date' => 'date',
        'winloss' => 'integer'
    ];

    // Don't forget to fill this array
    protected $fillable = ['name','control_prefix','shortname','graphicsfolder','submit_date','winloss'];
    
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
}