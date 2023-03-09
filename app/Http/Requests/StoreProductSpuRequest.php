<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductSpuRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'note' => 'nullable|string|max:255',
            // 'remark' => 'nullable|string|max:255',
            'spu_code' => 'required|string|max:255|unique:product_spus',
            'image_1' => 'required|url|max:255',
            'image_2' => 'nullable|url|max:255',
            'image_3' => 'nullable|url|max:255',
            'image_4' => 'nullable|url|max:255',
            'image_5' => 'nullable|url|max:255',
            'image_transparency' => 'nullable|url|max:255',
            'length' => 'nullable|string|max:255',
            'width' => 'nullable|string|max:255',
            'height' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'volume' => 'nullable|string|max:255',
            'stock_code' => 'nullable|string|max:255',
            'stock_name' => 'nullable|string|max:255',
            // 'expired_at' => 'date',
            'bar_code' => 'nullable|string|max:255',
            'mode' => 'required|numeric|integer|max:3',
            'service' => 'nullable|string|max:255',
            'is_hidden' => 'boolean',
            'category_id' => 'required|exists:product_categories,id',
            'type_id' => 'required|exists:product_types,id',
            'introduction' => 'nullable|string',
            'skus' => 'nullable|array',
            'skus.*.name' => 'required|string|max:255',
            'skus.*.sku_code' => 'required|string|max:255',
            'skus.*.image_1' => 'required|url|max:255',
            'skus.*.stock_code' => 'nullable|string|max:255',
            'skus.*.stock_name' => 'nullable|string|max:255',
            'skus.*.bar_code' => 'nullable|string|max:255',
            'properties_index' => 'nullable|array',
            'properties_index.*' => 'nullable|integer',
            'properties_content' => 'nullable|array',
            'properties_content.*' => 'nullable|array',
            'properties_content.*.*' => 'nullable|string|max:20',
        ];
    }
}
