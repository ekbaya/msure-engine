<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Requests\CreateOrganizationRequest;


class OrganizationController extends Controller
{
    public function addOrganization(CreateOrganizationRequest $request){
        $payload = $request->all();
        $stage = Stage::create($payload);
        return response()->json([
            "success" => true,
            "status" => 0,
            "message" => "Stage added successfully",
            "data" => $stage,
        ]);
    }
}
