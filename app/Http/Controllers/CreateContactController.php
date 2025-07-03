<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactsRequest;
use App\Models\Contact;

class CreateContactController extends Controller
{
    public function __invoke(ContactsRequest $contactsRequest)
    {
        $data = $contactsRequest->validated();
        $data['phone'] = preg_replace('/\D/', '', $data['phone']);
        Contact::create($data);
        return response()->json(['message' => 'Contact created successfully'], 200);
    }
}
