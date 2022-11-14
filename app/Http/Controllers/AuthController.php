<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Forgot;
use Illuminate\Support\Facades\Validator;
use Alert;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Exception;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login()
    {                
        $data = 'Login';            
        return view('log',compact('data'));
    } 

    public function forget()
    {             
        $data = 'Forgot Password';            
        return view('forgets',compact('data'));
    } 
    
    public function pforget(Request $request)
    {

            $messages   =   [                
                'email.required'       =>  'Email wajib diisikan',
            ];
    
    
            $validasi = Validator::make(
                $request->all(),
                [       
                    'email' => 'required'                    
                ],
                $messages
            );
            if ($validasi->fails()) {
                return back()->withErrors($validasi)->withInput();
            } else {

                $user = User::where('email',$request->email);
                $da = $user->exists();

                If($da)
                {
                    $random = $user->first()->id.Str::random(40);     
                    $now = Carbon::now();
                    $exp = Carbon::now()->addHour(env('EXP'));                           


                    $del = Forgot::where('user_id',$user->first()->id)->exists();
                    if($del)
                    {
                        $del->first()->delete();
                    }
                    

                    Forgot::create([
                        'user_id'=>$user->first()->id,
                        'exp'=>$exp,
                        'random'=>$random
                    ]);

                    $link = url('verif/'.$random);

                    SendEmail($request->email,config('notif.reset'),$link);
                    Alert::success('info', 'Send a link to reset your password, check email');
                    return back();
                }
                else
                {                 
                    Alert::error('error', 'Email not found');
                    return back();
                }

            }        
        
    }

    public function verif($id)
    {            

        try {
            $ids = substr($id,0,1);                
    
            $user = Forgot::where('user_id',$ids)->where('random',$id);
            $now = Carbon::now();

            if(!$user->exists())
            {
                throw new Exception("Link Forgot Password Invalid");
                
            }
    
            if($now > $user->first()->exp)
            {
                throw new Exception("Link Forgot Password expired");
            }                        

            $data = 'New Password';            
            $da = $user->first();
            return view('ver',compact('data','da'));                       
        } catch (Exception $e) {

            Alert::error('error', $e->getMessage());
            return redirect('forget');
            
        }

    } 
    
    public function pverif(Request $request, $id)
    {

            $messages   =   [                
                'password.required'       =>  'password wajib diisikan',
                'password.confirmed'       =>  'password confirm tidak sama',
            ];
    
    
            $validasi = Validator::make(
                $request->all(),
                [       
                    'password' => 'required|confirmed'             
                ],
                $messages
            );
            if ($validasi->fails()) {
                return back()->withErrors($validasi)->withInput();
            } else {

                $user = User::where('id',$id)->first();
                $da = $user->exists();
 
                If($da)
                {
                    $user->password = bcrypt($request->password);
                    $user->save();
                    Alert::success('info', 'Success Update Password');
                    return redirect('login');
                }
                else
                {                 
                    Alert::error('error', 'Invalid Update Password');
                    return redirect('login');
                }

            }        
        
    }

    public function reg()
    {
        
        $email = session('email');
        $data = 'Register';                
        return view('register',compact('data','email'));
    }  

    public function register(Request $request)
    {
        $messages   =   [
            'username.required'       =>  'Username wajib diisikan',
            'password.required'       =>  'Pasword wajib diisikan',
            'email.required'       =>  'Email wajib diisikan',
            'email.unique'       =>  'Email sudah ada',
            'hp.required'       =>  'No Hp wajib diisikan',
            'hp.unique'       =>  'No Hp sudah ada',
            'hp.digits_between' => 'No HP minimal 12 dan maksimal 13 digit'
        ];


        $validasi = Validator::make(
            $request->all(),
            [       
                'email' => 'required|unique:users,email',
                'username' => 'required',
                'password' => 'required',
                'hp' => 'required|digits_between:12,13',
                // 'hp' => 'required|digits_between:12,13|unique:users,hp',
            ],
            $messages
        );
        if ($validasi->fails()) {
            
            return back()->withErrors($validasi)->withInput();
        } else {

            
            User::create([
                'email'=>$request->email,
                'hp'=>$request->hp,
                'name'=>$request->username,
                'password'=>bcrypt($request->password),
                'level'=>'user'
            ]);

            SendEmail($request->email,config('notif.reg'));
            SendWa($request->hp,config('notif.reg.body'));

            Alert::success('Info', 'Registration successful, please login');
            return redirect()->route('login');
        }        
    
    }

    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return Redirect('login');
    }

    public function log(Request $request)
    {

            $messages   =   [
                'password.required'       =>  'Pasword wajib diisikan',
                'email.required'       =>  'Email wajib diisikan',
            ];
    
    
            $validasi = Validator::make(
                $request->all(),
                [       
                    'email' => 'required',
                    'password' => 'required',
                ],
                $messages
            );
            if ($validasi->fails()) {
                return back()->withErrors($validasi)->withInput();
            } else {

                $credensil = $request->only('email','password');;

                if (Auth::attempt($credensil)) {
                    $user = Auth::user();                      

                    
                    if ($user->level == 'root') {
                        return redirect()->to('dashboard');  
                    }
                    
                    
                    if ($user->level == 'user') {
                        return redirect()->to('user');  
                    }
                    dd($user);    
                }                      
                Alert::error('Error', 'Account not found');
                return back();
            }        
        
    }
    

}
