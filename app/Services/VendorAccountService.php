<?php

namespace App\Services;

use App\Models\VendorAccount;

/**
 * Class VendorAccountService.
 */
class VendorAccountService
{
    public static function create(String $user_id,String $date, String $reference){
        VendorAccount::create(
            [
                "user_id"=>$user_id,
                "date" =>$date,
                "reference"=>$reference
            ]
        );
    }
}
