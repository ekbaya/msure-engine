<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Http\Requests\PurchasePolicyRequest;
use App\Models\Payment;
use App\Services\MpesaService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return response()->json([
           "status"=> 0,
           "success"=>true,
           "message"=>"Payments fetched sucessfully",
           "data"=> Payment::all()->where(["Status"=>"paid"])
       ]);
    }

}
