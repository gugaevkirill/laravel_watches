<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SellFormRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255|string',
            'phone' => 'required|min:6|max:30|string',
            'email' => 'email',
            'reference' => 'required|min:2|max:30|string',
            'year' => 'numeric|min:1950|max:2030',
            'amount' => 'numeric|min:100|max:1000000000',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
