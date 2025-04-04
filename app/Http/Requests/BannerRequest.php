<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        
              return [
                        'images.*' => ['nullable', 'image'],
                        'deleted_images.*' => ['nullable'],
                        'image_positions.*' => ['nullable'],
                        'active' => ['required', 'boolean']
                    ];
        
    }
}
