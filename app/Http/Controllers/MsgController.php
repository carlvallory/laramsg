<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Msg;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Throwable;

class MsgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $msgs = Msg::latest()->paginate(5);

        return view('dashboard.msgs.index',compact('msgs'))

                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chat(Request $request, $id = null)
    {
        $msgs = Msg::getTodayMsgs()->paginate(20);
        $login = Login::latest()->first();
        $loginAuth = Login::isLogged();

        $altSchedules = Schedule::getTodaySchedules()->whereNotNull('parent_id')->get();
        $mainSchedules = Schedule::getTodaySchedules()->whereNull('parent_id')->get();

        if(!$msgs->isEmpty()) {

            $limit = $msgs->last()->id;

            if ($request->ajax()) {
                $html = '';
                foreach ($msgs as $msg) {
                    $html.= $this->html($msg);
                }
                return $html;
            }

            return view('dashboard.msgs.chat',
                compact('msgs', 'mainSchedules', 'altSchedules', 'limit', 'login', 'loginAuth'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            $limit = 0;
            return view('dashboard.msgs.chat',
                compact('msgs', 'mainSchedules', 'altSchedules', 'limit', 'login', 'loginAuth'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadChat(Request $request, $id = null)
    {
        $msgs = Msg::getTodayMsgs()->where('id', '>', $id)->paginate(5);

        $altSchedules = Schedule::getTodaySchedules()->whereNotNull('parent_id')->get();
        $mainSchedules = Schedule::getTodaySchedules()->whereNull('parent_id')->get();
        
        if(!$msgs->isEmpty()) {
            $msg    = $msgs->last();
            $limit  = $msg->id;

            if($id != $limit) {

                if ($request->ajax()) {
                    $response = [ 
                        'status'    => 200, 
                        'success'   => 'Response is ready',
                        'msgs'      => $msgs->toarray(),
                        'msg'       => $msg,
                        'limit'     => $limit
                        ];
                    return response()->json($response);
                }
            }
        } else {
            $response = [ 
                'status' => 500, 
                'error' => 'Response is empty'
                ];
    
            return response()->json($response);
        }
        
        $response = [ 
            'status' => 404, 
            'error' => 'Ajax expected'
            ];

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.msgs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'body' => 'required',
        ]);
        
        Msg::create($request->all());
         
        return redirect()->route('admin.msgs.index')
                        ->with('success','Msg created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Msg  $msg
     * @return \Illuminate\Http\Response
     */
    public function show(Msg $msg)
    {
        return view('dashboard.msgs.show',compact('msg'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Msg  $msg
     * @return \Illuminate\Http\Response
     */
    public function edit(Msg $msg)
    {
        return view('dashboard.msgs.edit',compact('msg'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Msg  $msg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Msg $msg)
    {
        $request->validate([
            'id' => 'required',
            'body' => 'required',
        ]);
        
        $msg->update($request->all());
        
        return redirect()->route('admin.msgs.index')
                        ->with('success','Msg updated successfully');
    }

    public function delete(Request $request, $id)
    {

        try {
            $msg = Msg::find($id);
            $msg->delete();

            $response = [ 
                        'status' => 200, 
                        'success' => 'Msg deleted successfully'
                        ];
            
            return response()->json($response);

        } catch (Throwable $e) {
                    
            $response = [ 
                'status' => 500, 
                'message' => $e->getMessage()
            ];

            return response()->json($response);
        }
    }

    public function restore(Request $request, $id)
    {

        try {
            $msg = Msg::withTrashed()->find($id);
            $msg->restore();

            $response = [ 
                        'status' => 200, 
                        'success' => 'Msg restored successfully'
                        ];
            
            return response()->json($response);

        } catch (Throwable $e) {
                    
            $response = [ 
                'status' => 500, 
                'message' => $e->getMessage()
            ];

            return response()->json($response);
        }
    }

    public function deactivate(Request $request, $id)
    {
        Log::info('deactivate');
        try {
            $msg = Msg::find($id);
            $msg->active_at = null;
            $msg->save();

            $response = [ 
                        'status' => 200, 
                        'success' => 'Msg deactivated successfully'
                        ];
            
            return response()->json($response);

        } catch (Throwable $e) {
                    
            $response = [ 
                'status' => 500, 
                'message' => $e->getMessage()
            ];

            Log::alert($response);

            return response()->json($response);
        }
    }

    public function activate(Request $request, $id)
    {
        Log::info('activate');
        try {
            $deactivate = Msg::whereNotNull('active_at')->first();
            if($deactivate) {
                $deactivate->active_at = null;
                $deactivate->save();
            }

        } catch (Throwable $e) {
            Log::alert([ 
                'status' => 500, 
                'message' => $e->getMessage()
            ]);
        }


        try {
            $msg = Msg::find($id);

            if($msg) {
                $msg->active_at = now();
                $msg->save();

                $response = [ 
                            'status' => 200, 
                            'success' => 'Msg activated successfully'
                            ];
                
                return response()->json($response); 
            } else {
                $response = [ 
                    'status' => 200, 
                    'success' => 'Msg was not activated'
                ];
        
                return response()->json($response); 
            }

        } catch (Throwable $e) {
                    
            $response = [ 
                'status' => 500, 
                'message' => $e->getMessage()
            ];

            Log::alert($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Msg  $msg
     * @return \Illuminate\Http\Response
     */
    public function destroy(Msg $msg)
    {
        $msg->delete();
         
        return redirect()->route('admin.msgs.index')
                        ->with('success','Msg deleted successfully');
    }

    private function html($msg) {
        $html =
        '<form method="DELETE" action="'. route('admin.msgs.delete', $msg->id) .'">' .
            '<div class="row message-body">' .
                '<div class="col-sm-12 message-main-sender">' .
                    '<div class="sender">' .
                        '<div class="message-text">' .
                            '<a>' . base64_decode($msg->msg_name) . '</a>' .
                            '<p>' . base64_decode($msg->msg_body) . '</p>' .
                        '</div>' .
                        '<span><input type="checkbox" onChange="this.form.submit()" name="delete" value="' . $msg->id . '"></span>' .
                        '<span class="message-time pull-right">' .
                            Carbon::parse(($msg->created_at))->format('H:m') .
                        '</span>' .
                    '</div>' .
                '</div>' .
            '</div>' .
        "</form>";

        return $html;
    }
}
