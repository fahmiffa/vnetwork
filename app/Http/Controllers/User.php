<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use App\Models\Device;
use App\Models\Port;
use App\Models\Service;
use App\Models\Server;
use App\Models\orderPort;
use App\Models\User as Us;
use Alert;
use App\Services\Midtrans\CreateSnapTokenService; 
use App\Services\Midtrans\CreateSnapToken; 
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Rules\InName;
use App\Veritrans\Veritrans;

class User extends Controller
{
    public function index()
    {            
        $or = Order::where('user',Auth()->user()->id)->get();       
        $data = 'Dashboard';
        
        return view('user.blank',compact('or','data'));
    }


    public function payPort($id)
    {
        $order = orderPort::where('id',$id)->first();           

        $user = $order->port->device->order->users;
        $data = 'Payment';    
        
        $snapToken = $order->mid;
        $inv = $order->inv;

        if (empty($snapToken) && empty($inv)) { 
            $order->inv = invp($order->id);
            $order->save();
            $midtrans = new CreateSnapToken($order);
            $snapToken = $midtrans->getSnapToken();                              
            $order->mid = $snapToken;            
            $order->save();        
    
            SendEmail($user->email,config('notif.order'));
            SendWa($user->hp,config('notif.order.body'));
            
        }


        return view('user.remote.pay',compact('snapToken','data','order'));
    }

    public function pay($id)
    {
        $order = Order::where('id',$id)->first();   
        $data = 'Payment';    
        
        $snapToken = $order->mid;
        $inv = $order->inv;

        if (empty($snapToken) && empty($inv)) { 
            $order->inv = inv($order->id);
            $order->save();
            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();            
            $order->mid = $snapToken;            
            $order->save();
            
            $details = [
                'subject'=>'Payment Service',
                'body' => 'Do complete payment to get service'
            ];
    
            SendEmail($order->users->email,config('notif.order'));
            $wa = SendWa($order->users->hp,config('notif.order.body'));
            
        }


        return view('user.pay',compact('snapToken','data','order'));
    }

    public function submit(Request $request)
    {

        $ser = Service::findOrFail($request->service);
        $lay = $ser->lay;
        $ip = ranges($ser->local,$ser->id);

        $device = Device::create([
            'user'=>$request->username,
            'password'=>$request->password,
            'port'=>$request->port,
            'ip'=>$ip
        ]);

        $or = Order::create([
            'user'=>Auth()->user()->id,
            'service'=>$request->service,
            'server'=>$request->serv,
            'device'=>$device->id,
            'status'=>1
        ]);

        Alert::success('Info', 'Order successful, please do payment');
        return redirect()->route('user');
    
    }

    public function remote()
    {
        $data = 'Data Remote';    
        $da = Order::where('user',Auth()->user()->id)->get();   
        return view('user.remote.index',compact('data','da'));
    }

    public function premote(Request $request)
    {
        $messages   =   [
            'username.required'       =>  'Username wajib diisikan',
            'password.required'       =>  'Password wajib diisikan',
            'port.required'       =>  'Port wajib diisikan',
            'port.digits_between'       =>  'Nilai port minimal 2 dan maksimal 5 digit',
            'port.gte'       =>  'Nilai port minimal atau sama dengan 80'                        
        ];
        
        
        $validasi = Validator::make(
            $request->all(),
            [       
                'username' => ['required', New InName($request)],
                'password' => 'required',
                'port' => 'required|digits_between:2,5|gte:80',
            ],
            $messages
        );
        if ($validasi->fails()) {         
            
            return back()->withErrors($validasi)->withInput();
        } else {

            try {
                $ser = Service::findOrFail($request->serv);
                
                $lay = $ser->lay;                
                $ip = ranges($ser->ser,$ser->remote,$ser->id);                
                $dst = rangePORT($ser->id);                
                $local = rangeIP($ser->id);                                    
        
                
    
                $device = Device::create([
                    'user'=>$request->username,
                    'password'=>$request->password,                    
                    'ip'=>$ip,                        
                    'local'=>$local                    
                ]);

                Port::create([   
                    'devices_id'=>$device->id,                     
                    'dstPort'=>$dst,      
                    'port'=>$request->port
                ]);
        
                $or = Order::create([
                    'user'=>Auth()->user()->id,
                    'service'=>$request->serv,
                    'device'=>$device->id,
                    'time'=>$request->time,
                    'status'=>1
                ]);
        
                Alert::success('Info', 'Order successful, please do payment');
                return redirect()->route('remote');
    
            } catch (Exception $e) {
                Alert::error('Error', $e->getMessage());
                return back();
            }

        }       

    
    }

    public function services(Request $request)
    {
        $da = Service::where('server',$request->id)
        ->where('cat',$request->cat)
        ->get();
        return response()->json($da);
    }
    
    public function addRemote()
    {
        $server = Server::where('status',1)->get();        
        $data = 'Add Remote';
        return view('user.remote.create',compact('data','server'));
    }

    public function tunnel()
    {
        $data = 'Data Tunnel';    
        $da = Order::where('user',Auth()->user()->id)->get();
        return view('user.tunnel.index',compact('data','da'));
    }
    
    public function orderTunnel($id)
    {
        $da = Order::findOrFail($id);
        
        dd($da);
    }
    
    public function orderRemote($id)
    {
        $da = Order::findOrFail($id);     

        // dd($da->devices->port[1]->orderPort);
        $data = 'Data Port';           
        return view('user.port', compact('da','data'));
    }

    public function addTunnel()
    {        
        $data = 'Add Tunnel';
        $server = Server::where('status',1)->get();      
        return view('user.tunnel.create',compact('server','data'));
    }

    public function addPort(Request $request, $id)
    {
        $messages   =   [
            'port.required'       =>  'Port wajib diisikan',
            'port.digits_between' =>  'Nilai port minimal 2 dan maksimal 5 digit',
            'port.gte'            =>  'Nilai port minimal atau sama dengan 80'                        
        ];
        
        
        $validasi = Validator::make(
            $request->all(),
            [            
                'port' => 'required|digits_between:2,5|gte:80',
            ],
            $messages
        );
        if ($validasi->fails()) {                                 
            return back()->withErrors($validasi)->withInput();
        } else {

            try {                

                $da = Order::findOrFail($id);                                      
                $ser = Service::findOrFail($da->service);                                                
                $dst = rangePORT($ser->id);                                      
                $port = Port::create([     
                    'devices_id'=>$da->device,   
                    'dstPort'=>$dst,                      
                    'port'=>$request->port
                ]);

                orderPort::create([
                    'ports_id'=>$port->id,
                    'status'=>1,
                ]);

                Alert::success('Info', 'Insert Port successful');      
    
            } catch (Exception $e) {                
                Alert::error('Error', $e->getMessage());
            }
            return back();

        }       
    }

    public function removePort(Request $request, $id)
    {
            try {                
                $port = Port::findOrFail($id);            
                $or = orderPort::where('ports_id',$id)->first();                          
                
                deleteRemote($port->device->order,$port);   
                if($or != null)
                {
                    $or->delete();     
                }
                $port->delete();             
                Alert::success('Info', 'Delete Port successful');      
    
            } catch (Exception $e) {
                Alert::error('Error', $e->getMessage());
            }
            return back();             
    }

    public function ptunnel(Request $request)
    {

        try {
            $ser = Service::findOrFail($request->serv);
            
            $lay = $ser->lay;
            $ip = ranges($ser->ser,$ser->remote,$ser->id);

            $device = Device::create([
                'user'=>$request->username,
                'password'=>$request->password,            
                'ip'=>$ip
            ]);
    
            $or = Order::create([
                'user'=>Auth()->user()->id,
                'service'=>$request->serv,
                'device'=>$device->id,
                'time'=>$request->time,
                'status'=>1
            ]);
    
            Alert::success('Info', 'Order successful, please do payment');
            return redirect()->route('tunnel');

        } catch (Exception $e) {
            Alert::error('Error', $e->getMessage());
            return back();
        }

    }

    public function Setting()
    {
        $data = 'Update Password';
        $da = Us::where('id', Auth()->user()->id)->first();
        return view('user.setting.index',compact('data','da'));
    }

    public function psetting(Request $request)
    {
        $messages   =   [
            'user.required'      =>  'Username harus di isi',  
            'pass.required'      =>  'Password harus di isi',                                                                                                    
        ];


        $validasi = Validator::make(
            $request->all(),
            [                       
                'user' => 'required',      
                'pass' => 'required',                                          
            ],
            $messages
        );
        if ($validasi->fails()) {            
            return back()->withErrors($validasi)->withInput();
        } else {

            $user = Us::where('id', Auth()->user()->id)->first();
            $user->name = $request->user;
            $user->password = bcrypt($request->pass);                        
            $user->update();
    
            Alert::success('Info', 'Update Success');            
            return back();
        }    
    }

}
