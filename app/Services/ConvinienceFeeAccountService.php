<?php

namespace App\Services;

use App\Models\ConvinienceFeeAccount;

/**
 * Class ConvinienceFeeAccountService.
 */
class ConvinienceFeeAccountService
{
    public static function create(String $user_id,String $date, String $reference){
        ConvinienceFeeAccount::create(
            [
                "user_id"=>$user_id,
                "date" =>$date,
                "reference"=>$reference
            ]
        );
    }
}
