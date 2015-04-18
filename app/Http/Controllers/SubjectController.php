<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreSubjectRequest;
use App\Icon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('subject.index')->withSubjects(Subject::ofCurrentUser()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('subject.create')->withIcons(Icon::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreSubjectRequest $request)
    {
        $subject = new Subject();
        $subject->name = Input::get('name');
        $subject->description = Input::get('description');
        $subject->icon = strlen(Input::get('icon')) == 0 ? "icon-books" : Input::get('icon');
        $subject->user_id = Auth::user()->id;
        $subject->save();

        // redirect
        return Redirect::to('/subject')->withMessage(sprintf('Schulfach <strong>%s</strong> wurde erstellt!', $subject->name));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show(Requests\ShowSubjectRequest $request, $id)
    {
        return view('subject.show')->withSubject(Subject::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(Requests\DestroySubjectRequest $request, $id)
    {
        $subject = Subject::find($id);


        $message = "<form id='restore-subject' method='post' action='/subject/restore/" . $subject->id . "'><input type='hidden' name='_token' value='" . csrf_token() . "'></form> Schulfach <strong>" . $subject->name . "</strong> wurde gelöscht. <a href='#' class='alert-link' onclick='$(\"#restore-subject\").submit();return false;'>Rückgängig.</a>";

        $subject->delete();

        return Redirect::to('/subject')->withMessage($message);
    }

    public function restore(Requests\RestoreSubjectRequest $request, $id)
    {
        $subject = Subject::withTrashed()->where('id', $id)->first();
        $subject->restore();

        $message = "Schulfach <strong>" . $subject->name . "</strong> wurde wiederhergestellt.";

        return Redirect::to('/subject')->withMessage($message);
    }
}