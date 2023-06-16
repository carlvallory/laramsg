<?php

namespace App\Http\Controllers;

use App\Models\Msg;
use Illuminate\Http\Request;

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
    public function home()
    {
        $msgs = Msg::latest()->paginate(9);

        return view('dashboard.msgs.home',compact('msgs'))

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
         
        return redirect()->route('dashboard.msgs.index')
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
        
        return redirect()->route('dashboard.msgs.index')
                        ->with('success','Msg updated successfully');
    }

    public function delete(Msg $msg)
    {
        $msg->delete();
         
        return redirect()->route('dashboard.msgs.home')
                        ->with('success','Msg deleted successfully');
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
         
        return redirect()->route('dashboard.msgs.index')
                        ->with('success','Msg deleted successfully');
    }
}
