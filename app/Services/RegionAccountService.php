<?php

namespace App\Services;

use App\Models\RegionAccount;

/**
 * Class RegionAccountService.
 */
class RegionAccountService
{
    public static function create(String $user_id,String $date, String $reference){
        RegionAccount::create(
            [
                "user_id"=>$user_id,
                "date" =>$date,
                "reference"=>$reference
            ]
        );
    }
}
