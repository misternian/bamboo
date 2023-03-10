<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientType;
use App\Http\Resources\ClientTypeResource;
use App\Http\Requests\StoreClientTypeRequest;

class ClientTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ClientTypeResource::collection(ClientType::orderBy('created_at', 'asc')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientTypeRequest $request)
    {
        $validated = $request->validated();

        $clientType = ClientType::create([
            'name' => $validated['name'],
        ]);

        return new ClientTypeResource($clientType);
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
    public function update(StoreClientTypeRequest $request, ClientType $clientType)
    {
        $validated = $request->validated();

        $clientType->fill([
            'name' => $validated['name'],
        ]);

        $clientType->save();

        return new ClientTypeResource($clientType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
