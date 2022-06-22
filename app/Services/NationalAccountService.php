<?php

namespace App\Services;

use App\Models\NationalAccount;

/**
 * Class NationalAccountService.
 */
class NationalAccountService
{
    public static function create(String $user_id,String $date, String $reference){
        NationalAccount::create(
            [
                "user_id"=>$user_id,
                "date" =>$date,
                "reference"=>$reference
            ]
        );
    }
}
