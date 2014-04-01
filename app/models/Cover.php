<?php

class Cover extends \Eloquent {
    // Add your validation rules here
    public static $rules = [
        'project_id' => 'required|integer',
        'image' => 'required|image'
    ];
    
	protected $fillable = ['project_id','image'];
	
	public function getImageFullsizePath() {
        // get the project so we can get it's folder
        $project = Project::find($this->project_id);

        return 'data/' .$project->graphicsfolder. '/fullsize/' .$this->image;
    }
    
    public function getImageMainPath() {
        // get the project so we can get it's folder
        $project = Project::find($this->project_id);

        return 'data/' .$project->graphicsfolder. '/main/' .$this->image;
    }
    
    public function getImageThumbnailPath() {
        // get the project so we can get it's folder
        $project = Project::find($this->project_id);

        return 'data/' .$project->graphicsfolder. '/thumbnail/' .$this->image;
    }
}