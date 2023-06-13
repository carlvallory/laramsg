<?php

namespace App\Http\Controllers;

use App\Models\msg;
use App\Models\qr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $msgs = msg::all();

        return view('dashboard.index', [
            'msgs' => $msgs
        ]);
    }

    public function qr(Request $request, $qr)
    {   
        if (request()->has('id')) {
            $qr    = request()->get('qr');

            Log::info(base64_decode($qr));
            $msg = new qr();
            $msg->qr_str = $qr;
            $msg->save();

            $response = [ 
                'status'    => 200, 
                'message'   => 'QR Receive'
            ];
            return response()->json($response);
        } else if($qr) {

            Log::info(base64_decode($qr));
            $msg = new qr();
            $msg->qr_str = $qr;
            $msg->save();

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
    public function create(Request $request)
    {
        $qr = qr::latest()->first();
        if ($qr) {

            return view('dashboard.qrcode', [
                'qr' => $qr
            ]);

        }

        $response = [ 
            'status'    => 500, 
            'message'   => 'QR NOT SET'
        ];
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $from, $to, $body, $author = null)
    {
        if (request()->has('id') && request()->has('body')) {
            $id     = request()->get('id');
            $from   = request()->get('from');
            $to     = request()->get('to');
            $body   = request()->get('body');

            if(request()->has('author')) {
                $author = request()->get('author');
            } else {
                $author = null;
            }

            Log::info($id);

            $msg = new msg();
            $msg->msg_id    = $id;
            $msg->msg_from  = $from;
            $msg->msg_to    = $to;
            $msg->msg_body  = $body;
            $msg->msg_author = $author;
            $msg->save();

            $response = [ 
                'status'    => 200, 
                'message'   => 'Message Receive',
                'id'        => $id,
                'body'      => $body
            ];
            return response()->json($response);
        } else if($id && $body) {
            Log::info($id);

            $msg = new msg();
            $msg->msg_id = $id;
            $msg->msg_from  = $from;
            $msg->msg_to    = $to;
            $msg->msg_body = $body;
            $msg->msg_author = $author;
            $msg->save();

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

    public function admin(Request $request)
    {  

    }
}
