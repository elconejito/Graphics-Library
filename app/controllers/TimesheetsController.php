<?php

class TimesheetsController extends \BaseController {

	/**
	 * Display a listing of timesheets
	 *
	 * @return Response
	 */
	public function index()
	{
	    $timesheets = Timesheet::all();

	    return View::make('timesheets.index', compact('timesheets'));
	}

	/**
	 * Show the form for creating a new timesheet
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('timesheets.create');
	}

	/**
	 * Store a newly created timesheet in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    $validator = Validator::make($data = Input::all(), Timesheet::$rules);

	    if ($validator->fails())
	    {
	        return Redirect::back()->withErrors($validator)->withInput();
	    }

	    Timesheet::create($data);

	    return Redirect::route('timesheets.index');
	}

	/**
	 * Display the specified timesheet.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    $timesheet = Timesheet::findOrFail($id);

	    return View::make('timesheets.show', compact('timesheet'));
	}

	/**
	 * Show the form for editing the specified timesheet.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$timesheet = Timesheet::find($id);

		return View::make('timesheets.edit', compact('timesheet'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$timesheet = Timesheet::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Timesheet::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

		$timesheet->update($data);

		return Redirect::route('timesheets.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Timesheet::destroy($id);

		return Redirect::route('timesheets.index');
	}

}