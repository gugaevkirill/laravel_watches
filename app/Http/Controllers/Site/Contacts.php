<?php declare(strict_types=1);

namespace App\Http\Controllers\Site;

use App\Http\Controllers\ControllerAbstract;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

class Contacts extends ControllerAbstract
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contactsPage()
    {
        return view(
            'contacts',
            ['success' => Session::get('success')]
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processForm(Request $request)
    {
        $this->validate($request, ContactForm::FIELDS);

        ContactForm::create($request->only(array_keys(ContactForm::FIELDS)));

        return Redirect::back()->withSuccess(true);
    }
}
