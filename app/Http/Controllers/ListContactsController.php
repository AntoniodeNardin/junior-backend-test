<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Contact;

class ListContactsController extends Controller
{
    public function __invoke()
    {
        $contacts = Contact::paginate(10);
        return Inertia::render('Contacts/Index', [
            'contacts' => $contacts,
        ]);
    }
}
