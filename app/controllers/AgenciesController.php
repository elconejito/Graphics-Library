<?php

class AgenciesController extends \BaseController {

    /**
     * Instantiate a new AgenciesController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('auth');

        Breadcrumbs::addCrumb('Dashboard', '/gl');
        Breadcrumbs::setCssClasses('breadcrumb');
        Breadcrumbs::setDivider(null);
    }
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// setup BreadCrumbs
	    Breadcrumbs::addCrumb('All Agencies');
	    
		// return the view
		return View::make('agencies.index', [
		    "agencies" => Agency::all()
		    ]
		);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    // setup BreadCrumbs
        Breadcrumbs::addCrumb('All Agencies', action('AgenciesController@index'));
	    Breadcrumbs::addCrumb('Add Agency');
	    
		// return the view
		return View::make('agencies.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// setup my rules for validation
        $validator = Validator::make($data = Input::all(), Agency::$rules);
        // check validation
	    if ($validator->fails())
	    {
	        return Redirect::back()->withErrors($validator)->withInput();
	    }

        Agency::create($data);

	    return Redirect::route('admin');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $agency = Agency::findOrFail($id);
        $projects = Project::where('agency',$id)->paginate(10);

        // setup BreadCrumbs
        Breadcrumbs::addCrumb('All Agencies', action('AgenciesController@index'));
        Breadcrumbs::addCrumb($agency->shortname);

        // return the view
        return View::make('agencies.show', compact('agency','projects'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $agency = Agency::findOrFail($id);

        // setup BreadCrumbs
        Breadcrumbs::addCrumb('All Agencies', action('AgenciesController@index'));
        Breadcrumbs::addCrumb($agency->shortname);

        // return the view
        return View::make('agencies.edit', compact('agency'));
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
        $validator = Validator::make($data = Input::all(), Agency::$rules);
        // check validation
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        Agency::findOrFail($id)->update($data);

        return Redirect::route('agencies.index');
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