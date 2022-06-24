<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Cover;
use App\Models\Payment;
use App\Models\BillingCycleAccount;

/**
 * Class BillingCycleAccountService.
 */
class BillingCycleAccountService
{
    public  function create(Payment $payment)
    {
        list($months, $balance) = $this->calculateCover($payment->Amount);
        if ($months == 0) {
            //Amount Less than KES 300
            $this->balanceUserBillingCycleAccount($payment->UserId, $balance);
        } elseif ($months > 0 && $balance > 0) {
            //Update the BillingCycleAccount
            $this->balanceUserBillingCycleAccount($payment->UserId, $balance);

            //create Cover
            $amount = $payment->Amount - $balance;
            $this->createCover($payment->UserId, $months, $amount, $payment->MpesaReceiptNumber);
        } else {
            //credit accounts : There is no pending balance
            $this->createCover($payment->UserId, $months, $payment->Amount, $payment->MpesaReceiptNumber);
        }
    }



    function calculateCover($amount)
    {
        //680
        $months = (int)($amount / 300);//2 months
        $balance = $amount % 300;//80
        return array($months, $balance);
    }

    function closeBillingCycleAccount(BillingCycleAccount $billingCycleAccount): BillingCycleAccount
    {
        $billingCycleAccount->update(
            [
                'amount' => '300',
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
            - Amount is less than KES 300
            - Update the Billing Cycle Account
             */
        $billingCycleAccount = BillingCycleAccount::query()->where([
            ['user_id', '=', $user_id],
            ['status', '=', 'active']
        ])->first();

        if ($billingCycleAccount) {
            $newAmount = $billingCycleAccount->amount + $balance;
            if ($newAmount < 300) {
                //Update Account
                $this->updateBillingCycleAccount($billingCycleAccount, $newAmount);
            } elseif ($newAmount == 300) {
                //close account
                $account = $this->closeBillingCycleAccount($billingCycleAccount);

                //Create Cover
                $this->createCover($user_id, 1, $newAmount, $account->account_id);
            } else {
                //Amount is more than 300
                $amount = $newAmount - 300;
                //close account
                $account = $this->closeBillingCycleAccount($billingCycleAccount);
                //Open a new Billing Cycle Account
                CoverService::createBillingCycle($user_id, $amount);

                //Create Cover
                $this->createCover($user_id, 1, "300", $account->account_id);
            }
        } else {
            //No Billing Cycle Account: Create New
            CoverService::createBillingCycle($user_id, $balance);
        }
    }

    function createCover($user_id, $months, $amount, $reference)//Mpesa R
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
