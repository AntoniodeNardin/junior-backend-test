<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ajuste se precisar
    }

    public function rules(): array
    {
        return [
            'name'  => 'required|string|min:3',
            // ignora o contato atual para regra de email único
            'email' => 'required|email|unique:contacts,email,' . $this->contact->id,
            'phone' => 'required|string|min:10'
        ];
    }
}
