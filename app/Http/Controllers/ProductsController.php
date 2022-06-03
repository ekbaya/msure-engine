<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchasePolicyRequest;
use App\Services\AspinEngine;
use App\Services\MpesaService;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $engine = new AspinEngine();
        return $engine->getAllProducts();
    }

    
    public function purchasePolicy(PurchasePolicyRequest $request)
    {
        //mpesa
        $mpesa = new MpesaService();
        return $mpesa->stkPush($request);
    }

    public function customerPolicy(Request $request)
    {
        $engine = new AspinEngine();
        return $engine->getCustomerPolicy($request->user());
    }

    public function customerActivepolicy(Request $request)
    {
        $engine = new AspinEngine();
        return $engine->getCustomerActivePolicy($request->user());
    }

    public function cancelPolicy(Request $request)
    {
        $engine = new AspinEngine();
        return $engine->cancelPolicy($request->id);
    }
}
