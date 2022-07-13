<?php

namespace App\Services;

use App\Models\CalculatingPeriodAccount;
use App\Models\ConvinienceFeeAccount;
use App\Models\Customer;
use App\Models\Payment;
use Carbon\Carbon;

/**
 * Class BillingService.
 */
class BillingService
{
    public function create(Payment $payment)
    {
        $customer = Customer::query()->where('user_id', $payment->UserId)->firstOrFail();
        $customer->stage; //preload
        list($days, $balance) = $this->calculatePremium($customer, $payment->Amount);
        if ($days == 0) {
            //Amount Less than customer stage daily fee
            $this->balanceUserCalculatingPeriodAccount($customer, $balance);
        } elseif ($days > 0 && $balance > 0) {
            //Update the Calculating Period Accounts
            $this->balanceUserCalculatingPeriodAccount($customer, $balance);

            //credit Accounts
            $this->creditPremiumAccounts($customer, $days, $payment->MpesaReceiptNumber);
        } else {
            //credit accounts : There is no pending balance
            $this->creditPremiumAccounts($customer, $days, $payment->MpesaReceiptNumber);
        }
    }



    function calculatePremium($customer, $amount)
    {
        $days = (int)($amount / $customer->stage->daily_contribution);
        $balance = $amount % $customer->stage->daily_contribution;
        return array($days, $balance);
    }

    function closeCalculatingPeriodAccount(Customer $customer, CalculatingPeriodAccount $calculatingPeriodAccount): CalculatingPeriodAccount
    {
        $calculatingPeriodAccount->update(
            [
                'amount' => $customer->stage->daily_contribution,
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



    function balanceUserCalculatingPeriodAccount($customer, $balance)
    {
        /*
            - Amount is less than Stage Amount
            - Update the calculating period account
            - Update the Billing Cycle Account
             */
        $calculatingPeriodAccount = CalculatingPeriodAccount::query()->where([
            ['user_id', '=', $customer->user_id],
            ['status', '=', 'active']
        ])->first();

        if ($calculatingPeriodAccount) {
            $newAmount = $calculatingPeriodAccount->amount + $balance;
            if ($newAmount < $customer->stage->daily_contribution) {
                //Update Account
                $this->updateCalculatingPeriodAccount($calculatingPeriodAccount, $newAmount);
            } elseif ($newAmount == $customer->stage->daily_contribution) {
                //close account
                $account = $this->closeCalculatingPeriodAccount($customer, $calculatingPeriodAccount);

                //Credit Accounts
                $this->creditPremiumAccounts($customer, 1, $account->account_id);
            } else {
                //Amount is more than customer stage amount
                $amount = $newAmount - $customer->stage->daily_contribution;
                //close account
                $account = $this->closeCalculatingPeriodAccount($customer, $calculatingPeriodAccount);
                //Open a new Calculating Period Account
                CalculatingPeriodAccountService::create($customer->user_id, $amount);

                //Credit Accounts
                $this->creditPremiumAccounts($customer, 1, $account->account_id);
            }
        } else {
            //No Calculating Account: Create New
            CalculatingPeriodAccountService::create($customer->user_id, $balance);
        }
    }

    function creditPremiumAccounts($customer, $days, $reference)
    {
        //Get Latest Credit Date of any Account
        $account = ConvinienceFeeAccount::query()->where("user_id", $customer->user_id)->latest('created_at')->first();
        if ($account) {
            $lastPaymentDate = $account->date;
            for ($j = 0; $j < $days; $j++) {
                $date = Carbon::createFromFormat('d-m-Y', $lastPaymentDate)->addDays($j + 1);
                ConvinienceFeeAccountService::create($customer->user_id, $date->format('d-m-Y'), $reference);
                MedicalInsuranceService::create($customer->user_id, $date->format('d-m-Y'), $reference);
                VendorAccountService::create($customer, $date->format('d-m-Y'), $reference);//Holding Account
            }
        } else {
            //First timer
            for ($j = 0; $j < $days; $j++) {
                $date = Carbon::now()->addDays($j);
                ConvinienceFeeAccountService::create($customer->user_id, $date->format('d-m-Y'), $reference);
                MedicalInsuranceService::create($customer->user_id, $date->format('d-m-Y'), $reference);
                VendorAccountService::create($customer, $date->format('d-m-Y'), $reference);
            }
        }
    }
}
