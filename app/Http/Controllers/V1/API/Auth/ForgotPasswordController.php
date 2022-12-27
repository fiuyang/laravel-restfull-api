<?php

namespace App\Http\Controllers\V1\API\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Traits\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\ResetPassword;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    use Response;

    public function forgotPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => "required|email|unique:password_resets,email"
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(null, $validator->errors(), 422);
        }

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return $this->errorResponse(null, 'Email not found', 404);
        }

        $this->storeResetToken($user);

        $user->notify(new ResetPassword($user));

        return $this->successResponse(null, 'Link reset password send successfully');
    }

    /**
     * Store the reset token for the user.
     */
    protected function storeResetToken(User $user)
    {
        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => Str::random(64),
            'created_at' => Carbon::now(),
        ]);
    }
}
