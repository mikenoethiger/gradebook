<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreGradeRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'grade' => ["required", "regex:/^[1-5](\.[0-9]*)?$|^6$/"],
            'subject' => "required|exists:subjects,id",
		];
	}

    // Override the messages function for custom messages
    public function messages()
    {
        return [
            'grade.required' => 'Bitte gib eine Note ein.',
            'grade.regex' => 'Die Note muss zwischen 1 und 6 liegen.',
            'subject.required' => 'Bitte wähle ein Schulfach aus.',
            'subject.exists' => 'Das Schulfach existiert nicht.'
        ];
    }
}