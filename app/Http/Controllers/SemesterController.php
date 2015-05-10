<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Semester;
use App\Services\Shortcut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SemesterController extends GradebookController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Shortcut $appData)
	{
		return view('app.semester.index')->withSemesters($appData->getActiveSchool()->semesters);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('app.semester.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

    public function change(Requests\ChangeSemesterRequest $request, Semester $semester)
    {
        \Setting::set('activeSemesterId', $semester->id);
        \Setting::save();

        return redirect()->back();

    }
}
