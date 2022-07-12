<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStageRequest;
use App\Http\Requests\StoreWardRequest;
use App\Models\County;
use App\Models\Region;
use App\Models\Stage;
use App\Models\SubCounty;
use App\Models\Ward;
use Illuminate\Http\Request;

class PlacesController extends Controller
{

    public function regions()
    {
        return Region::all();
    }

    public function counties(Request $request)
    {
        try {
            return response()->json([
                "region" => Region::query()->where('id', $request->region_id)->firstOrFail(),
                "counties" => Region::query()->where('id', $request->region_id)->firstOrFail()->counties,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Region Not Found"
            ], 404);
        }
    }

    public function subCounties(Request $request)
    {
        try {
            return response()->json([
                "county" => County::query()->where('id', $request->county_id)->firstOrFail(),
                "sub_counties" => County::query()->where('id', $request->county_id)->firstOrFail()->subCounties,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "County Not Found"
            ], 404);
        }
    }

    public function wards(Request $request)
    {
        try {
            return response()->json([
                "sub_county" => SubCounty::query()->where('id', $request->sub_county_id)->firstOrFail(),
                "wards" => SubCounty::query()->where('id', $request->sub_county_id)->firstOrFail()->wards,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "SubCounty Not Found"
            ], 404);
        }
    }

    public function stages(Request $request)
    {
        try {
            return response()->json([
                "ward" => Ward::query()->where('id', $request->ward_id)->firstOrFail(),
                "stages" => Ward::query()->where('id', $request->ward_id)->firstOrFail()->stages,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "Ward Not Found"
            ], 404);
        }
    }

    public function createWard(StoreWardRequest $request){
        $payload = $request->all();
        $ward = Ward::create($payload);
        return response()->json([
            "success" => true,
            "status" => 0,
            "message" => "Ward added successfully",
            "data" => $ward = Ward::create($payload),
        ]);
    }

    public function addStage(StoreStageRequest $request){
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
