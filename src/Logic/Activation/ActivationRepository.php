<?php

namespace Cms\Logic\Activation;

use Cms\Models\Activation;
use Cms\Models\User;
use Cms\Logic\Notifications\SendActivationEmail;
use Carbon\Carbon;

class ActivationRepository
{

    /**
     * @return null|true
     */
    public function createTokenAndSendEmail(User $user)
    {
        // Limit number of activation attempts to 3 in 24 hours window
        $activations = Activation::where('user_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subHours(24))
            ->count();

        if ($activations >= 3) {
            return true;
        }

        if ($user->activated) { //if user changed activated email to new one

            $user->update(
                [
                'activated' => false
                ]
            );

        }

        // Create new Activation record for this user/email
        $activation = new Activation;
        $activation->user_id = $user->id;
        $activation->token = \Illuminate\Support\Str::random(64);
        $activation->save();

        // Send activation email notification
        $user->notify(new SendActivationEmail($activation->token));


    }

    public function deleteExpiredActivations(): void
    {

        Activation::where('created_at', '<=', Carbon::now()->subHours(72))->delete();

    }
}