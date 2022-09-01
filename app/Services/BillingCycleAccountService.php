<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Cover;
use App\Models\Payment;
use App\Models\BillingCycleAccount;
use App\Models\MedicalCardAndDelivery;

/**
 * Class BillingCycleAccountService.
 */
class BillingCycleAccountService
{
    public  function create(Payment $payment)
    {
        list($months, $balance) = $this->calculateCover($payment);
        if ($months == 0) {
            //Amount Less than KES 326
            $this->balanceUserBillingCycleAccount($payment->user_id, $balance);
        } elseif ($months > 0 && $balance > 0) {
            //Update the BillingCycleAccount
            $this->balanceUserBillingCycleAccount($payment->user_id, $balance);

            //create Cover
            $amount = $payment->amount - $balance;
            $this->createCover($payment->user_id, $months, $amount, $payment->transaction_id);
        } else {
            //credit accounts : There is no pending balance
            $this->createCover($payment->user_id, $months, $payment->amount, $payment->transaction_id);
        }
    }



    function calculateCover(Payment $payment)
    {
        $operationalAmount = 0;

        $billing = MedicalCardAndDelivery::query()->where([
            ['user_id', '=', $payment->user_id]
        ])->first();

        if ($billing) {
            //This is not first time payment
            if ($billing->status === "active") {
                $balance = $billing->amount + $payment->amount;
                if ($balance == 0) {
                    //Close Account
                    MedicalCardAndDeliveryService::closeBillingAccount($billing);
                    $operationalAmount = 0;
                } elseif ($balance > 135) {
                    //Close the account
                    MedicalCardAndDeliveryService::closeBillingAccount($billing);
                    $operationalAmount = $balance - 135;
                } else {
                    //amount is less than 135
                    //Update Medical Account
                    MedicalCardAndDeliveryService::updateBillingAccount($billing,$balance);
                    $operationalAmount = 0;
                }
            } else {
                //Customer Already Paid for Medical Card and Delivery Cost
                $operationalAmount = $payment->amount;
            }
        } else {
            //Initaite new billing Account
            if ($payment->amount == 135) {
                //Create Account And Close
                MedicalCardAndDeliveryService::createAndClose($payment->user_id, "135");
                $operationalAmount == 0;
            } elseif ($payment->amount > 135) {
                //Create And Close account
                MedicalCardAndDeliveryService::createAndClose($payment->user_id, "135");
                $operationalAmount = $payment->amount - 135;
            } else {
                //Create Active Account
                MedicalCardAndDeliveryService::create($payment->user_id, $payment->amount);
                $operationalAmount = 0;
            }
        }

        $months = (int)($operationalAmount / 326);
        $balance = $operationalAmount % 326;
        return array($months, $balance);
    }

    function closeBillingCycleAccount(BillingCycleAccount $billingCycleAccount): BillingCycleAccount
    {
        $billingCycleAccount->update(
            [
                'amount' => '326',
                'status' => 'closed'
            ]
        );
        return $billingCycleAccount;
    }

    function updateBillingCycleAccount(BillingCycleAccount $billingCycleAccount, $newAmount)
    {
        $billingCycleAccount->update(
            ['amount' => $newAmount]
        );
    }



    function balanceUserBillingCycleAccount($user_id, $balance)
    {
        /*
            - Amount is less than KES 326
            - Update the Billing Cycle Account
             */
        $billingCycleAccount = BillingCycleAccount::query()->where([
            ['user_id', '=', $user_id],
            ['status', '=', 'active']
        ])->first();

        if ($billingCycleAccount) {
            $newAmount = $billingCycleAccount->amount + $balance;
            if ($newAmount < 326) {
                //Update Account
                $this->updateBillingCycleAccount($billingCycleAccount, $newAmount);
            } elseif ($newAmount == 326) {
                //close account
                $account = $this->closeBillingCycleAccount($billingCycleAccount);

                //Create Cover
                $this->createCover($user_id, 1, $newAmount, $account->account_id);
            } else {
                //Amount is more than 326
                $amount = $newAmount - 326;
                //close account
                $account = $this->closeBillingCycleAccount($billingCycleAccount);
                //Open a new Billing Cycle Account
                CoverService::createBillingCycle($user_id, $amount);

                //Create Cover
                $this->createCover($user_id, 1, "326", $account->account_id);
            }
        } else {
            //No Billing Cycle Account: Create New
            CoverService::createBillingCycle($user_id, $balance);
        }
    }

    function createCover($user_id, $months, $amount, $reference) //Mpesa R
    {
        //Get End date of the latest Cover
        $cover = Cover::query()->where("user_id", $user_id)->latest('created_at')->first();
        if ($cover) {
            $expiryDate = $cover->end_date;
            $date = Carbon::createFromFormat('d-m-Y', $expiryDate);

            if ($date->isPast()) {
                //The cover is expired: We cover from inception date (Today)
                $this->coverFromToday($user_id, $months, $amount, $reference);
            } else {
                //Cover is Active
                $this->coverLastCoverExpiryDate($user_id, $months, $expiryDate, $amount, $reference);
            }
        } else {
            //First Cover: We cover from inception date (Today)
            $this->coverFromToday($user_id, $months, $amount, $reference);
        }
    }

    function coverFromToday($user_id, $months, $amount, $reference)
    {
        $start_date = Carbon::now();
        CoverService::create($user_id, $start_date->format('d-m-Y'), $start_date->addMonths($months)->format('d-m-Y'), $amount, $reference);
    }

    function coverLastCoverExpiryDate($user_id, $months, $activeCoverExpiryDate, $amount, $reference)
    {
        $start_date = Carbon::createFromFormat('d-m-Y', $activeCoverExpiryDate);
        CoverService::create($user_id, $start_date->format('d-m-Y'), $start_date->addMonths($months)->format('d-m-Y'), $amount, $reference);
    }
}
