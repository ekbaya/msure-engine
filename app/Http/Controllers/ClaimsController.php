<?php

namespace App\Http\Controllers;

use App\Http\Requests\InitiateClaimRequest;
use App\Services\AspinEngine;
use Illuminate\Http\Request;

class ClaimsController extends Controller
{
    public function customerClaims(Request $request)
    {
        $engine = new AspinEngine();
        return $engine->getCustomerClaims($request->user());
    }

    public function claimDetails(Request $request)
    {
        $engine = new AspinEngine();
        return $engine->getClaimDetails($request->id);
    }

    public function initiateClaim(InitiateClaimRequest $request)
    {
        $engine = new AspinEngine();
        return $engine->initiateClaim($request);
    }

}
