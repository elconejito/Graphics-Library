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
    }
    
	public function index($project_id)
	{
	    $project = Project::findorfail($project_id);
	    $graphics = Graphic::where('project_id','=',$project_id)->get();

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
        return View::make('graphics.create', compact('project'));
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

	    return View::make('graphics.show', compact('graphic','project'));
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