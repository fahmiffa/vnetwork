<?php
use Mail as Mail;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Http;
use \RouterOS\Client;
use \RouterOS\Query as Q;
use App\Models\Setting;
use App\Models\Device;
use App\Models\Order;
use App\Models\Server;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;


function subscribeTime()
{
    return [30,90,180,365];
}

function levelUser()
{
    return ['root','user'];
}

function status($da)
{
    if($da < 1)
    {        
        return '<span class="badge bg-warning">Unpaid</span>';
    }
    else if($da == 1)
    {
        return '<span class="badge bg-dark">Pending</span>';
    }
    else if($da == 2)
    {
        return '<span class="badge bg-success">Success</span>';
    }
    else if($da == 3)
    {
        return '<span class="badge bg-danger">Expired</span>';
    }
    else
    {
        return '<span class="badge bg-success">Paid</span>';
    }
}

function active($da)
{
    if($da)
    {
        return '<span class="badge bg-success">ON</span>';
    }
    else
    {
        return '<span class="badge bg-dark">OFF</span>';
    }
}

function sendEmail($email,$details,$link = null)
{
    Mail::to($email)->send(new MyMail($details,$link));              
}

function inv($id)
{
    $ran = date('His');
    $mode = (env('APP_DEBUG')) ? $ran : $id;
    return 'INV' . (str_pad((int)$mode + 1, 5, '0', STR_PAD_LEFT));
}


function invp($id)
{
    $ran = date('His');
    $mode = (env('APP_DEBUG')) ? $ran : $id;
    return 'INVP' . (str_pad((int)$mode + 1, 5, '0', STR_PAD_LEFT));
}


function sendWa($no,$msg)
{
    $to = '62'.ltrim($no,0);
    $domain = 'https://api.stiker-label.com/send';
    $data = [            
        'number'  => ENV('WA_NOMOR'),
        'to'  => $to,
        'message' => $msg,
    ];
    return $response   =   Http::withHeaders(["Content-Type" => "application/json"])->post($domain, $data)->json();       
}

function tunnel($or)
{

    $client = client($or->services->ser);

    $query =
    (new Q('/ppp/secret/add'))
        ->equal('name', $or->devices->user)
        ->equal('password', $or->devices->password)              
        ->equal('profile', $or->services->lay);
        
    $response = $client->query($query)->read();

}

function removeTunnel($or)
{

    $client = client($or->services->ser);

    $query =
    (new Q('/ppp/secret/print'))
        ->where('name', $or->devices->user);
        
    $r = $client->query($query)->r();
    
    if(count($r) > 0)
    {
        $q =(new Q('/ppp/secret/remove'))->equal('.id', $r[0]['.id']); 
        $client->query($q)->r();
        
    }

}

function remote($or)
{

    $client = client($or->services->ser);

    $query =
    (new Q('/ip/firewall/nat/add'))
        ->equal('action', 'dst-nat')
        ->equal('chain', 'dstnat')      
        // server          
        ->equal('dst-address', $or->services->ser->ip)
        // ->equal('dst-port', $or->services->ser->port)
        ->equal('dst-port', $or->devices->port[0]->dstPort)
        ->equal('protocol', 'tcp')
        ->equal('to-addresses', $or->devices->ip)
        ->equal('to-ports', $or->devices->port[0]->port);
        
    $response = $client->query($query)->read();

    remoteTunnel($or);
}

function remoteTunnel($or)
{

    $client = client($or->services->ser);

    $q =
    (new Q('/ppp/secret/add'))
        ->equal('name', $or->devices->user)
        ->equal('password', $or->devices->password)              
        ->equal('remote-address', $or->devices->ip)              
        ->equal('local-address', $or->devices->local)              
        ->equal('profile', $or->services->lay);
        
    $res = $client->query($q)->read();


}

function removeRemote($or)
{

    $client = client($or->services->ser);
    $port = $or->devices->port;

    foreach($port as $row) :
        
        $query =
        (new Q('/ip/firewall/nat/print'))
            ->where('to-ports',$row->port)
            ->where('dst-port', $row->dstPort);
            
        $r = $client->query($query)->r();
    
        if(count($r) > 0)
        {
            $q =(new Q('/ip/firewall/nat/remove'))->equal('.id', $r[0]['.id']); 
            $client->query($q)->r();
            
        }    
    endforeach;

    

    removeRemoteTunnel($or);
}

function deleteRemote($or,$port)
{


    $client = client($or->services->ser);

    $query =
    (new Q('/ip/firewall/nat/print'))
        ->where('to-ports',$port->port)
        ->where('dst-port', $port->dstPort);
        
    $r = $client->query($query)->r();
    
    if(count($r) > 0)
    {
        $q =(new Q('/ip/firewall/nat/remove'))->equal('.id', $r[0]['.id']); 
        $client->query($q)->r();
        
    }
    
}

function removeRemoteTunnel($or)
{

    $client = client($or->services->ser);
    
    $query =
    (new Q('/ppp/secret/print'))
        ->where('name', $or->devices->user);
        
    $r = $client->query($query)->r();
    
    if(count($r) > 0)
    {
        $q =(new Q('/ppp/secret/remove'))->equal('.id', $r[0]['.id']); 
        $client->query($q)->r();
        
    }


}

function addPort($or,$port,$dst)
{

    $client = client($or->services->ser);

    $query =
    (new Q('/ip/firewall/nat/add'))
        ->equal('action', 'dst-nat')
        ->equal('chain', 'dstnat')      
        // server          
        ->equal('dst-address', $or->services->ser->ip)        
        ->equal('dst-port', $dst)
        ->equal('protocol', 'tcp')
        ->equal('to-addresses', $or->devices->ip)
        ->equal('to-ports', $port);
        
    $response = $client->query($query)->read();
}

function removeLastTIme($or)
{

    $client = client($or->services->ser);

    $query =
    (new Q('/system/scheduler/print'))
        ->where('name', $or->devices->user);
        
    $r = $client->query($query)->r();
    
    if(count($r) > 0)
    {
        $q =(new Q('/system/scheduler/remove'))->equal('.id', $r[0]['.id']); 
        $client->query($q)->r();
        
    }

}

function lastTIme($or)
{

    $client = client($or->services->ser);

    $time = $or->time.'d';
    $query =
    (new Q('/system/scheduler/add'))
        ->equal('interval', $time)
        ->equal('name', $or->devices->user)              
        ->equal('on-event', '/ppp secret set [find name='.$or->devices->user.'] dis=yes;  /ppp active remove [find name='.$or->devices->user.']; /system sche remove  [find name='.$or->devices->user.']');
        
    $response = $client->query($query)->read();

}


function client($set)
{
    $port = (int) $set->port;
    $client = new Client([
        'host' => $set->host,
        'user' => $set->user,
        'pass' => $set->pass,
        'port' => $port
    ]);

    return $client;

}

function pool($ser,$val,$id)
{
    $server = Server::where('id',$ser)->first();
    $client = client($server);
    $query = (new Q('/ip/pool/print'))->where('name', $val);                        
    $ser = $client->q($query)->r();    

    if(count($ser) < 1)
    {
        return false;
    }
    else
    {
        $val = explode("-",$ser[0]['ranges']);
        $start = explode(".",$val[0]);    
        $vstart = $start[count($start)-1];
        $end = explode(".",$val[1]);    
        $vend = $end[count($end)-1];      

        $n = $vend-$vstart;
        $da = Order::where('service',$id)        
        ->count();

        if($da < $n)
        {
            return true;
        }
        else
        {
            return false;
        }
    
    }

}

function ranges($ser,$val,$id)
{
    
    $client = client($ser);
    $query = (new Q('/ip/pool/print'))->where('name', $val);                        
    $ser = $client->q($query)->r(); 
    

    $val = explode("-",$ser[0]['ranges']);

    $start = explode(".",$val[0]);    
    $vstart = $start[count($start)-1];
    $end = explode(".",$val[1]);    
    $vend = $end[count($end)-1];

    $cc = Order::where('service',$id);
    
    
    if($cc->exists())
    {
        $da = $cc->first()->devices->ip;        
        $ips = explode(".",$da);    
        $last = array_pop($ips)+1;            
        return implode(".",array_merge($ips,[$last]));   

    }
    else
    {
        return $val[0];
    }    
    
}

function rangeIP($id)
{
    
    $val = explode("-",env('IP'));

    $start = explode(".",$val[0]);    
    $vstart = $start[count($start)-1];
    $end = explode(".",$val[1]);    
    $vend = $end[count($end)-1];

    $cc = Order::where('service',$id)->orderBy('id', 'desc');

    if($cc->exists())
    {
        $da = $cc->first()->devices->local;     
        $ips = explode(".",$da);    
        $last = array_pop($ips)+1;            
        return implode(".",array_merge($ips,[$last]));   

    }
    else
    {
        return $val[0];
    }    
    
}

function rangePORT($id)
{
    
    $val = env('DST_PORT');

    
    $cc = Order::where('service',$id)->orderBy('id', 'desc');
    

    if($cc->exists())
    {
        $da = $cc->first()->devices->port->toArray();     
        $col = collect($da)->pop();        
        return $col['dstPort']+1; 
    }
    else
    {
        return $val;
    }    
    
}

function RemoteAddress($id,$val)
{    

    $client = client($id);
    $query = (new Q('/ppp/profile/print'))->where('remote-address')->where('name',$val);                        
    return $ser = $client->q($query)->r();      
}


function lastLogin($or)
{    

    $client = client($or->services->ser);    
    $query = (new Q('/ppp/secret/print'))->where('last-logged-out')->where('name',$or->devices->user);                        
    $ser = $client->q($query)->r();   

    if(count($ser) > 0)
    {
        if($ser[0]['last-logged-out'] == "jan/01/1970 00:00:00")
        {
            return null;
        }
        else
        {
            return $ser[0]['last-logged-out'];
        }    

    }
    else
    {
        return null;
    }

}

function lastIP($or)
{    

    $client = client($or->services->ser);        
    $query = (new Q('/ppp/active/print'))->where('name',$or->devices->user);                                       
    $ser = $client->q($query)->r();       

    if(count($ser) > 0)
    {
        return $ser[0]['address'];
    }
    else
    {
        return null;
    }    
}
