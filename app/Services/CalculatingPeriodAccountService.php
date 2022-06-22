<?php

namespace App\Services;

use App\Models\CalculatingPeriodAccount;

/**
 * Class CalculatingPeriodAccountService.
 */
class CalculatingPeriodAccountService
{
    public static function create($user_id, $amount)
    {
        CalculatingPeriodAccount::create(
            [
                'amount' => $amount,
                'user_id' => $user_id,
            ]
        );
    }
}
