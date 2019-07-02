<?php

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

/**
 * Created by PhpStorm.
 * User: Bad Boy
 * Date: 6/20/2019
 * Time: 12:43 AM
 */
class VerifyApiEmail extends VerifyEmailBase{

    public function verificationUrl($notifiable)
    {

        dd($notifiable);
//        return URL::temporarySignedRoute(
//            "verificationapi.verify", Carbon::now()->addMinutes(60), ["id" => $notifiable->getKey()]
//        );
    }
}
