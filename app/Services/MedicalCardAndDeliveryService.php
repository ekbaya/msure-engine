<?php

namespace App\Services;

use App\Models\MedicalCardAndDelivery;

/**
 * Class MedicalCardAndDeliveryService.
 */
class MedicalCardAndDeliveryService
{
    public static function create($user_id, $amount)
    {
        MedicalCardAndDelivery::create(
            [
                'amount' => $amount,
                'user_id' => $user_id,
            ]
        );
    }

    public static function createAndClose($user_id, $amount)
    {
        MedicalCardAndDelivery::create(
            [
                'amount' => $amount,
                'user_id' => $user_id,
                'status' => 'closed'
            ]
        );
    }

    public static function closeBillingAccount(MedicalCardAndDelivery $billingAccount): MedicalCardAndDelivery
    {
        $billingAccount->update(
            [
                'amount' => '135',
                'status' => 'closed'
            ]
        );
        return $billingAccount;
    }

    public static function updateBillingAccount(MedicalCardAndDelivery $billingAccount, $newAmount)
    {
        $billingAccount->update(
            ['amount' => $newAmount]
        );
    }

    public static function settleBillingAccount(MedicalCardAndDelivery $billingAccount): MedicalCardAndDelivery
    {
        $billingAccount->update(
            [
                'status' => 'settled'
            ]
        );
        return $billingAccount;
    }
}
