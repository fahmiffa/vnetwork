<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Server;
use App\Models\Service;
use \RouterOS\Client;
use \RouterOS\Query as Q;

class InName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($req)
    {
        //
        $this->req = $req;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $service = Service::where('id',$this->req->serv)->first();
        $client = client($service->ser);
        
         $query = (new Q('/ppp/secret/print'))->where('name',$this->req->username);     
         $ser = $client->q($query)->r();   
        
         return (count($ser) > 0) ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
          return 'Username Sudah ada';
    }
}
