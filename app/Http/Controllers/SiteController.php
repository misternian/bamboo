<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Http\Resources\SiteResource;
use App\Http\Requests\StoreSiteRequest;

class SiteController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        return new SiteResource($site);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSiteRequest $request, Site $site)
    {
        $validated = $request->validated();

        $site->fill([
            'name' => $validated['name'],
            'icp' => $validated['icp'],
        ]);

        $site->save();

        return new SiteResource($site);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
