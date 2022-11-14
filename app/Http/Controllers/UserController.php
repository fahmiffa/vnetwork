<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //        
        $data ='Data user';
        $da = User::all();
        return view('admin.user.index',compact('data','da'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data ='Tambah Data user';        
        return view('admin.user.create',compact('data'));
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
            'email.required'     =>  'Email harus di isi',                                                                                 
            'email.unique'       =>  'Email sudah ada',         
            'password.required'  =>  'Password harus di isi',    
            'hp.required'  =>  'Nomor HP harus di isi', 
            'hp.unique'  =>  'Nomor HP sudah ada',                                                                            
        ];


        $validasi = Validator::make(
            $request->all(),
            [                       
                'name' => 'required',
                'email' => 'required|unique:users',    
                'password' => 'required',
                'hp' => 'required|unique:users'                      
            ],
            $messages
        );
        if ($validasi->fails()) {            
            return back()->withErrors($validasi)->withInput();
        } else {
                                    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'hp' => $request->hp,      
                'level'=>$request->level
            ]); 
           
                        
            return redirect()->route('user.index');
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);   
        $data ='Edit user';                              
        return view('admin.user.edit',compact('user','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages   =   [
            'name.required'      =>  'nama harus di isi',                        
            'email.required'     =>  'Email harus di isi',                                                                                 
            'email.unique'       =>  'Email sudah ada',         
            'password.required'  =>  'Password harus di isi',    
            'hp.required'  =>  'Nomor HP harus di isi', 
            'hp.unique'  =>  'Nomor HP sudah ada',                                                                            
        ];


        $validasi = Validator::make(
            $request->all(),
            [                       
                'name' => 'required',
                'email' => 'required|unique:users,email,'.$id,       
                'hp' => 'required|unique:users,hp,'.$id,                      
            ],
            $messages
        );
        if ($validasi->fails()) {            
            return back()->withErrors($validasi)->withInput();
        } else {
                          
            $user = User::findOrFail($id);   
            $user->name = $request->name;
            $user->email = $request->email;
            $user->level = $request->level;
            if($request->password != null)
            {
                $user->password = bcrypt($request->password);
            }
            $user->hp = $request->hp;
            $user->update();
            // $user = User::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'password' => bcrypt($request->password),
            //     'hp' => $request->hp,      
            //     'level'=>'user'                      
            // ]); 
           
                        
            return redirect()->route('user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $user = User::findOrFail($id);        
        $user->delete();
        
        if($user){            
            return redirect()->back()->with(['success' => 'Data Berhasil Dihapus!']);
        }else{            
            return redirect()->back()->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
