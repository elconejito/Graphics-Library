<?php

class ProjectsController extends \BaseController {

	/**
	 * Display a listing of projects
	 *
	 * @return Response
	 */
	
	/**
     * Instantiate a new ProjectsController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('auth');
    }
    
	public function index()
	{
	    $projects = Project::all();

	    return View::make('projects.index', compact('projects'));
	}

	/**
	 * Show the form for creating a new project
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('projects.create');
	}

	/**
	 * Store a newly created project in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    $validator = Validator::make($data = Input::all(), Project::$rules);

	    if ($validator->fails())
	    {
	        return Redirect::back()->withErrors($validator)->withInput();
	    }

        // create folder for images
        $data['graphicsfolder'] = preg_replace('/\s+/', '_', $data['shortname']);
        $dirPath = public_path().'/data/'.$data['graphicsfolder'];
        if ( ! File::makeDirectory($dirPath) ) {
            return Redirect::back()->withInput()->message('Could not create directory');
        }

        // save the project
	    Project::create($data);

	    return Redirect::route('projects.index');
	}

	/**
	 * Display the specified project.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    $project = Project::findOrFail($id);
	    $graphics = Graphic::where('project_id','=',$id)->take(6)->get();
	    $cover = Cover::where('project_id','=',$id)->first();

	    return View::make('projects.show', compact('project','graphics','cover'));
	}

	/**
	 * Show the form for editing the specified project.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$project = Project::find($id);

		return View::make('projects.edit', compact('project'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$project = Project::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Project::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

		$project->update($data);

		return Redirect::route('projects.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Project::destroy($id);

		return Redirect::route('projects.index');
	}
	
	public function countGraphics() {
	    return Graphic::where('project_id','=',$this->id)->count();
	}
	
	public function getGraphics() {
	    
	}

}