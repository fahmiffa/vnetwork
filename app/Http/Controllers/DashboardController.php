<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Http;
use Alert;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{

    public function index()
    {                         
        $order = Order::all();  
        $user = User::where('level','user')->get();
        
        return view('admin.main',compact('order','user'));        
    }

    public function wa()
    {
        $data = 'Whatsapp';
        return view('admin.wa',compact('data'));
    }

    public function send(Request $request)
    {
        $domain = 'https://api.stiker-label.com/send';
        $data = [            
            'number'  => env('WA_NOMOR'),
            'to'  => $request->to,
            'message' => $request->message,
        ];
        $response = Http::withHeaders(["Content-Type" => "application/json"])        
        ->post($domain, $data)
        ->json();   

        if(!empty($response) && $response['status'])
        {
            Alert::success('Info', 'Send successful');
        }
        else
        {
            Alert::error('error', 'Internal Server Error');
        }
        return back();
                
    }

}
