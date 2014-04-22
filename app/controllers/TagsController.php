<?php

class TagsController extends \BaseController {

    /**
     * Instantiate a new TagsController instance.
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
	    Breadcrumbs::addCrumb('All Tags');
	    
	    $tags = Tag::all();
	    
		// return the view
		return View::make('tags.index', compact('tags'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// setup BreadCrumbs
        Breadcrumbs::addCrumb('All Tags', action('TagsController@index'));
	    Breadcrumbs::addCrumb('Add Tag');
	    
		// return the view
		return View::make('tags.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// setup my rules for validation
        $validator = Validator::make($data = Input::all(), Tag::$rules);
        // check validation
	    if ($validator->fails())
	    {
	        return Redirect::back()->withErrors($validator)->withInput();
	    }
	    
	    $data['name'] = Purifier::clean($data['name'],'text');
	    
        Tag::create($data);

	    if ( Input::has('new') ) :
	        return Redirect::route('tags.create')->with('message', 'The tag &quot;'.$data['name'].'&quot; has been created.');
	    else :
	        return Redirect::route('tags.index')->with('message', 'The tag &quot;'.$data['name'].'&quot; has been created.');
	    endif;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$tag = Tag::findOrFail($id);

        // setup BreadCrumbs
        Breadcrumbs::addCrumb('All Tags', action('TagsController@index'));
        Breadcrumbs::addCrumb($tag->name);

        // return the view
        return View::make('tags.show', compact('tag'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tag = Tag::findOrFail($id);

        // setup BreadCrumbs
        Breadcrumbs::addCrumb('All Tags', action('TagsController@index'));
        Breadcrumbs::addCrumb($tag->name);

        // return the view
        return View::make('tags.edit', compact('tag'));
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
        $validator = Validator::make($data = Input::all(), Tag::$rules);
        // check validation
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        Tag::findOrFail($id)->update($data);

        return Redirect::route('tags.index')->with('message', 'The tag &quot;'.$data['name'].'&quot; has been updated.');
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