<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductChildCategoryUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id" => "required",
            "category_id" => "required",
            "sub_category_id" => "required",
            "name" => "required|unique:product_child_categories,name," . $this->id,
            "slug" => "required|unique:product_child_categories,slug," . $this->id,
            "status_id" => "required",
            "image_id" => "nullable",
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            "image_id" => $this->image,
            "status_id" => $this->status
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
