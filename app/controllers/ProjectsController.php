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
	    $agencies = Agency::all();

        // add breadcrumb before showing the view
        Breadcrumbs::addCrumb('All Projects');

	    return View::make('projects.index', compact('projects','agencies'));
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
        $data = Input::all();
        foreach ( $data as $k => $v ) {
            if ( $k == 'description' ) {
                $data[$k] = Purifier::clean($v);
            } else {
                $data[$k] = Purifier::clean($v,'text');
            }
        }

        $validator = Validator::make($data, Project::$rules);

	    if ( $validator->fails() )
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
        
        // we need the agency for association
        $agency = Agency::find($data['agency_id']);
        unset($data['agency_id']);     // remove this entry so it's not saved into the Model
        
        // create the new Project pre-loaded with data from Input
        $project = new Project($data);
        // associate the project with an agency
	    $project->agency()->associate($agency);
	    
	    // save the project
	    $project->save();
        
        // redirect back to the index
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
	    $graphics = $project->graphics()->take(6)->get();
        
        // add breadcrumb before showing the view
        Breadcrumbs::addCrumb('All Projects', action('ProjectsController@index'));
        Breadcrumbs::addCrumb($project->shortname);

        // return the view
	    return View::make('projects.show', compact('project','graphics'));
	}

	/**
	 * Show the form for editing the specified project.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$project = Project::findOrFail($id);
		$agencies = Agency::orderby('name')
            ->lists('name','id');
            
        // clean out the date if empty
        if ( $project->submit_date == '0000-00-00' ) $project->submit_date = '';

        Breadcrumbs::addCrumb('All Projects', action('ProjectsController@index'));
        Breadcrumbs::addCrumb($project->shortname, action('ProjectsController@show', [$id]));
        Breadcrumbs::addCrumb('Edit');

		return View::make('projects.edit')->withProject($project)->withAgencies($agencies);
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

        $data = Input::all();
        foreach ( $data as $k => $v ) {
            if ( $k == 'description' ) {
                $data[$k] = Purifier::clean($v);
            } else {
                $data[$k] = Purifier::clean($v,'text');
            }
        }

		$validator = Validator::make($data, Project::$rules);

        if ( $validator->fails() )
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        // we need the agency for association
        $agency = Agency::find($data['agency_id']);
        unset($data['agency_id']);     // remove this entry so it's not saved into the Model
        
        // associate the project with an agency
	    $project->agency()->associate($agency);
	    
	    // add tags if any
	    $tags = $project->getTagsByString(explode(',', $data["hidden-tags-input"]));
	    unset($data['hidden-tags-input']);     // remove this entry so it's not saved into the Model
	    unset($data['tags']);     // remove this entry so it's not saved into the Model
	    $project->tags()->sync($tags);
	    
	    $project->update($data);

		return Redirect::action('ProjectsController@show', [$id])->with('message','Changes have been saved.');
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
	
	public function getGraphics() {
	    
	}

}