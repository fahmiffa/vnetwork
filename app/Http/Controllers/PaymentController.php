<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\orderPort;
use Illuminate\Http\Request;
use App\Services\Midtrans\CallbackService;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

    public function receive()
    {
        $callback = new CallbackService;
 
        if ($callback->isSignatureKeyVerified()) {
            $notification = $callback->getNotification();
            $order = $callback->getOrder();   
            
            
            $mode = (env('APP_DEBUG')) ? 'inv' : 'id';
            $val = (env('APP_DEBUG')) ? $order->inv : $order->id;
                
            if ($callback->isSuccess()) {                
                $or = Order::where($mode, $val)->first();
                $da = orderPort::where($mode, $val)->first();

                if($or != null)
                {
                    $or->status = 2;
                    $or->active = date('Y-m-d');
                    $or->save();
                    
                    if($or->services->cat == 'Tunnel')
                    {
                        tunnel($or);   
                    }
    
                    if($or->services->cat == 'Remote')
                    {          
                        remote($or);                            
                    }
    
                    lastTIme($or);
    
                    SendEmail($or->users->email,config('notif.pay'));
                    SendWa($or->users->hp,config('notif.pay.body'));    

                }
                else
                {
                    $user = $da->port->device->order->users;
                    $order = $da->port->device->order;
                    $da->status = 2;           
                    $da->save();                
                    
                    addPort($order,$da->port->port,$da->port->dstPort);     

                    SendEmail($user->email,config('notif.pay'));
                    SendWa($user->hp,config('notif.pay.body'));    
                }

                
            }

            
            if ($callback->isExpire()) {
                Order::where($mode, $val)->update([
                    'status' => 3,
                ]);        
            }
 
            if ($callback->isCancelled()) {
                Order::where($mode, $val)->update([
                    'status' => 4,
                ]);                
            }
 
            return response()
                ->json([
                    'success' => true,
                    'message' => 'Notifikasi berhasil diproses',
                ]);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key tidak terverifikasi',
                ], 403);
        }
    }
    
    public function cron()
    {
        
        $now = date('Y-m-d H:i:s',strtotime("now"));

        $order = Order::all();
        foreach($order as $row) :
            
            $email = $row->users->email;
            $hp = $row->users->hp;
        
            if($row->active != null)
            {
                $dexp = date('Y-m-d',strtotime($row->active. " +".ENV('EXP_SER')." days"));
                $dlate = date('Y-m-d',strtotime($row->active. " +".ENV('EXP_WARN')." days"));
                
                $exp = date('Y-m-d H:i:s',strtotime($dexp." 09:00:00"));
                $late = date('Y-m-d H:i:s',strtotime($dlate." 09:00:00"));
                
                if($now == $exp)
                {
                    if($row->services->cat == 'Tunnel')
                    {
                        removeTunnel($row);                            
                    }
            
                    if($row->services->cat == 'Remote')
                    {          
                        removeRemote($row);                            
                    }
            
                    removelastTIme($row);
                    
                    SendEmail($email,config('notif.exp'));
                    SendWa($hp,config('notif.exp.body'));
        
                    Log::info('Cronjob expired');
                }
                
                if($now == $late)
                {
                    
                    SendEmail($email,config('notif.late'));
                    SendWa($hp,config('notif.late.body'));
                    
                    Log::info('Cronjob Warning');
                }
                
            }
            
        endforeach;
    }
    
}
