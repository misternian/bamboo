<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductSkuRequest extends FormRequest
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
            'spu_id' => 'required|exists:product_spus,spu_id',
            'skus' => 'required|array',
            'skus.*.name' => 'required|string|max:255',
            'skus.*.sku_code' => 'required|string|max:255',
            // 'skus.*.price' => 'required|numeric|integer|min:1|max:3999999',
            // 'skus.*.sell_price' => 'required|numeric|integer|min:1|max:3999999',
            // 'skus.*.inventory' => 'required|numeric|integer|min:0|max:9999999',
            'skus.*.stock_code' => 'nullable|string|max:255',
            'skus.*.stock_name' => 'nullable|string|max:255',
            // 'skus.*.hidden' => 'boolean',
            'skus.*.bar_code' => 'nullable|string|max:255',
            'skus.*.image_1' => 'required|url|max:255',
            'new_property_contents' => 'required|array',
            'new_property_contents.*' => 'array',
            'new_property_contents.*.*' => 'nullable|string|max:255',
        ];
    }
}
