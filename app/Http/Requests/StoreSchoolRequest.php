<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class StoreSchoolRequest extends Request {

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
        $userId = Auth::user()->id;
		return [
			'name' => "required|unique:schools,name,NULL,id,user_id,$userId" // see http://laravel.com/docs/master/validation#rule-unique
		];
	}

    // Override the messages function for custom messages
    public function messages()
    {
        return [
            'name.required' => 'Der Name darf nicht leer sein.',
            'name.unique' => 'Dieser Name ist bereits vergeben.'
        ];
    }
}
