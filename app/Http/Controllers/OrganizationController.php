<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Http\Requests\CreateOrganizationRequest;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function addOrganization(CreateOrganizationRequest $request)
    {
        $payload = $request->all();
        $organization = Organization::create($payload);
        return response()->json([
            "success" => true,
            "status" => 0,
            "message" => "Organization created successfully",
            "data" => $organization,
        ]);
    }


    public function getOrganizationsByType(Request $request)
    {
        try {
            return response()->json([
                "type" => $request->type,
                "organizations" => Organization::query()->where('type', $request->type)->get(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Organization type not found"
            ], 404);
        }
    }
}
