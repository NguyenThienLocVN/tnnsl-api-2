<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Mail;

use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        
        $messages = [
            'name.required' => 'Vui lòng nhập tên',
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Vui lòng nhập địa chỉ mail hợp lệ',
            'phone.numeric' => 'Vui lòng nhập số điện thoại hợp lệ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự',
            'address.required' => 'Vui lòng nhập địa chỉ',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'address' =>   'required|max:255',
            'phone' => 'required|numeric',
        ], $messages);
   
        if($validator->fails()){
            $messages = $validator->errors()->all();
            $msg = $messages[0];
            return response()->json(['error_message' => $msg], 400);       
        }
        else
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'phone' => $request->phone,
                'role' => 'client',
                'status' => 0,
                'type' => $request->type
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;

            // send mail
            // $details = [
            //     'title' => 'Xác thực email đăng ký',
            //     'dear' => $request->name,
            //     'link' => 'abc',
            // ];
            // Mail::to($request->email)->send(new \App\Mail\SendMail($details));
           
            
            
            return response()->json(['success_message' => 'Đăng ký thành công, vui lòng kích hoạt tài khoản !' ]);
        }      
    }

    public function login(Request $request)
    {
        $messages = [
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ];

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ], $messages);

        if($validator->fails()){
            $messages = $validator->errors()->all();
            $msg = $messages[0];
            return response()->json(['error_message' => $msg], 400);       
        }

        $credentials = [
            'username' => $request['username'],
            'password' => $request['password']
        ];

        if (Auth::attempt($credentials)) 
        {
            if(Auth::user()->status == 1)
            {
                $user = User::where('username', $request['username'])->firstOrFail();
                $token = $user->createToken('auth_token')->plainTextToken;
    
                return response()->json(['remember_token' => $token, 'user' => $user]);
            }
            else
            {
                return response()->json(['message' =>'Vui lòng kích hoạt tài khoản trước khi đăng nhập'], 401);
            }
        }
        else
        {
            return response()->json(['message' =>'Tài khoản hoặc mật khẩu không chính xác'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete(); 

        return response()->json(['message' => 'Logout successfully']);
    }
}