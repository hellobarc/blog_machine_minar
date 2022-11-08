<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required|string|min:5|max:100',
            'email' => 'required|string|email|unique:users',
            'password'=> 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        if( $validation->fails())
        {
            $response = [
                'success' => false,
                'message' => $validation->errors(),
            ];
            
            return response()->json($response, 400);
        }

        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $response = [
            'success' => true,
            'data' => $users,
            'message' => 'User Registered Successfully',
        ];
        return response()->json($response, 200);
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password'=> 'required|min:8',
        ]);

        if( $validation->fails())
        {
            $response = [
                'success' => false,
                'message' => $validation->errors(),
            ];
            
            return response()->json($response, 400);
        }

        if(!$token = auth()->attempt($validation->validated()))
        {
            return response()->json(['error' => 'Unauthorized']);
        }

        return $this->responseWithToken($token);
    }

    protected function responseWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expire_in' => auth()->factory()->getTTL()*60,
        ]);
        
    }
    public function refresh(Request $request)
    {
        return $this->responseWithToken(auth()->refresh());
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $response = [
            'success' => true,
            'message' => 'User Logout Successfully',
        ];
        return response()->json($response, 200);
    }
}
