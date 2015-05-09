<?php namespace App\Http\Requests;

use App\Semester;
use App\Services\Shortcut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class ChangeSemesterRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        $semesterId = $this->route('semester')->id;
		return Semester::whereId($semesterId)->whereUserId(Auth::user()->id)->exists();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules(Shortcut $env)
	{
		return [
            // Semester must exist and be a semester of the currently active school
			'semester' => 'exists:semesters,id,school_id,' . $env->getActiveSchool()->id
		];
	}

}
