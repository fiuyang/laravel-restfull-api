<?php

namespace App\Http\Controllers\V1\API\Auth;

use App\Traits\Response;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class LogoutController extends Controller
{
    use Response;

    public function logout() {
        try {
            $user = JWTAuth::invalidate(JWTAuth::getToken());
            return $this->successResponse($user, 'User has been logged out');
        } catch (JWTException $exception) {
            return $this->errorResponse(null, 'Sorry, user cannot be logged out', 500);
        }
    }
}
