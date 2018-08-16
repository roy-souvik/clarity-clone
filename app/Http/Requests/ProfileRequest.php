<?php
namespace App\Http\Requests;

use Illuminate\Http\Request;

class ProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
          'first_name'  =>  'required',
          'last_name'   =>  'required',
          'email'       =>  'required',
          'short_bio'   =>  'required',
          'phone'       =>  'required|min:10|numeric|',
          'location'    =>  'required',
          'timezone'    =>  'required'
      ];
    }
}
