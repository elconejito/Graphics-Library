<?php

class Graphic extends \Eloquent {

    // Add your validation rules here
    public static $rules = [
        'control_number' => 'required|alpha_num',
        'title' => 'required',
        'project_id' => 'required|integer',
        'image' => 'required|image'
    ];

    // Don't forget to fill this array
    protected $fillable = ['control_number','title','project_id','image','description'];

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