<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\ControllerAbstract;

class Repair extends ControllerAbstract
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function repairPage()
    {
        return view('repair');
    }
}
