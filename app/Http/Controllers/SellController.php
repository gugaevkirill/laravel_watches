<?php

namespace App\Http\Controllers;

use Storage;
use Redirect;
use Session;
use Illuminate\Http\Request;
use App\Models\SellForm;

class SellController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sellPage()
    {
        return view(
            'sell',
            [
                'success' => Session::get('success'),
                'isSellPage' => true,
            ]
        );
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function processForm(Request $request)
    {
        $this->validate($request, SellForm::FIELDS);

        $data = array_filter($request->only(array_keys(SellForm::FIELDS)));

        // Обработка чекбоксов
        $data['has_box'] = $data['has_box'] ?? false;
        $data['has_documents'] = $data['has_documents'] ?? false;

        SellForm::create($data);

        return Redirect::back()->withSuccess(true);
    }
}
