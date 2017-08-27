<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\ControllerAbstract;
use App\Models\SellForm;
use Illuminate\Http\Request;
use Redirect;
use Session;

class Sell extends ControllerAbstract
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
