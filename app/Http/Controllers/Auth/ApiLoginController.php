<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Validator;
use App\User;
use DB;
class ApiLoginController extends Controller
{
    public function login (Request $request) {
    $validator = Validator::make($request->all(), [
        'email' => 'required',
        'password' => 'required',
    ]);
    if ($validator->fails())
    {
        return response(['errors'=>$validator->errors()->all()], 422);
    }
	 $email = $request->email;
	$password= $request->password;
	  if(Auth::attempt(['email'=>$email,'password'=>$password])) {
		$user = Auth::user();
		$id = $user->id;
		$status=DB::table('product')
		->select('product.id','product.name','product.rate','product.quantity')->where('product.users_id','=',$id)
		->get();
				 return response(['status'=>$status], 200);
			}else{
				$error = "Not match data";
				return response(['error'=>$error], 201);
			}
   
}
}

