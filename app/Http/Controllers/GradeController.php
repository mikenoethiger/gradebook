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
	public function create(Shortcut $shortcut)
	{
        $subjects = $shortcut->getSubjects();
        if ($shortcut->getActiveSemester()->subjects()->count() == 0) {
            return Redirect::to('/dashboard');
        }
        $selectedSubject = $shortcut->getActiveSemester()->subjects()->whereId(Input::get('subject'))->first();
        $selectedSubject = $selectedSubject == null ? $subjects[0] : $selectedSubject;
		return view('app.grade.create')->with(compact('subjects', 'selectedSubject'));
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
        $grade->weighting = Input::get('weighting');
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
	public function destroy(Requests\DestroyGradeRequest $request, Shortcut $shortcut, $gradeId)
	{
        Log::info($gradeId);
		$grade = Grade::find($gradeId);
        $grade->delete();

        $restoreForm = sprintf("<form id='restore-grade' method='post' action='%s/grade/restore/%s'><input type='hidden' name='_token' value='%s'></form>", $shortcut->getBasePath(), $grade->id, csrf_token());
        $restoreLink = sprintf("<a href='#' class='alert-link' onclick='$(\"#restore-grade\").submit();return false;'>Rückgängig.</a>");
        $message = sprintf("%s Note wurde gelöscht. %s", $restoreForm, $restoreLink);

//        return Redirect::to($shortcut->getBasePath() . '/grade')->withMessage($message);
        return Redirect::back()->withMessage($message);
    }

    public function restore(Requests\RestoreGradeRequest $request, Shortcut $shortcut, $id)
    {
        $grade = Grade::withTrashed()->find($id);
        $grade->restore();

        //return Redirect::to($shortcut->getBasePath() . '/grade')->withMessage('Note wurde wiederhergestellt.');
        return Redirect::back()->withMessage('Note wurde wiederhergestellt.');
    }

}
