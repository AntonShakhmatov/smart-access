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
            'target_user_id' => 'required|exists:users,id',
            'access_card_id' => [
                'required',
                'exists:access_cards,id',
                'unique:visits,access_card_id,NULL,id,exited_at,NULL' 
            ],
        ];
    }

    public function messages(): array {
        return [
            'access_card_id.unique' => 'Эта карта доступа уже занята другим посетителем.',
        ];
    }
}
