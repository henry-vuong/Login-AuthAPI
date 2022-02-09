<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Response;

class JWTAuthController extends Controller
{

    //
    
    public  function login(request $request){
        $input=$request->only('email', 'password');
        // validate login
        $validator = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        // Create Token
        $jwt_token =JWT::encode($input,'example_key','HS256');
        
        if(!isset($input)||$validator->fails()){
            return response()->json([
                'success'=>false,
                'message'=>'Invalid email or password'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }
}
