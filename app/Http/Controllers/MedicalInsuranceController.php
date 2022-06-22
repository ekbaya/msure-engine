<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicalInsuranceRequest;
use App\Http\Requests\UpdateMedicalInsuranceRequest;
use App\Models\MedicalInsurance;

class MedicalInsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMedicalInsuranceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMedicalInsuranceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalInsurance  $medicalInsurance
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalInsurance $medicalInsurance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicalInsurance  $medicalInsurance
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalInsurance $medicalInsurance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMedicalInsuranceRequest  $request
     * @param  \App\Models\MedicalInsurance  $medicalInsurance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMedicalInsuranceRequest $request, MedicalInsurance $medicalInsurance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalInsurance  $medicalInsurance
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalInsurance $medicalInsurance)
    {
        //
    }
}
