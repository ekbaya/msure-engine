<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "success" => true,
            "status" => 0,
            "message" => "Message sent successfully",
            "data"  => Message::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StoreMessageRequest $request)
    {
        $request->merge([
            'user_id' => $request->user()->user_id,
        ]);
        $payload = $request->all();
        Message::create($payload);
        return response()->json([
            "success" => true,
            "status" => 0,
            "message" => "Message sent successfully",
        ]);
    }

    public function userMessages(Request $request)
    {
        return response()->json([
            "success" => true,
            "status" => 0,
            "message" => "Message sent successfully",
            "data" => Message::all()->where('user_id', $request->user()->user_id),
        ]);
    }
}
