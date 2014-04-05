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

        Breadcrumbs::addCrumb('Dashboard', '/gl');
        Breadcrumbs::setCssClasses('breadcrumb');
        Breadcrumbs::setDivider(null);
    }
    
	public function index()
	{
	    $projects = Project::paginate(10);

        // add breadcrumb before showing the view
        Breadcrumbs::addCrumb('All Projects');

	    return View::make('projects.index', compact('projects'));
	}

	/**
	 * Show the form for creating a new project
	 *
	 * @return Response
	 */
	public function create()
	{
        $agencies = Agency::orderby('name')
            ->lists('name','id');

        Breadcrumbs::addCrumb('All Projects', action('ProjectsController@index'));
        Breadcrumbs::addCrumb('Add Project');

        return View::make('projects.create', compact('agencies'));
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
        if ( ! File::exists($dirPath) )
            if ( ! File::makeDirectory($dirPath) ) {
                return Redirect::back()->withInput()->message('Could not create directory');
            };

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
        $agencies = Agency::orderby('name')
            ->lists('name','id');

        // add breadcrumb before showing the view
        Breadcrumbs::addCrumb('All Projects', action('ProjectsController@index'));
        Breadcrumbs::addCrumb($project->shortname);

        // return the view
	    return View::make('projects.show', compact('project','graphics','cover','agencies'));
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