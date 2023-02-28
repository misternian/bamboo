<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Resources\UserResource;

class UserController extends Controller
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

    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|max:255',
            'client' => 'required|string|max:255'
        ]);

        if (Auth::attempt(['email' => $attr['email'], 'password' => $attr['password']])) {
            $user = Auth::user();
            $user->previous_login_at = $user->last_login_at;
            $user->last_login_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->login_count++;
            $user->save();
            $user->tokens()->where('name', $attr['client'])->delete();
            $token = $user->createToken($attr['client']);
            return response()->json(['token' => $token->plainTextToken]);
        }

        abort(403);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->where('name', $request->client)->delete();
        return response()->noContent();
    }

    public function me()
    {
        $user = Auth::user();

        return new UserResource($user);
    }
}
