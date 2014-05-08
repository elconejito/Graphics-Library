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
    
    public function project() {
        return $this->belongsTo('Project');
    }
    
    public function tags() {
	    return $this->belongsToMany('Tag');
	}
	
	public function scopeSearch($query, $search) {
        return $query->where('title', 'LIKE', "%$search%")
            ->orWhere('control_number', 'LIKE', "%$search%")
            ->orWhere('description', 'LIKE', "%$search%");
    }

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

    public function getDeleteText() {
        $text = '<h3><span class="glyphicon glyphicon-warning-sign"></span> CAUTION!</h3>
<p>You are about to delete the graphic &quot;<strong>'.$this->control_number.'_'.$this->title.'</strong>&quot;.</p>
<p>Are you REALLY SURE you wish to delete this graphic? This cannot be undone. If you are really sure, then click the delete button below.</p>
<p>If you are not sure, remain calm, just hit the cancel button below or press the escape key and slowly back away from the keyboard...</p>';
        // append the hidden form
        $text .= Form::open( ['method'=>'DELETE', 'action' => 'projects.graphics.destroy', 'id' => 'deleteGraphic'] );
        $text .= Form::hidden('id', $this->id);
        $text .= Form::hidden('project_id', $this->project_id);
        $text .= Form::close();

        // return the text
        return $text;
    }

    public function getDeleteButtons() {
        $buttons = [
            'delete' => [
                'text' => 'DELETE',
                'class' => 'btn btn-danger post',
                'data' => [
                    'target' => '#deleteGraphic'
                ]
            ],
            'close' => [
                'text' => 'Cancel',
                'class' => 'btn btn-default',
                'data' => [
                    'dismiss' => 'modal'
                ]
            ]
        ];
        return $buttons;
    }
}