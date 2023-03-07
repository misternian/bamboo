<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProvideAssetAccessToken extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $response = Http::get('https://smh.tencentcs.com/api/v1/token', [
            'LibraryId' => env('TCLOUD_SMH_ID'),
            'LibrarySecret' => env('TCLOUD_SMH_SECRET'),
            'grant' => 'admin'
        ]);

        return $response->body();
    }
}
