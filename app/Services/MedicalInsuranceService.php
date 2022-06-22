<?php

namespace App\Services;

use App\Models\MedicalInsurance;

/**
 * Class MedicalInsuranceService.
 */
class MedicalInsuranceService
{
    public static function create(String $user_id,String $date, String $reference){
        MedicalInsurance::create(
            [
                "user_id"=>$user_id,
                "date" =>$date,
                "reference"=>$reference
            ]
        );
    }
}
