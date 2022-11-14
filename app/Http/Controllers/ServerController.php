<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Service;
use App\Models\Order;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = 'Data Server';
        $da = Server::all();
        return view('admin.server.index',compact('da','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = 'Tambah Data Server';        
        return view('admin.server.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $messages   =   [
            'name.required'      =>  'nama harus di isi',      
            'user.required'      =>  'Username harus di isi',
            'pass.required'      =>  'Password harus di isi',                                                                                                                                                                          
            'host.required'      =>  'Host harus di isi',                                                                                                                                                                          
            'port.required'      =>  'Port harus di isi',
            'ip.required'      =>  'Ip harus di isi',                                                                                                                                                                          
        ];


        $validasi = Validator::make(
            $request->all(),
            [                       
                'name' => 'required',
                'user' => 'required',
                'host' => 'required',
                'port' => 'required',
                'pass' => 'required',
                'ip' => 'required'             
            ],
            $messages
        );
        if ($validasi->fails()) {            
            return back()->withErrors($validasi)->withInput();
        } else {
                                    
            Server::create([
                'name' => $request->name,
                'user' => $request->user,
                'host' => $request->host,
                'pass' => $request->pass,
                'port' => $request->port,
                'ip' => $request->ip,
                'status'=>1,
            ]); 
    
            return redirect()->route('server.index');
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function edit(Server $server)
    {
        //
        $data = 'Data Server';
        $da = $server;
        return view('admin.server.edit',compact('da','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Server $server)
    {
        $messages   =   [
            'name.required'      =>  'nama harus di isi',      
            'user.required'      =>  'Username harus di isi',
            'pass.required'      =>  'Password harus di isi',                                                                                                                                                                          
            'host.required'      =>  'Host harus di isi',                                                                                                                                                                          
            'port.required'      =>  'Port harus di isi', 
            'ip.required'      =>  'IP harus di isi',                                                                                                                                                                          
        ];


        $validasi = Validator::make(
            $request->all(),
            [                       
                'name' => 'required',
                'user' => 'required',
                'host' => 'required',
                'port' => 'required',
                'pass' => 'required',
                'ip' => 'required'                
            ],
            $messages
        );
        if ($validasi->fails()) {            
            return back()->withErrors($validasi)->withInput();
        } else {

        
            $server->status = ($request->status != null) ? 1 : 0;    
            $server->name = $request->name;
            $server->user = $request->user;
            $server->host = $request->host;
            $server->port = $request->port;
            $server->ip = $request->ip;
            $server->pass = $request->pass;
            $server->update();

            return redirect()->route('server.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server)
    {
        //
        $service = Service::where('server',$server->id);
        if($service->exists())
        {
            $order = Order::where('service',$service->first()->id);
            
            if($order->exists())
            {
                    $device = Device::where('id',$order->first()->device)->first();
                    $device->delete();
                    $order->delete();
            }
            
            $service->first()->delete();
        }
        
        $server->delete();
        return back();
    }
}
