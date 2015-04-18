<?php namespace App\Http\Requests;

use App\Http\Requests\Request;


class StoreSubjectRequest extends Request {

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
			'name' => 'required'
		];
	}

    // Override the messages function for custom messages
    public function messages()
    {
        return [
            'name.required' => 'Der Name darf nicht leer sein.',
        ];
    }

}
