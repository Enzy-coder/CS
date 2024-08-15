<?php

namespace Modules\Attributes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['name' => "string[]", 'slug' => "array", 'description' => "string", 'status_id' => "string", 'image_id' => "string"])]
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:191', Rule::unique('categories')->ignore($this->id)],
            'slug' => ['required','string','max:191', Rule::unique('categories')->ignore($this->id)],
            'description' => 'nullable',
            'status_id' => 'required|string|max:191',
            'image_id' => 'nullable|max:191',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
