<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
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
            'order' => 'required|min:0|numeric',
            'brand_slug' => 'required',
            'category_slug' => 'required',
            'url_slug' => 'string|max:150',
            'name' => 'required|string|min:5|max:150',
            'description' => 'string|min:10|max:10000',
            'price_rub' => 'numeric|min:100|max:10000000000',
            'price_usd' => 'numeric|min:100|max:10000000000',
            'price_eur' => 'numeric|min:100|max:10000000000',
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
