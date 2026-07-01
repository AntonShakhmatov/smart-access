<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVisitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return auth()->check();
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'visitor_id' => 'required|exists:visitors,id',
            'user_id' => 'required|exists:users,id',
            'access_card_id' => [
                'required',
                'exists:access_cards,id',
                'unique:visits,access_card_id,NULL,id,exited_at,NULL' 
            ],
            'entered_at' =>  ['required', 'date'],
            'exited_at' => ['nullable', 'date', 'after_or_equal:entered_at'],
            'status' => ['required', 'string', 'created, approved, denied, checked_in, checked_out']
        ];
    }

    public function messages(): array {
        return [
            'access_card_id.unique' => 'This card is using right now by another user.',
        ];
    }
}
