<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Http\Requests\CreateOrganizationRequest;


class OrganizationController extends Controller
{
    public function addOrganization(CreateOrganizationRequest $request){
        $payload = $request->all();
        $organization = Organization::create($payload);
        return response()->json([
            "success" => true,
            "status" => 0,
            "message" => "Organization created successfully",
            "data" => $organization,
        ]);
    }
}
