<?php

namespace App\Services;

use App\Models\CountyAccount;

/**
 * Class CountyAccountService.
 */
class CountyAccountService
{
    public static function create(String $user_id,String $date, String $reference){
        CountyAccount::create(
            [
                "user_id"=>$user_id,
                "date" =>$date,
                "reference"=>$reference
            ]
        );
    }
}
