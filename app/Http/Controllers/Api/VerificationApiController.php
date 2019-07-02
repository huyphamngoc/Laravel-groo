<?php

namespace App\Http\Controllers\Api;

use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationApiController extends Controller
{
    use VerifiesEmails;

    public function verify(Request $request)
    {
//        $userID = $request['id'];
//        $user = User::findOrFail($userID);
//        $date = Carbon::now();
//        $user->email_verified_at = $date; // to enable the “email_verified_at field of that user be a current time stamp by mimicing the must verify email feature
//        $user->save();
//        return response()->json("Email verified!");
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json("User already have verified email!", 422);
        }
        $request->user()->sendEmailVerificationNotification();
        return response()->json("The notification has been resubmitted");
    }
}
