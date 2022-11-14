<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Setting;
use App\Models\Server;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'root',
            'password'=>bcrypt('jalan'),
            'hp'=>'085',
            'level'=>'root',
            'email'=>'admin@root.com'
        ]);

        User::create([
            'name'=>'user',
            'password'=>bcrypt('jalan'),
            'hp'=>'085226061579',
            'level'=>'user',
            'email'=>'faisol.ajifa@gmail.com'
        ]);

        Server::create([
            'name'=> 'Singapore',
            'user'=>'romi',
            'pass'=>'romifl',
            'port'=>'8728',
            'host'=>'sg2.vnetwork-tunnel.my.id',
            'ip'=>'165.232.162.9',
            'status'=>1,
        ]);


        Server::create([
            'name'=> 'Indonesia',
            'user'=>'romi',
            'pass'=>'romifl',
            'port'=>'8728',
            'host'=>'id3.vnetwork-tunnel.my.id',
            'ip'=>'43.229.254.88',
            'status'=>1,
        ]);

    }
}
