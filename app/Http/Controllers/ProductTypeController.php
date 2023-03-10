<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Http\Resources\ProductTypeResource;
use App\Http\Requests\StoreProductTypeRequest;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductTypeResource::collection(ProductType::orderBy('created_at', 'asc')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductTypeRequest $request)
    {
        $validated = $request->validated();

        $productType = ProductType::create([
            'name' => $validated['name'],
        ]);

        return new ProductTypeResource($productType);
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
    public function update(StoreProductTypeRequest $request, ProductType $productType)
    {
        $validated = $request->validated();

        $productType->fill([
            'name' => $validated['name'],
        ]);

        $productType->save();

        return new ProductTypeResource($productType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
