<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateContactsRequest;
use App\Models\Contact;

class UpdateContactController extends Controller
{
    public function __invoke(UpdateContactsRequest $request, Contact $contact)
    {
        $data = $request->validated();
        $data['phone'] = preg_replace('/\D/', '', $data['phone']);
        $contact->update($data);

        return response()->json(['message' => 'Contact updated successfully'], 200);
    }
}
