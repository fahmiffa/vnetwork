<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Server;
use App\Models\Order;
use App\Models\Device;
use App\Models\Categori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \RouterOS\Query as Q;
use Alert;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $data = 'Data Service';
        $da = Service::all();
        return view('admin.service.index',compact('da','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        $ser = Server::all();

        $data = 'Tambah Data Service';            
        return view('admin.service.create',compact('data','ser'));
    }

    public function lay(Request $request)
    {
        $da = Server::where('id',$request->id)->first();
        $client = client($da);
        $query = (new Q('/ppp/profile/print'));        
        $ser = $client->q($query)->r();        

        return response()->json($ser);
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
            'name.required'      =>  'Nama harus di isi',   
            'ser.required'      =>  'Server harus di isi',  
            'lay.required'      =>  'Layanan harus di isi',  
            'price.required'      =>  'Harga harus di isi',                                                                                            
            'cat.required'      =>  'Categori harus di isi',                                                                                            
        ];


        $validasi = Validator::make(
            $request->all(),
            [                       
                'name' => 'required',
                'ser' => 'required',
                'lay' => 'required',
                'price' => 'required',
                'cat' => 'required',                       
            ],
            $messages
        );
        if ($validasi->fails()) {            
            return back()->withErrors($validasi)->withInput();
        } else {
            $price = str_replace(['Rp.','.'],null,$request->price); 

            $server = Server::where('id',$request->ser)->first();
            $remote = remoteAddress($server,$request->lay);           

            Service::create([
                'name' => $request->name,  
                'lay' => $request->lay,  
                'server' => $request->ser,     
                'cat' => $request->cat,     
                'price' => $price,       
                'remote'=>$remote[0]['remote-address'], 
                'status'=>1       
            ]); 
                        
            return redirect()->route('service.index');
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $da = $service; 
        $data ='Edit service';   

        $sv = Server::where('id',$service->server)->first();
        $client = client($sv);
        $query = (new Q('/ppp/profile/print'));        
        $lay = $client->q($query)->r();    

        $ser = Server::all();        
        return view('admin.service.edits',compact('data','da','ser','lay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $messages   =   [
            'name.required'      =>  'Nama harus di isi',   
            'ser.required'      =>  'Server harus di isi',  
            'lay.required'      =>  'Layanan harus di isi',  
            'price.required'      =>  'Harga harus di isi',     
            'cat.required'      =>  'Categori harus di isi',                                                                                                                                                                                     
        ];


        $validasi = Validator::make(
            $request->all(),
            [                       
                'name' => 'required',
                'ser' => 'required',
                'lay' => 'required',
                'price' => 'required', 
                'cat' => 'required',                                         
            ],
            $messages
        );
        if ($validasi->fails()) {            
            return back()->withErrors($validasi)->withInput();
        } else {

            $price = str_replace(['Rp.','.'],null,$request->price); 
            $server = Server::where('id',$request->ser)->first();
            $remote = remoteAddress($server,$request->lay);           

            $service->name = $request->name;
            $service->lay = $request->lay;
            $service->server = $request->ser;
            $service->cat = $request->cat;
            $service->remote = $remote[0]['remote-address'];
            $service->price = $price;  
            $service->update();
           
                        
            return redirect()->route('service.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
         $order = Order::where('service',$service->id);
        if($order->exists())
        {
                $device = Device::where('id',$order->first()->device)->first();
                $device->delete();
                $order->delete();
        }
            
        $service->delete();
        return back();
    }
}
