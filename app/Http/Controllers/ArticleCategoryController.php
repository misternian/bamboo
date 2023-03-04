<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleCategoryRequest;
use App\Http\Requests\UpdateArticleCategoryRequest;
use App\Models\ArticleCategory;
use App\Http\Resources\ArticleCategoryResource;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ArticleCategoryResource::collection(ArticleCategory::orderBy('created_at', 'desc')->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleCategoryRequest $request)
    {
        $validated = $request->validated();

        $articleCategory = ArticleCategory::create([
            'name' => $validated['name'],
        ]);

        return new ArticleCategoryResource($articleCategory);
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreArticleCategoryRequest $request, ArticleCategory $articleCategory)
    {
        $validated = $request->validated();

        $articleCategory->fill([
            'name' => $validated['name'],
        ]);

        $articleCategory->save();

        return new ArticleCategoryResource($articleCategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleCategory $articleCategory)
    {
        //
    }
}
