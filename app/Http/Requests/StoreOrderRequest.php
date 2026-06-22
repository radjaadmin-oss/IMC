<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool 
    { 
        return auth()->check(); 
    }

    public function rules(): array
    {
        $event = $this->route('event');

        return [
            'ticket_category_id' => ['required', 'integer', 'exists:ticket_categories,id'],
            'quantity'           => ['required', 'integer', 'min:1'],
            'attendee_name'      => ['required', 'string', 'max:255'],
            'attendee_email'     => ['required', 'string', 'email', 'max:255'],
            'attendee_phone'     => ['nullable', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'ticket_category_id.required' => 'Kategori tiket wajib dipilih.',
            'ticket_category_id.exists'   => 'Kategori tiket tidak valid.',
            'quantity.required'           => 'Jumlah tiket wajib diisi.',
            'quantity.min'                => 'Jumlah tiket minimal 1.',
            'attendee_name.required'      => 'Nama peserta wajib diisi.',
            'attendee_email.required'     => 'Email peserta wajib diisi.',
            'attendee_email.email'        => 'Format email tidak valid.',
        ];
    }
}
