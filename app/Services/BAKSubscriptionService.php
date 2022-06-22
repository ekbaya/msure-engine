<?php

namespace App\Services;

use App\Models\BAKSubscription;

/**
 * Class BAKSubscriptionService.
 */
class BAKSubscriptionService
{
    public static function create(String $user_id,String $date, String $reference){
        BAKSubscription::create(
            [
                "user_id"=>$user_id,
                "date" =>$date,
                "reference"=>$reference
            ]
        );
    }
}
