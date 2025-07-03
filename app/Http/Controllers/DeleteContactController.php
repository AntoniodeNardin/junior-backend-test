<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class DeleteContactController extends Controller
{
    public function __invoke(Contact $contact)
    {
        $contact->delete();

        return response()->json(['message' => 'Contact deleted successfully'], 200);
    }
}
