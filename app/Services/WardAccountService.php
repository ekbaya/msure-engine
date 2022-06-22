<?php

namespace App\Services;

use App\Models\WardAccount;

/**
 * Class WardAccountService.
 */
class WardAccountService
{
    public static function create(String $user_id,String $date, String $reference){
        WardAccount::create(
            [
                "user_id"=>$user_id,
                "date" =>$date,
                "reference"=>$reference
            ]
        );
    }
}
