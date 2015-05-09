<?php namespace App\Http\Controllers;

use App\Grade;
use App\Http\Requests;

use App\Services\Shortcut;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class GradeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Shortcut $shortcut)
	{
		return view('app.grade.index')->withGrades($shortcut->getGrades());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Shortcut $gbRequest)
	{
		return view('app.grade.create')->withSubjects($gbRequest->getSubjects());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\StoreGradeRequest $request)
	{
		$grade = new Grade();
        $grade->grade = Input::get('grade');
        $grade->subject_id = Input::get('subject');
        $grade->user_id = Auth::id();
        $grade->save();

        $gradeVal = $grade->grade;
        $subject = $grade->subject->name;
        return Redirect::to('/dashboard')->withMessage("Note <strong>$gradeVal</strong> in <strong>$subject</strong> wurde erfasst. <a class='alert-link' href='/grade/create'>Weitere Note erfassen.</a>");
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
	public function destroy(Requests\DestroyGradeRequest $request, Shortcut $gbRequest, $gradeId)
	{
        Log::info($gradeId);
		$grade = Grade::find($gradeId);
        $grade->delete();

        $restoreForm = sprintf("<form id='restore-grade' method='post' action='%s/grade/restore/%s'><input type='hidden' name='_token' value='%s'></form>", $gbRequest->getBasePath(), $grade->id, csrf_token());
        $restoreLink = sprintf("<a href='#' class='alert-link' onclick='$(\"#restore-grade\").submit();return false;'>Rückgängig.</a>");
        $message = sprintf("%s Note wurde gelöscht. %s", $restoreForm, $restoreLink);

        return Redirect::to($gbRequest->getBasePath() . '/grade')->withMessage($message);
	}

    public function restore(Requests\RestoreGradeRequest $request, Shortcut $gbRequest, $id)
    {
        $grade = Grade::withTrashed()->find($id);
        $grade->restore();

        return Redirect::to($gbRequest->getBasePath() . '/grade')->withMessage('Note wurde wiederhergestellt.');
    }

}
