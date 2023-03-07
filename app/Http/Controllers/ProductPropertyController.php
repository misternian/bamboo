<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductPropertyResource;
use App\Models\ProductProperty;
use App\Http\Requests\StoreProductPropertyRequest;

class ProductPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductPropertyResource::collection(ProductProperty::orderBy('created_at', 'desc')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductPropertyRequest $request)
    {
        $validated = $request->validated();

        $productProperty = ProductProperty::create([
            'name' => $validated['name'],
        ]);

        return new ProductPropertyResource($productProperty);
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
    public function update(StoreProductPropertyRequest $request, ProductProperty $productProperty)
    {
        $validated = $request->validated();

        $productProperty->fill([
            'name' => $validated['name'],
        ]);

        $productProperty->save();

        return new ProductPropertyResource($productProperty);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
