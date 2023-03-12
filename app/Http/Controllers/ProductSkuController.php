<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProductSpu;
use App\Models\ProductSku;
use App\Models\ProductPropertyContent;
use App\Http\Requests\StoreProductSkuRequest;
use App\Http\Controllers\ProductSpuController;

class ProductSkuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductSkuRequest $request)
    {
        $validated = $request->validated();

        $currentSpu = ProductSpu::where('spu_id', $validated['spu_id'])->firstOrFail();

        if ($currentSpu->mode == 2) {
            $newPropertyContentsArray = $validated['new_property_contents'][0];

            $newSkusArray = $validated['skus'];

            $propertyId = $currentSpu->properties[0]->id;

            $i = 0;

            while ($i < count($newPropertyContentsArray)) {
                $newPropertyContent = new ProductPropertyContent(['property_id' => $propertyId, 'value' => $newPropertyContentsArray[$i]]);

                $currentSpu->property_contents()->save($newPropertyContent);

                $newSkuId = ProductSpuController::makeSkuId();

                $newSku = new ProductSku([
                    'sku_id' => $newSkuId,
                    // 'spu_id' => $validated['spu_id'],
                    'name' => $newSkusArray[$i]['name'],
                    'sku_code' => $newSkusArray[$i]['sku_code'],
                    'image_1' => $newSkusArray[$i]['image_1'],
                    // 'price' => $newSkusArray[$i]['price'] * 1000,
                    // 'sell_price' => $newSkusArray[$i]['sell_price'] * 1000,
                    'stock_code' => $newSkusArray[$i]['stock_code'],
                    'stock_name' => $newSkusArray[$i]['stock_name'],
                    'bar_code' => $newSkusArray[$i]['bar_code'],
                ]);

                $currentSpu->skus()->save($newSku);

                $currentSku = ProductSku::where('sku_id', $newSkuId)->first();

                $currentPropertyContent = ProductPropertyContent::where('value', $newPropertyContentsArray[$i])->where('spu_id', $currentSpu->id)->first();

                $currentSku->property_contents()->attach($currentPropertyContent->id);

                $i++;
            }
        } else {
            for ($i = 0; $i < count($validated['new_property_contents']); $i++) {
                $propertyId = $currentSpu->properties[$i]->id;

                foreach ($validated['new_property_contents'][$i] as $value) {
                    if (isset($value)) {
                        $newPropertyContent = new ProductPropertyContent(['property_id' => $propertyId, 'value' => $value]);

                        $currentSpu->property_contents()->save($newPropertyContent);
                    }
                }
            }

            foreach ($validated['skus'] as $sku) {
                $newSkuId = ProductSpuController::makeSkuId();

                $newSku = new ProductSku([
                    'sku_id' => $newSkuId,
                    // 'spu_id' => $validated['spu_id'],
                    'name' => $sku['name'],
                    'sku_code' => $sku['sku_code'],
                    'image_1' => $sku['image_1'],
                    // 'price' => $sku['price'] * 1000,
                    // 'sell_price' => $sku['sell_price'] * 1000,
                    'stock_code' => $sku['stock_code'],
                    'stock_name' => $sku['stock_name'],
                    'bar_code' => $sku['bar_code'],
                ]);

                $currentSpu->skus()->save($newSku);

                $currentSku = ProductSku::where('sku_id', $newSkuId)->first();

                $propertyContentNameCollection = Str::of($sku['name'])->explode(',');

                $propertyContentIdCollection = $propertyContentNameCollection->map(function ($item) use ($currentSpu) {
                    $propertyContent = ProductPropertyContent::where('value', $item)->where('spu_id', $currentSpu->id)->first();

                    return $propertyContent->id;
                });

                $currentSku->property_contents()->attach($propertyContentIdCollection->all());
            }
        }
        // $currentSpu->refresh();

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function editImage(Request $request)
    {
        $validated = $request->validate([
            'sku_id' => 'nullable|integer',
            'image_1' => 'required|url|max:255',
        ]);

        $sku = ProductSku::firstWhere('sku_id', $validated['sku_id']);

        $sku->image_1 = $validated['image_1'];

        $sku->save();

        return response()->noContent();
    }

    public function editSkuCode(Request $request)
    {
        $validated = $request->validate([
            'sku_id' => 'nullable|integer',
            'sku_code' => 'nullable|string|max:255',
        ]);

        $sku = ProductSku::firstWhere('sku_id', $validated['sku_id']);

        $sku->sku_code = $validated['sku_code'];

        $sku->save();

        return response()->noContent();
    }

    public function editName(Request $request)
    {
        $validated = $request->validate([
            'sku_id' => 'required|integer',
            'spu_id' => 'required|integer',
            'property_contents.*.value' => 'required|string|max:255',
            'property_contents.*.old_value' => 'required|string|max:255',
            'property_contents.*.id' => 'required',
            'property_contents.*.sort' => 'required'
        ]);

        foreach ($validated['property_contents'] as $value) {
            if ($value['value'] != $value['old_value']) {
                $propertyContent = ProductPropertyContent::find($value['id']);

                $propertyContent->value = $value['value'];

                $propertyContent->save();

                foreach ($propertyContent->skus as $sku) {
                    $skuName = $sku->name;

                    $newSkuName = Str::replace($value['old_value'], $value['value'], $skuName);

                    $sku->name = $newSkuName;

                    $sku->save();
                }
            }
        }

        return response()->noContent();
    }

    public function editRemark(Request $request)
    {
        $validated = $request->validate([
            'sku_id' => 'required|exists:product_skus,sku_id',
            'remark' => 'nullable|string|max:255',
        ]);

        $sku = ProductSku::firstWhere('sku_id', $validated['sku_id']);

        $sku->remark = $validated['remark'];

        $sku->save();

        // $user = $request->user();

        // $historical_remark = new SkuHistoricalRemark([
        //     'content' => $validated['remark'],
        //     'user_id' => $user->id,
        // ]);

        // $sku->historical_remarks()->save($historical_remark);

        return [
            'sku_id' => $sku->sku_id,
            'remark' => $sku->remark,
        ];
    }

}
