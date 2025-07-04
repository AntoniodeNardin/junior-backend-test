<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Notifications\ContactDeleted;

class DeleteContactController extends Controller
{
    public function __invoke(Contact $contact)
    {
        $contact->notify(new ContactDeleted());

        $contact->delete();

        return response()->json(['message' => 'Contact deleted successfully'], 200);
    }
}
