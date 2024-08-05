<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(RegisterRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            return response()->json(["mesage" => "User Created Successfully", "data" => new UserResource($user)], 200);
        } catch (\Throwable $th) {
            return response()->json(["messsage" => $th->getMessage()]);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(LoginRequest $request)
    {
        try {
            $data = $request->validated();
            $user = User::where('email', $data['email'])->first();
            if (empty($user))
                return response()->json(["message" => "invalid email entered"]);
            elseif (!Hash::check($data['password'], $user['password']))
                return response()->json(["message" => "invalid password entered"]);
            else
                $token = $user->createToken('auth-token')->plainTextToken;
                return response()->json(["message"=>"logged in successfully","token"=>$token]);
        } catch (\Throwable $th) {
            return response()->json(["message"=>$th->getMessage()]);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

}
