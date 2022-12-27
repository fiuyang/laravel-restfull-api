<?php

namespace App\Http\Controllers\V1\API\Auth;

use App\Traits\Response;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    use Response;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
    }
    
    public function login(Request $request)
    {
        // Validate login request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'nullable',
        ]);
        // Check if validation is fails
        if ($validator->fails()) {
            return $this->errorResponse('null', $validator->errors(), 422);
        }

        // Declaring credentials data from request
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        // Checking credentials data via api jwt
        try {
            // error credentials response
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->errorResponse(null, 'Login credentials are invalid.', 401);
            }
        } catch (JWTException $e) {
            return $credentials;
            //  error credentials response
            return $this->errorResponse(null, 'Could not create token.', 500);
        }
        // Generate token and success response
        return $this->respondWithToken($token);
        // return $this->successResponse($this->respondWithToken($token), 'Successfully Login', 201);
    }  

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 201);
    }
}
