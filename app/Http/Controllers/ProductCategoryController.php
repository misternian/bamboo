<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use App\Http\Requests\StoreProductCategoryRequest;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductCategoryResource::collection(ProductCategory::orderBy('created_at', 'desc')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $validated = $request->validated();

        $productCategory = ProductCategory::create([
            'name' => $validated['name'],
        ]);

        return new ProductCategoryResource($productCategory);
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
    public function update(StoreProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $validated = $request->validated();

        $productCategory->fill([
            'name' => $validated['name'],
        ]);

        $productCategory->save();

        return new ProductCategoryResource($productCategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
