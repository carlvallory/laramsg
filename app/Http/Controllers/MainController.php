<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id, $body)
    {   
        if (request()->has('id') && request()->has('body')) {
            $id    = request()->get('id');
            $body   = request()->get('body');
            Log::info($id);
            $response = [ 
                'status'    => 200, 
                'message'   => 'Message Receive',
                'id'        => $id,
                'body'      => $body
            ];
            return response()->json($response);
        } else if($id && $body) {
            Log::info($id);
            $response = [ 
                'status'    => 200, 
                'message'   => 'Message Receive',
                'id'        => $id,
                'body'      => $body
            ];
            return response()->json($response);
        } else {
            $response = [ 
                'status'    => 404, 
                'message'   => 'Message Not Found'
            ];
            return response()->json($response);
        }
    }

    public function qr(Request $request, $qr)
    {   
        if (request()->has('id')) {
            $qr    = request()->get('qr');
            Log::info(base64_decode($qr));
            $response = [ 
                'status'    => 200, 
                'message'   => 'QR Receive'
            ];
            return response()->json($response);
        } else if($qr) {
            Log::info(base64_decode($qr));
            $response = [ 
                'status'    => 200, 
                'message'   => 'QR Receive'
            ];
            return response()->json($response);
        } else {
            $response = [ 
                'status'    => 404, 
                'message'   => 'QR Not Found'
            ];
            return response()->json($response);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
