<?php
 
namespace App\Services\Midtrans;
 
use Midtrans\Snap;
 
class CreateSnapToken extends Midtrans
{
    protected $order;
 
    public function __construct($order)
    {
        parent::__construct();
 
        $this->order = $order;
    }
 
    public function getSnapToken()
    {       

        $user = $this->order->port->device->order->users;

        $params = [
            'transaction_details' => [
                'order_id' => $this->order->inv,
                'name' => $this->order->port->port,
                'gross_amount' => $this->order->price,
            ],
            'item_details' => [
                [
                    'id' => $this->order->inv,
                    'price' => $this->order->price,
                    'quantity' => 1,
                    'name' => $this->order->port->port,
                ]
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->hp,
            ]
        ];
 
        $snapToken = Snap::getSnapToken($params);
 
        return $snapToken;
    }
}