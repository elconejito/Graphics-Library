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
        // $next_control = $next_control + 1;

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
        $project = Project::findOrFail(Input::get('project_id'));
        
        // process the image
        $image = Image::make(Input::file('image')->getRealPath());
        $save_path = $project->getGraphicFolderPath();
        // #TODO find a better cleaner regex
        $save_name = $data['control_number'].'_'.preg_replace('/^((?![A-Za-z0-9_]).)*$/', '_', $data['title']). '.' .Input::file('image')->getClientOriginalExtension();
        // in order, save the fullsize > main > thumbnail
        $image->save($save_path . 'fullsize/' . $save_name)
                ->resize(750,500,true)
                ->save($save_path . 'main/' . $save_name)
                ->grab(250)
                ->save($save_path . 'thumbnail/' . $save_name);

        // take the image object out of inputted data array and replace with new filename before saving
        $data["image"] = $save_name;

	    Graphic::create($data);

	    return Redirect::route('projects.graphics.index', array('project'=>$project->id));
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
        $project = Project::findorfail($project_id);
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
	public function edit($id)
	{
		$graphic = Graphic::find($id);

		return View::make('graphics.edit', compact('graphic'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$graphic = Graphic::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Graphic::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

		$graphic->update($data);

		return Redirect::route('graphics.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Graphic::destroy($id);

		return Redirect::route('graphics.index');
	}

}