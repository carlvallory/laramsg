<?php

namespace App\Http\Controllers;

use App\Models\Msg;
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
    public function chat(Request $request)
    {
        $msgs = Msg::latest()->paginate(9);

        if ($request->ajax()) {
            $html = '';
            foreach ($msgs as $msg) {
                $html.= $this->html($msg);
            }
            return $html;
        }

        return view('dashboard.msgs.chat',compact('msgs'))

                    ->with('i', (request()->input('page', 1) - 1) * 5);
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
        '<form method="DELETE" action="'+ route('admin.msgs.delete', $msg->id) +'">' +
            '<div class="row message-body">' +
                '<div class="col-sm-12 message-main-sender">' +
                    '<div class="sender">' +
                        '<div class="message-text">' +
                            '<a>' + base64_decode($msg->msg_name) + '</a>' +
                            '<p>' + base64_decode($msg->msg_body) + '</p>' +
                        '</div>' +
                        '<span><input type="checkbox" onChange="this.form.submit()" name="delete" value="' + $msg->id + '"></span>' +
                        '<span class="message-time pull-right">' +
                            Carbon::parse(($msg->created_at))->format('H:m') +
                        '</span>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        "</form>";

        return $html;
    }
}
