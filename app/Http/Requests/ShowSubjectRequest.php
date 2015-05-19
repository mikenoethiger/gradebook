<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Subject;

class ShowSubjectRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        $subjectId = $this->route('subject');

        return Subject::where('id', $subjectId)->user->id == Auth::id();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			//
		];
	}

}
