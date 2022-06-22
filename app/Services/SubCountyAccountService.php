<?php

namespace App\Services;

use App\Models\SubCountyAccount;

/**
 * Class SubCountyAccountService.
 */
class SubCountyAccountService
{
    public static function create(String $user_id,String $date, String $reference){
        SubCountyAccount::create(
            [
                "user_id"=>$user_id,
                "date" =>$date,
                "reference"=>$reference
            ]
        );
    }
}
