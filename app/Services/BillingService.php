<?php

namespace App\Services;

use App\Models\CalculatingPeriodAccount;
use App\Models\ConvinienceFeeAccount;
use App\Models\Payment;
use Carbon\Carbon;

/**
 * Class BillingService.
 */
class BillingService
{
    public function create(Payment $payment)
    {
        list($days, $balance) = $this->calculatePremium($payment->Amount);
        if ($days == 0) {
            //Amount Less than KES 100
            $this->balanceUserCalculatingPeriodAccount($payment->UserId, $balance);
        } elseif ($days > 0 && $balance > 0) {
            //Update the Calculating Period Accounts
            $this->balanceUserCalculatingPeriodAccount($payment->UserId, $balance);

            //credit Accounts
            $this->creditPremiumAccounts($payment->UserId, $days, $payment->MpesaReceiptNumber);
        } else {
            //credit accounts : There is no pending balance
            $this->creditPremiumAccounts($payment->UserId, $days, $payment->MpesaReceiptNumber);
        }
    }



    function calculatePremium($amount)
    {
        $days = (int)($amount / 100);
        $balance = $amount % 100;
        return array($days, $balance);
    }

    function closeCalculatingPeriodAccount(CalculatingPeriodAccount $calculatingPeriodAccount): CalculatingPeriodAccount
    {
        $calculatingPeriodAccount->update(
            [
                'amount' => '100',
                'status' => 'closed'
            ]
        );
        return $calculatingPeriodAccount;
    }

    function updateCalculatingPeriodAccount(CalculatingPeriodAccount $calculatingPeriodAccount, $newAmount)
    {
        $calculatingPeriodAccount->update(
            ['amount' => $newAmount]
        );
    }



    function balanceUserCalculatingPeriodAccount($user_id, $balance)
    {
        /*
            - Amount is less than KES 100
            - Update the calculating period account
            - Update the Billing Cycle Account
             */
        $calculatingPeriodAccount = CalculatingPeriodAccount::query()->where([
            ['user_id', '=', $user_id],
            ['status', '=', 'active']
        ])->first();

        if ($calculatingPeriodAccount) {
            $newAmount = $calculatingPeriodAccount->amount + $balance;
            if ($newAmount < 100) {
                //Update Account
                $this->updateCalculatingPeriodAccount($calculatingPeriodAccount, $newAmount);
            } elseif ($newAmount == 100) {
                //close account
                $account = $this->closeCalculatingPeriodAccount($calculatingPeriodAccount);

                //Credit Accounts
                $this->creditPremiumAccounts($user_id, 1, $account->account_id);
            } else {
                //Amount is more than 100
                $amount = $newAmount - 100;
                //close account
                $account = $this->closeCalculatingPeriodAccount($calculatingPeriodAccount);
                //Open a new Calculating Period Account
                CalculatingPeriodAccountService::create($user_id, $amount);

                //Credit Accounts
                $this->creditPremiumAccounts($user_id, 1, $account->account_id);
            }
        } else {
            //No Calculating Account: Create New
            CalculatingPeriodAccountService::create($user_id, $balance);
        }
    }

    function creditPremiumAccounts($user_id, $days, $reference)
    {
        //Get Latest Credit Date of any Account
        $account = ConvinienceFeeAccount::query()->where("user_id", $user_id)->latest('created_at')->first();
        if ($account) {
            $lastPaymentDate = $account->date;
            for ($j = 0; $j < $days; $j++) {
                $date = Carbon::createFromFormat('d-m-Y', $lastPaymentDate)->addDays($j + 1);
                BAKSubscriptionService::create($user_id, $date->format('d-m-Y'), $reference);
                ConvinienceFeeAccountService::create($user_id, $date->format('d-m-Y'), $reference);
                CountyAccountService::create($user_id, $date->format('d-m-Y'), $reference);
                MedicalInsuranceService::create($user_id, $date->format('d-m-Y'), $reference);
                NationalAccountService::create($user_id, $date->format('d-m-Y'), $reference);
                RegionAccountService::create($user_id, $date->format('d-m-Y'), $reference);
                SubCountyAccountService::create($user_id, $date->format('d-m-Y'), $reference);
                VendorAccountService::create($user_id, $date->format('d-m-Y'), $reference);
                WardAccountService::create($user_id, $date->format('d-m-Y'), $reference);
            }
        } else {
           
            for ($j = 0; $j < $days; $j++) {
                $date = Carbon::now()->addDays($j);
                BAKSubscriptionService::create($user_id, $date->format('d-m-Y'), $reference);
                ConvinienceFeeAccountService::create($user_id, $date->format('d-m-Y'), $reference);
                CountyAccountService::create($user_id, $date->format('d-m-Y'), $reference);
                MedicalInsuranceService::create($user_id, $date->format('d-m-Y'), $reference);
                NationalAccountService::create($user_id, $date->format('d-m-Y'), $reference);
                RegionAccountService::create($user_id, $date->format('d-m-Y'), $reference);
                SubCountyAccountService::create($user_id, $date->format('d-m-Y'), $reference);
                VendorAccountService::create($user_id, $date->format('d-m-Y'), $reference);
                WardAccountService::create($user_id, $date->format('d-m-Y'), $reference);
            }
        }
    }
}
