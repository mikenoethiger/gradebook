<?php namespace App\Http\Requests;

use App\Grade;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class DestroyGradeRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        $gradeId = $this->route('grade');
        return Grade::where('id', $gradeId)
            ->where('user_id', Auth::id())->exists();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'grade' => 'exists:grades,id'
		];
	}

}
