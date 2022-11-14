<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Alert;
use Auth;
use App\Rules\MatchOldPassword;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $da = User::where('id', Auth()->user()->id)->first();        
        return view('admin.profile.index',compact('da'));
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
        $messages   =   [
            'user.required'      =>  'Username harus di isi',  
            'email.required'       =>  'Email wajib diisikan',
            'email.unique'       =>  'Email sudah ada',
            'hp.required'       =>  'No Hp wajib diisikan',
            'hp.unique'       =>  'No Phone sudah ada',
            'hp.digits_between' => 'No Phone minimal 12 dan maksimal 13 digit'                                                                                                  
        ];


        $validasi = Validator::make(
            $request->all(),
            [                       
                'user' => 'required',      
                'email' => 'required|unique:users,email,'.Auth()->user()->id,
                'hp' => 'required|digits_between:12,13',                                       
            ],
            $messages
        );
        if ($validasi->fails()) {            
            return back()->withErrors($validasi)->withInput()->with('user',true);
        } else {

            $user = User::where('id', Auth()->user()->id)->first(); 
            if($request->email != null)
            {
                $user->email = $request->email;
            }

            if($request->user != null)
            {
                $user->name = $request->user;          
            }
            
            if($request->hp != null)
            {
                $user->hp = $request->hp;          
            }

            if($request->pass != null)
            {
                $user->password = bcrypt($request->pass);                        
            }
            $user->update();
    
            Alert::success('Info', 'Update Success');            
            return back();
        }    
    }

    public function up(Request $request)
    {
        $messages   =   [
            'pass.required'      =>  'Current password harus diisi',                          
            'password.required'      =>  'New password harus diisi',                                      
            'password.confirmed'      =>  'Confirm password invalid',                          
        ];


        $validasi = Validator::make(
            $request->all(),
            [                       
                'pass' => ['required', new MatchOldPassword],      
                'password'=>'required|confirmed',                
            ],
            $messages
        );
        if ($validasi->fails()) {            
            return back()->withErrors($validasi)->withInput()->with('pass',true);;
        } else {

            $user = User::where('id', Auth()->user()->id)->first(); 
                   
            $user->password = bcrypt($request->pass);                        
            $user->update();
    
            Alert::success('Info', 'Update Success');            
            return back();
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
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
                                    
            $setting->user = $request->user;
            $setting->pass = $request->pass;
            $setting->port = $request->port;
            $setting->host = $request->host;
            $setting->update();
    
            Alert::success('Info', 'Update Success');            
            return redirect()->route('setting.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
