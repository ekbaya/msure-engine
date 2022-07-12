<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\VendorAccount;

/**
 * Class VendorAccountService.
 */
class VendorAccountService
{
    public static function create(Customer $customer, String $date, String $reference)
    {
        VendorAccount::create(
            [
                "user_id" => $customer->user_id,
                "amount" => ($customer->stage->daily_contribution - (30 + 15)),
                "date" => $date,
                "reference" => $reference
            ]
        );
    }
}
