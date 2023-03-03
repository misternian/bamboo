<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::orderBy('created_at', 'desc')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('password'),
        ]);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $validated = $request->validated();

        $user = User::findOrFail($id);

        $user->fill([
            'real_name' => $validated['real_name'],
            'phone' => $validated['phone'],
        ]);

        $user->save();

        return new UserResource($user);
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
            // $user = Auth::user();
            $user = User::where('email', $attr['email'])->first();
            $user->previous_login_at = $user->last_login_at;
            $user->last_login_at = Carbon::now()->format('Y-m-d H:i:s');
            $user->login_count++;
            $user->save();
            $user->tokens()->where('name', $attr['client'])->delete();
            $token = $user->createToken($attr['client']);
            return response()->json(['token' => $token->plainTextToken]);
        }

        abort(403, 'Please check your input carefully, if there are multiple errors, please contact the administrator.');
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

    public function editPassword(Request $request)
    {
        $validated = $request->validate([
            'password_old' => 'required|string|min:6|max:255',
            'password' => 'required|string|min:6|max:255|confirmed',
        ]);

        // $user = Auth::user();
        $user = $request->user();

        if (Hash::check($validated['password_old'], $user->password)) {
            $user->password = Hash::make($validated['password']);
            $user->save();
            // $user->tokens()->delete();
            return response()->noContent();
        }

        abort(403);
    }
}
