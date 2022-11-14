<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Device;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = 'Data Order';    
        $da = Order::all();    
        return view('admin.order.index',compact('data','da'));
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if($order->services->cat == 'Tunnel')
        {
            $a = removeTunnel($order);                            
        }

        if($order->services->cat == 'Remote')
        {          
                removeRemote($order);                            
        }

        removelastTIme($order);

        SendEmail($order->users->email,config('notif.exp'));
        SendWa($order->users->hp,config('notif.exp.body'));    
        
        //
        $device = Device::where('id',$order->device)->first();
        $device->delete();
        $order->delete();
        
        return back();
    }
}
