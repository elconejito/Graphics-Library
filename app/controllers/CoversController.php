<?php

class CoversController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    /**
     * Instantiate a new ProjectsController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('auth');

        Breadcrumbs::addCrumb('Dashboard', '/gl');
        Breadcrumbs::addCrumb('All Projects', action('ProjectsController@index'));
        Breadcrumbs::setCssClasses('breadcrumb');
        Breadcrumbs::setDivider(null);
    }

	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($project_id)
	{
		//
        $project = Project::findorfail($project_id);

        // add breadcrumb before showing the view
        Breadcrumbs::addCrumb($project->shortname, action('ProjectsController@show', [$project_id]));
        Breadcrumbs::addCrumb('Add Cover');

        return View::make('covers.create', compact('project'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// setup my rules for validation
        $validator = Validator::make($data = Input::all(), Cover::$rules);
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
        $save_name = 'cover_'.preg_replace('/^((?![A-Za-z0-9_]).)*$/', '_', $project->shortname). '.' .Input::file('image')->getClientOriginalExtension();
        // in order, save the fullsize > main > thumbnail
        $image->save($save_path . 'fullsize/' . $save_name)
                ->resize(750,500,true)
                ->save($save_path . 'main/' . $save_name)
                ->grab(350)
                ->save($save_path . 'thumbnail/' . $save_name);

        // take the image object out of inputted data array and replace with new filename before saving
        $data["image"] = $save_name;

	    Cover::create($data);

	    return Redirect::route('projects.show', array('project'=>$project->id));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($project_id,$id)
	{
        $cover = Cover::findOrFail($id);
        $project = Project::findorfail($project_id);

        Breadcrumbs::addCrumb($project->shortname, action('ProjectsController@show', [$project_id]));
        Breadcrumbs::addCrumb('Cover');

        return View::make('covers.show', compact('cover','project'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($project_id,$id)
	{
		//
        $project = Project::findorfail($project_id);
        $cover = Cover::findOrFail($id);

        // add breadcrumb before showing the view
        Breadcrumbs::addCrumb($project->shortname, action('ProjectsController@show', [$project_id]));
        Breadcrumbs::addCrumb('Cover', action('CoversController@show', [$project->id]));
        Breadcrumbs::addCrumb('Edit');

        return View::make('covers.edit', compact('project','cover'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// setup my rules for validation
        $validator = Validator::make($data = Input::all(), Cover::$rules);
        // check validation
	    if ($validator->fails())
	    {
	        return Redirect::back()->withErrors($validator)->withInput();
	    }
	    
        // pull in the project
        $cover = Cover::findOrFail(Input::get('project_id'));
        $project = Project::findOrFail(Input::get('project_id'));
        
        // process the image
        $image = Image::make(Input::file('image')->getRealPath());
        $save_path = $project->getGraphicFolderPath();
        // Use the same filename as before
        $save_name = $cover->image;
        // in order, save the fullsize > main > thumbnail
        $image->save($save_path . 'fullsize/' . $save_name)
                ->resize(750,500,true)
                ->save($save_path . 'main/' . $save_name)
                ->grab(350)
                ->save($save_path . 'thumbnail/' . $save_name);
        
        // no need to update anything in the DB because those values are all the same

	    return Redirect::route('projects.show', array('project'=>$project->id));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}