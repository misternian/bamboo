<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarouselResource;
use App\Models\Carousel;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCarouselRequest;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarouselResource::collection(Carousel::orderBy('created_at', 'desc')->paginate(20));
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
    public function store(StoreCarouselRequest $request)
    {
        $validated = $request->validated();

        $carousel = Carousel::create([
            'url' => $validated['url'],
            'refer_url' => $validated['refer_url'],
            'is_active' => $validated['is_active'],
        ]);

        return new CarouselResource($carousel);
    }

    /**
     * Display the specified resource.
     */
    public function show(Carousel $carousel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carousel $carousel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCarouselRequest $request, Carousel $carousel)
    {
        $validated = $request->validated();

        $carousel->fill([
            'url' => $validated['url'],
            'refer_url' => $validated['refer_url'],
            'is_active' => $validated['is_active'],
        ]);

        $carousel->save();

        return new CarouselResource($carousel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carousel $carousel)
    {
        //
    }
}
