<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RetiroStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cliente_id' => ['required', 'exists:clientes,id'],
            'estadoretiro_id' => ['required', 'exists:estadoretiros,id'],
            'fechacarga' => ['required', 'date', 'date'],
            'glosa' => ['required', 'max:255', 'string'],
            'user_id' => ['nullable', 'exists:users,id'],
        ];
    }
}
