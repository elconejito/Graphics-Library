<?php

class GraphicsController extends \BaseController {

	/**
	 * Display a listing of graphics
	 *
	 * @return Response
	 */
	
	/**
     * Instantiate a new GraphicsController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('csrf', array('on' => 'post'));


        Breadcrumbs::addCrumb('Dashboard', '/gl');
        Breadcrumbs::addCrumb('All Projects', action('ProjectsController@index'));
        Breadcrumbs::setCssClasses('breadcrumb');
        Breadcrumbs::setDivider(null);
    }
    
	public function index($project_id)
	{
	    $project = Project::findorfail($project_id);
	    $graphics = Graphic::where('project_id','=',$project_id)->paginate(8);

        // add breadcrumb before showing the view
        Breadcrumbs::addCrumb($project->shortname, action('ProjectsController@show', [$project_id]));
        Breadcrumbs::addCrumb('All Graphics');

	    return View::make('graphics.index', compact('graphics','project'));
	}

	/**
	 * Show the form for creating a new graphic
	 *
	 * @param  int  $project_id
	 * @return Response
	 */
	public function create($project_id)
	{
	    $project = Project::findorfail($project_id);

        // get the last control from DB
        $next_control = substr(Graphic::where('project_id','=',$project_id)->max('control_number'), -3, 3);
        // prepend the control prefix and pad the number to 3 digits
        $next_control = $project->control_prefix . str_pad($next_control + 1, 3, '0', STR_PAD_LEFT);
        
        // add breadcrumb before showing the view
        Breadcrumbs::addCrumb($project->shortname, action('ProjectsController@show', [$project_id]));
        Breadcrumbs::addCrumb('All Graphics', action('GraphicsController@index', [$project_id]));
        Breadcrumbs::addCrumb('Add Graphic');

        return View::make('graphics.create', compact('project','next_control'));
	}

	/**
	 * Store a newly created graphic in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    // setup my rules for validation
	    $validator = Validator::make($data = Input::all(), Graphic::$rules);
        // check validation
	    if ($validator->fails())
	    {
	        return Redirect::back()->withErrors($validator)->withInput();
	    }

        // pull in the project
        $project = Project::findOrFail($data['project_id']);
        unset($data['project_id']);     // remove this entry so it's not saved into the Model
        
        // process the image
        $image = Image::make(Input::file('image')->getRealPath());
        $save_path = $project->getGraphicFolderPath();
        // #TODO find a better cleaner regex
        $save_name = $data['control_number'].'_'.preg_replace('/[^a-zA-Z0-9]+/', '_', $data['title']). '.' .Input::file('image')->getClientOriginalExtension();
        // in order, save the fullsize > main > thumbnail
        $image->save($save_path . 'fullsize/' . $save_name)
                ->resize(750,500,true)
                ->save($save_path . 'main/' . $save_name)
                ->grab(250)
                ->save($save_path . 'thumbnail/' . $save_name);

        // take the image object out of inputted data array and replace with new filename before saving
        $data["image"] = $save_name;
        
        // create the graphic with loaded data
        $graphic = new Graphic($data);
        
        // associate the graphic with a project
	    $graphic->project()->associate($project);
	    
	    // and save
	    $graphic->save();
	    
	    if ( Input::has('new') ) :
	        return Redirect::route('projects.graphics.create', array('project'=>$project->id));
	    else :
	        return Redirect::route('projects.graphics.index', array('project'=>$project->id));
	    endif;
	}

	/**
	 * Display the specified graphic.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($project_id,$id)
	{
	    $graphic = Graphic::findOrFail($id);
        $project = $graphic->project;
        $agencies = Agency::lists('name','id');

        // add breadcrumb before showing the view
        Breadcrumbs::addCrumb($project->shortname, action('ProjectsController@show', [$project_id]));
        Breadcrumbs::addCrumb('All Graphics', action('GraphicsController@index', [$project_id]));
        Breadcrumbs::addCrumb($graphic->control_number);

	    return View::make('graphics.show', compact('graphic','project','agencies'));
	}

	/**
	 * Show the form for editing the specified graphic.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($project_id,$id)
	{
		$graphic = Graphic::findOrFail($id);
        $project = $graphic->project;
        
        // just need this variable defined for edit page
        $next_control = $graphic->control_number;
        
        // add breadcrumb before showing the view
        Breadcrumbs::addCrumb($project->shortname, action('ProjectsController@show', [$project_id]));
        Breadcrumbs::addCrumb('All Graphics', action('GraphicsController@index', [$project_id]));
        Breadcrumbs::addCrumb($graphic->control_number, action('GraphicsController@show', [$project_id,$id]));
        Breadcrumbs::addCrumb('Edit');
        
		return View::make('graphics.edit', compact('graphic','project','next_control'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($project_id,$id)
	{
	    // setup my rules for validation
	    // load the default rules for this model
	    $rules = Graphic::$rules;
	    // make image not required
	    $rules['image'] = 'image';
	    $validator = Validator::make($data = Input::all(), $rules);
        // check validation
	    if ($validator->fails())
	    {
	        return Redirect::back()->withErrors($validator)->withInput();
	    }
	    
		// pull in the project & graphic
        $graphic = Graphic::findOrFail($id);
        $project = $graphic->project;
        
        // if the title changed, move the image file to new location
        if ( $graphic->title != $data['title'] || $graphic->control_number != $data['control_number'] ) {
            $save_path = $project->getGraphicFolderPath();
            $new_name = $data['control_number'].'_'.preg_replace('/[^a-zA-Z0-9]+/', '_', $data['title']). '.' .File::extension($graphic->image);
            // move the images
            if ( File::exists($save_path . 'fullsize/' . $graphic->image) )
                File::move(
                    $save_path . 'fullsize/' . $graphic->image,
                    $save_path . 'fullsize/' . $new_name
                );
            if ( File::exists($save_path . 'main/' . $graphic->image) )
                File::move(
                    $save_path . 'main/' . $graphic->image,
                    $save_path . 'main/' . $new_name
                );
            if ( File::exists($save_path . 'thumbnail/' . $graphic->image) )
                File::move(
                    $save_path . 'thumbnail/' . $graphic->image,
                    $save_path . 'thumbnail/' . $new_name
                );
            $data["image"] = $new_name;
        } else {
            $data["image"] = $graphic->image;
        }
        
        // if there is an image attached, upload it to replace current
        if ( Input::hasFile('image') ) {
            // process the image
            $image = Image::make(Input::file('image')->getRealPath());
            // build the path
            $save_path = $project->getGraphicFolderPath();
            // create the filename
            $save_name = $data['control_number'].'_'.preg_replace('/[^a-zA-Z0-9]+/', '_', $data['title']). '.' .Input::file('image')->getClientOriginalExtension();
            // in order, save the fullsize > main > thumbnail
            $image->save($save_path . 'fullsize/' . $save_name)
                    ->resize(750,500,true)
                    ->save($save_path . 'main/' . $save_name)
                    ->grab(250)
                    ->save($save_path . 'thumbnail/' . $save_name);
            
            // take the image object out of inputted data array and replace with new filename before saving
            $data["image"] = $save_name;
        }
        
	    $graphic->update($data);
	    
		return Redirect::route('projects.graphics.show', compact('project_id','id'));
	}

    /**
     * Display the specified graphic.
     *
     * @param  int  $id
     * @return Response
     */
    public function getDelete($id)
    {
        $graphic = Graphic::findOrFail($id);
        $project = $graphic->project;
        $modal = new Modal();
        $modal->title = 'Delete '.$graphic->title.'?';
        $modal->body = $graphic->getDeleteText();
        $modal->buttons = $graphic->getDeleteButtons();

        return View::make('components.modal', compact('graphic','project','modal'));
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		$result = Graphic::destroy(Input::get('id'));

        if ( $result ) {
            Session::flash('message', 'Graphic has been deleted');
            $response = [
                'status' => '1',
                'code' => '200',
                'message' => 'success',
                'data' => [
                    'action' => 'redirect',
                    'url' => action('GraphicsController@index', Input::get('project_id'))
                ]
            ];
        } else {
            $response = [
                'status' => '0',
                'code' => '300',
                'message' => 'fail',
                'data' => ''
            ];
        }
        return Response::json($response);
	}

}