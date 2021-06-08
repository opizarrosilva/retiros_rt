<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LlamadoStoreRequest extends FormRequest
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
            'estadollamado_id' => ['required', 'exists:estadollamados,id'],
            'retiro_id' => ['required', 'exists:retiros,id'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
