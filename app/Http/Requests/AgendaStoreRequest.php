<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendaStoreRequest extends FormRequest
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
            'fecha' => ['required', 'date', 'date'],
            'bloquehorario_id' => ['required', 'exists:bloquehorarios,id'],
            'glosa' => ['required', 'max:255', 'string'],
            'retiro_id' => ['required', 'exists:retiros,id'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
