<?php

namespace App\Services;

use App\Models\BillingCycleAccount;
use App\Models\Cover;

/**
 * Class CoverService.
 */
class CoverService
{
    public static function create(String $user_id, String $start_date, String $end_date,String $amount, String $reference)
    {
        Cover::create(
            [
                "user_id" => $user_id,
                "amount" =>$amount,
                "start_date" => $start_date,
                "end_date" => $end_date,
                "reference" => $reference
            ]
        );
    }

    public static function createBillingCycle(String $user_id, String $amount)
    {
        BillingCycleAccount::create(
            [
                'amount' => $amount,
                'user_id' => $user_id,
            ]
        );
    }
}
