<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\ContactForm;

class ContactsController extends Controller
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
