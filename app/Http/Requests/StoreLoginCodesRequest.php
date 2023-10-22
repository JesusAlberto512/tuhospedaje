<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoginCodesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        //$idValidate = $this->route('signup2') == NULL ? "": ','.($this->route('signup2')->code_id. ',code_id' );
        return [];
    }

    public function messages(): array
    {
        return [];
    }


}
