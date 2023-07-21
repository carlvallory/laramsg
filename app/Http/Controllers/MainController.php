<?php

namespace App\Http\Controllers;

use App\Models\Msg;
use App\Models\Qr;
use App\Models\Login;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Throwable;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $dt     = Carbon::now()->timezone("America/Asuncion");
        $hour   = $dt->format("H");
        $time   = $hour . ":00";
        $today   = Str::lower($dt->format("l"));

        $msgs = Msg::getTodayMsgs()->get();
	    $schedule = Schedule::where('start', $time)->where('day', $today)->get();

        if($request->ajax()){
            return response()->json(['msgs'=> $msgs]);
        }

        return view('dashboard.index', [
            'msgs' => $msgs
        ]);
    }

    public function qr(Request $request, $qr)
    {   
        if (request()->has('id')) {
            $qr    = request()->get('qr');

            Log::info(base64_decode($qr));
            $msg = new Qr();
            $msg->qr_str = $qr;
            $msg->save();

            $response = [ 
                'status'    => 200, 
                'message'   => 'QR Receive'
            ];
            return response()->json($response);
        } else if($qr) {

            Log::info(base64_decode($qr));
            $msg = new Qr();
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

    public function login(Request $request, $user)
    {   
        if (request()->has('user')) {
            $user    = request()->get('user');

            $msgLogin = new Login();
            $msgLogin->user = $user;
            $msgLogin->status = true;
            $msgLogin->save();

            $response = [ 
                'status'    => 200, 
                'message'   => 'Schedule Receive'
            ];
            return response()->json($response);
        } else if($user) {

            Log::info(base64_decode($user));
            
            $msgLogin = new Login();
            $msgLogin->user = $user;
            $msgLogin->status = true;
            $msgLogin->save();

            $response = [ 
                'status'    => 200, 
                'message'   => 'Schedule Receive'
            ];
            return response()->json($response);
        } else {
            $response = [ 
                'status'    => 404, 
                'message'   => 'Schedule Not Found'
            ];
            return response()->json($response);
        }
    }

    public function logout(Request $request, $user)
    {   
        if (request()->has('user')) {
            $user    = request()->get('user');

            $url = config('node.url');
            $port = config('node.port');

            $response = Http::get($url . ':' . $port . '/logout');
            $jsonData = $response->json();

            $msgLogin = new Login();
            $msgLogin->user = base64_encode($user);
            $msgLogin->status = false;
            $msgLogin->save();

            $response = [ 
                'status'    => 200, 
                'message'   => 'Logout Receive',
                'data'      => $jsonData
            ];
            return response()->json($response);
        } else if($user) {

            Log::info(base64_decode($user));
            
            $url = config('node.url');
            $port = config('node.port');

            $response = Http::get($url . ':' . $port . '/logout');
            $jsonData = $response->json();

            $msgLogin = new Login();
            $msgLogin->user = $user;
            $msgLogin->status = false;
            $msgLogin->save();

            $response = [ 
                'status'    => 200, 
                'message'   => 'Logout Receive',
                'data'      => $jsonData
            ];
            return response()->json($response);
        } else {
            $response = [ 
                'status'    => 404, 
                'message'   => 'Logout Not Found'
            ];
            return response()->json($response);
        }
    }

    public function schedules(Request $request, $id)
    {   
        if (request()->has('id')) {
            $id    = request()->get('id');

            $response = [ 
                'status'    => 200, 
                'message'   => 'Schedule Receive'
            ];
            return response()->json($response);
        } else if($id) {

            Log::info(base64_decode($id));
            
            //code

            $response = [ 
                'status'    => 200, 
                'message'   => 'Schedule Receive'
            ];
            return response()->json($response);
        } else {
            $response = [ 
                'status'    => 404, 
                'message'   => 'Schedule Not Found'
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
        $qr = Qr::latest()->first();
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
    public function store(Request $request, $id, $from, $to, $body, $name = null, $picture = null, $author = null)
    {
        if (request()->has('id') && request()->has('body')) {
            $id     = request()->get('id');
            $from   = request()->get('from');
            $to     = request()->get('to');
            $body   = request()->get('body');

            if(request()->has('image')) {
                $image   = request()->get('image');
            } else {
                $image   = null;
            }

            if(request()->has('name')) {
                $name   = request()->get('name');
            } else {
                $name   = null;
            }

            if(request()->has('picture')) {
                $picture   = request()->get('picture');
            } else {
                $picture   = null;
            }

            if(request()->has('author')) {
                $author = request()->get('author');
            } else {
                $author = null;
            }

            Log::info($id);

            $dt     = Carbon::now()->timezone("America/Asuncion");
            $hour   = $dt->format("H");
            $time   = $hour . ":00";

            $body = base64_encode(while_decode($body));
            if($image != 00) { $image = base64_encode(while_decode($image)); } else { $image = null; }
            if($name != 00) { $name = base64_encode(while_decode($name)); } else { $name = null; }
            if($picture != 00) { $picture = base64_encode(while_decode($picture)); } else { $picture = null; }
            if($author == 00) { $author = null; }

            $msg = new Msg();
            $msg->msg_id        = $id;
            $msg->msg_from      = $from;
            $msg->msg_to        = $to;
            $msg->msg_body      = $body;
            $msg->msg_image     = $image;
            $msg->msg_name      = $name;
            $msg->msg_picture   = $picture;
            $msg->msg_author    = $author;
            $msg->schedule_start = $time;
            $msg->save();

            $msg->delete();

            Log::warning($name);

            $response = [ 
                'status'    => 200, 
                'message'   => 'Message Receive',
                'id'        => $id,
                'body'      => $body
            ];
            return response()->json($response);
        } else if($id && $body) {
            Log::info($id);
            
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                Log::alert($image->getRealPath());
            } else {
                $image = null;
            }

            $dt     = Carbon::now()->timezone("America/Asuncion");
            $hour   = $dt->format("H");
            $time   = $hour . ":00";

            if(base64_decode($body) == "file") {
                $body = null;
            } else {
                $body = base64_encode(while_decode($body));
            }

            if($image instanceof UploadedFile) {
                //
            } else {
                if($image == 00) { $image = null; }
            }
            if($name != 00) { $name = base64_encode(while_decode($name)); } else { $name = null; }
            if($picture != 00) { $picture = base64_encode(while_decode($picture)); } else { $picture = null; }
            if($author == 00) { $author = null; }

            if($image != null) {
                $fileName = "{$id}.jpg";
                try {
                    $image->store($fileName);
                } catch (Throwable $e) {
                    $response = [ 
                        'status' => 500, 
                        'message' => $e->getMessage()
                    ];
        
                    return response()->json($response);
                }
            } else {
                $fileName = null;
            }
            

            try {
                $msg = new Msg();
                $msg->msg_id        = $id;
                $msg->msg_from      = $from;
                $msg->msg_to        = $to;
                $msg->msg_body      = $body;
                $msg->msg_image     = $fileName;
                $msg->msg_name      = $name;
                $msg->msg_picture   = $picture;
                $msg->msg_author    = $author;
                $msg->schedule_start = $time;
                $msg->save();

                $msg->delete();

            } catch (Throwable $e) {
                    
                $response = [ 
                    'status' => 500, 
                    'message' => $e->getMessage()
                ];
    
                return response()->json($response);
            }

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
    public function show(Request $request, $id=null)
    {
        $msgs = Msg::all();

        return view('dashboard.show', [
            'msgs' => $msgs
        ]);
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
