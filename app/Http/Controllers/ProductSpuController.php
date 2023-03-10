<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductSpuRequest;
use App\Models\ProductSpu;
use App\Models\ProductSku;
use App\Models\ProductService;
use App\Models\ProductIntroduction;
use App\Models\ProductPropertyContent;
use App\Http\Resources\ProductSpuResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductSpuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductSpuResource::collection(ProductSpu::orderByDesc('created_at')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductSpuRequest $request)
    {
        $validated = $request->validated();

        $spuId = $this->makeSpuId();

        $spu = $this->createSpu($validated, $spuId);

        $this->createSkus($validated, $spu);

        return new ProductSpuResource($spu);
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

    public function makeSpuId()
    {
        for ($i = rand(10000, 99999);;) {
            if (ProductSpu::where('spu_id', $i)->doesntExist()) {
                return $i;
                break;
            }
        }
    }

    public static function makeSkuId()
    {
        for ($i = rand(100000, 999999);;) {
            if (ProductSku::where('sku_id', $i)->doesntExist()) {
                return $i;
                break;
            }
        }
    }

    public function createSpu($validated, $spuId)
    {
        $user_id = Auth::id();

        $spu = ProductSpu::create([
            'spu_id' => $spuId,
            'title' => $validated['title'],
            'note' => $validated['note'],
            'spu_code' => $validated['spu_code'],
            'image_1' => $validated['image_1'],
            'image_2' => $validated['image_2'],
            'image_3' => $validated['image_3'],
            'image_4' => $validated['image_4'],
            'image_5' => $validated['image_5'],
            'image_transparency' => $validated['image_transparency'],
            // 'price' => $validated['price'] * 1000,
            // 'sell_price' => $validated['sell_price'] * 1000,
            'mode' => $validated['mode'],
            // 'inventory' => $validated['inventory'],
            'length' => $validated['length'],
            'width' => $validated['width'],
            'height' => $validated['height'],
            'weight' => $validated['weight'],
            'volume' => $validated['volume'],
            'stock_code' => $validated['stock_code'],
            'stock_name' => $validated['stock_name'],
            // 'expired_at' => $validated['expired_at'],
            'category_id' => $validated['category_id'],
            'bar_code' => $validated['bar_code'],
            'is_hidden' => $validated['is_hidden'],
            'user_id' => $user_id,
            'type_id' => $validated['type_id'],
        ]);

        if ($validated["mode"] != 1) {
            $properties_arr = $validated['properties_index'];
            $property_content_arr = $validated['properties_content'];

            foreach ($properties_arr as $key => $property_id) {
                $spu->properties()->attach($property_id);

                foreach ($property_content_arr[$key] as $content) {
                    ProductPropertyContent::create([
                        'property_id' => $property_id,
                        'value' => $content,
                        'spu_id' => $spu->id,
                    ]);
                }
            }
        }

        $service = new ProductService(['content' => $validated['service']]);

        $spu->service()->save($service);

        $introduction = new ProductIntroduction(['content' => $validated['introduction']]);

        $spu->introduction()->save($introduction);

        return $spu;
    }

    public function createSkus($validated, $spu)
    {
        if ($validated["mode"] === 1) {
            $this->createSingelSku($validated, $spu);
        }

        if ($validated["mode"] === 2 || $validated["mode"] === 3) {
            $skus_arr = $validated["skus"];
            foreach ($skus_arr as &$value) {
                $sku_id = $this->makeSkuId();
                ProductSku::create([
                    'sku_id' => $sku_id,
                    'spu_id' => $spu->id,
                    'name' => $value['name'],
                    'sku_code' => $value['sku_code'],
                    'image_1' => $value['image_1'],
                    // 'price' => $value['price'] * 1000,
                    // 'sell_price' => $value['sell_price'] * 1000,
                    // 'inventory' => $value['inventory'],
                    'length' => $validated['length'],
                    'width' => $validated['width'],
                    'height' => $validated['height'],
                    'weight' => $validated['weight'],
                    'volume' => $validated['volume'],
                    'stock_code' => $value['stock_code'],
                    'stock_name' => $value['stock_name'],
                    // 'expired_at' => $validated['expired_at'],
                    'bar_code' => $value['bar_code'],
                    // 'hidden' => $value['hidden'],
                ]);

            }
            unset($value);

            $property_contents = ProductPropertyContent::where('spu_id', $spu->id)->get();

            $total_sks = ProductSku::where('spu_id', $spu->id)->get();

            //此处存在bug，“双人”，“双人加宽”，出现这样的规则名时会重复保存
            foreach ($property_contents as $property) {
                foreach ($total_sks as $singleSku) {
                    if (Str::contains($singleSku->name, $property->value)) {
                        $singleSku->property_contents()->attach($property->id);
                    }
                }
            }
        }
    }

    public function createSingelSku($validated, $spu)
    {
        $skuId = $this->makeSkuId();

        ProductSku::create([
            'sku_id' => $skuId,
            'spu_id' => $spu->id,
            'name' => $validated['title'],
            'sku_code' => $validated['spu_code'],
            'image_1' => $validated['image_1'],
            // 'price' => $validated['price'] * 1000,
            // 'sell_price' => $validated['sell_price'] * 1000,
            // 'inventory' => $validated['inventory'],
            'length' => $validated['length'],
            'width' => $validated['width'],
            'height' => $validated['height'],
            'weight' => $validated['weight'],
            'volume' => $validated['volume'],
            'stock_code' => $validated['stock_code'],
            'stock_name' => $validated['stock_name'],
            'is_hidden' => $validated['is_hidden'],
            'bar_code' => $validated['bar_code'],
        ]);
    }
}
