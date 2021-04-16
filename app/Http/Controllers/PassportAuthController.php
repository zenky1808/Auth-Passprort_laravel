<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth;
use App\Models\User;
use Illuminate\Http\Request;

class PassportAuthController extends Controller
{
    public function register(auth $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return response()->json(['data' => $user], 200);
    }


    public function login(Request $request){
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}


