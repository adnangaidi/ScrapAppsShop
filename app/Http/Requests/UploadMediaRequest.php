<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest; 

class UploadMediaRequest extends FormRequest
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
     * @return array<string, array|string|ValidationRule>
     */
    public function rules(): array
    {
        return [
            //            'files.*' => [
            //                'file',
            //                'mimes:jpg,jpeg,png,gif,webp,mp4,ogg,mp3,wav',
            //                'max:102400',
            //            ],
            //            'files' => [
            //                'nullable',
            //                'array',
            //            ],
            //            'urls' => [
            //                'nullable',
            //                'array',
            //            ],
            //            'urls.*' => [
            //                'url',
            //                'max:102400',
            //            ],
        ];
    }
}
