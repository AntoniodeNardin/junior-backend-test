<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class ListContactsController extends Controller
{
    public function __invoke()
    {
        $contacts = Contact::paginate(10);
        return view('contacts.index', compact('contacts'));
    }
}
