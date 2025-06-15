<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
            'captcha' => 'required|integer',
            'type' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validator->errors()->first(),
            ]);
        }

        if ((int)$request->captcha !== (int)$request->captcha_result) {
            return response()->json([
                'code' => 400,
                'message' => 'Invalid captcha answer'
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'code' => 200,
            'message' => 'User registered successfully',
            'token' => $token,
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'message' => $validator->errors()->first()
            ]);
        }

        if ((int)$request->captcha !== (int)$request->captcha_result) {
            return response()->json([
                'code' => 400,
                'message' => 'Invalid captcha answer'
            ]);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'code' => 400,
                'message' => 'Invalid email or password'
            ]);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'code' => 200,
            'message' => 'Login successful',
            'token' => $token,
            "type" => $user->type,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Logged out successfully',
        ]);
    }

    public function user(Request $request)
    {
        return response()->json([
            'code' => 200,
            'user' => $request->user(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()->first()
            ]);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return response()->json([
            'code' => 200,
            'message' => 'Profile updated successfully.',
        ]);
    }
}