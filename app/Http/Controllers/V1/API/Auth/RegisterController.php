<?php

namespace App\Http\Controllers\V1\API\Auth;

use App\Models\User;
use App\Traits\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use Response;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register']]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);
        if($validator->fails()) return $this->errorResponse(null, $validator->errors(), 422);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return response()->json([
            'data' => $user,
            'message' => 'Successfully Registered',
            'code' => 200
        ]);
        // return $this->successResponse($user, 'Successfully Registered');
    }
}
