<?php

namespace App\Http\Controllers\V1\API\Auth;

use App\Models\User;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    use Response;

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => "required|confirmed|min:8",
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(null, $validator->errors(), 422);
        }

        $passwordReset = DB::table('password_resets')
            ->where('token', $request->input('token'))
            ->first();

        if (!$passwordReset) {
            return $this->errorResponse(null, 'Token Reset Password Invalid', 421);
        }

        $user = User::where('email', $passwordReset->email)->first();

        $this->update($user, $request->input('password'));
        $this->deletePasswordReset($user);

        return $this->successResponse(Auth::tokenById($user->id), 'Successfully reset password');
    }

    /**
     * Update the user.
     */
    protected function update(User $user, string $password)
    {
        $user->password = bcrypt($password);

        return $user->update();
    }

    /**
     * Delete all existing password resets for the user.
     */
    protected function deletePasswordReset(User $user)
    {
        DB::table('password_resets')
            ->where('email', $user->email)
            ->delete();
    }
}
