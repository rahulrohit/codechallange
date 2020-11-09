<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use DB;
use Image;
use App\Http\Requests;
use App\UserData;
use App\User;
use App\RolesMaster;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class UsersController extends Controller
{

    public function index()
    {

        $data['users'] = UserData::FetchUsersData();
		
        $data['dropdown'] = DB::table('users')->select('id', 'name')
            ->get();

       

        return view('users', compact('data'));

    }
	
	 

       public function rahul()
    {

		$user = Auth::user();
		$id = $user->id;
		$data['users']=DB::table('product')
		->select('product.id','product.name','product.rate','product.quantity')->where('product.users_id','=',$id)
		->get();

      

        return view('rahul', compact('data'));

    }
	
    public function usersformPost(Request $request)
    {
					$name = $request->input('name');
					$email = $request->input('email');
					$input['email'] = Input::get('email');
					$rules = array(
					'email' => 'unique:users,email'
					);
					$validator = Validator::make($input, $rules);
					if ($validator->fails())
					{
					return Redirect('users')
					->with(['message' => 'That email address is already registered.']);
					}
					else
					{

					$password = Hash::make($request->input('password'));
					$phone = $request->input('phone');
					$deparment = $request->input('deparment');
					$stime = $request->input('stime');
					$role = $request->input('role');
					$extension_id = $request->input('extension_id');
					$supervisor = $request->input('supervisor');
					$extension = $request->file('image');
					if ($extension == !"")
					{
					$filename = uniqid() . '.' . $extension->getClientOriginalExtension();
					$dir = 'upload/';
					$file = $request->file->move(public_path('upload/') , $filename);
					}
					else
					{
					$filename = "image.jpg";
					}

					$data = array(
					'name' => $name,
					"email" => $email,
					"role_id" => $role,
					"extension_id" => $extension_id,
					"password" => $password
					);
					$insertid = UserData::create($data);
					$inseredId = $insertid->id;

					$data2 = array(
					"user_id" => $inseredId,
					"deparment" => $deparment,
					"mobile_number" => $phone,
					"shift_time" => $stime,
					"reporting_to" => $supervisor,
					"profile_pic" => $filename
					);
					$r2 =DB::table('user_details')->insert($data2);
					$data['code'] = 200;
					$data['message']= 'success';

					try{


					$data = DB::table('users')->join('user_details', 'users.id', '=', 'user_details.user_id')
					->join('user_role', 'users.role_id', '=', 'user_role.id')
					->select('users.id', 'users.name', 'users.role_id', 'users.password', 'users.email','users.extension_id', 'user_details.deparment', 'user_details.mobile_number', 'user_details.shift_time', 'user_details.reporting_to', 'user_details.profile_pic', 'user_role.role')
					->get();

					$html = view('ajax.AjaxUserUpdateData')->with(['users' => $data])->render();
					$data['code'] = 200;
					$data['html'] = $html;

					}catch(\Exception $e){
					$data['code'] = 100;
					$data['message']= 'error'.$e->getMessage();
					}
					return response()->json($data);
					}


    }

    public function EditUser(Request $id)
    {

        $data = DB::table('users')->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->join('user_role', 'users.role_id', '=', 'user_role.id')
            ->select('users.id', 'users.name', 'users.password', 'users.email','users.extension_id', 'users.role_id', 'user_details.deparment', 'user_details.mobile_number', 'user_details.shift_time', 'user_details.reporting_to', 'user_details.profile_pic', 'user_role.role')
            ->where('users.id', $id->id)
            ->first();

        $rolesmaster = DB::table('user_role')->select('id', 'role')
            ->get();

        $shiftmaster = DB::table('shift_timing')->select('id', 'name')
            ->get();

        $html = view('ajax.AjaxUserUpdate')->with(['data' => $data])->with(['rolesmaster' => $rolesmaster])->with(['shiftmaster' => $shiftmaster])->render();
        return response()
            ->json(['success' => true, 'html' => $html]);
    }

    public function edituserdatas(Request $request)
    {
        $uname = $request->input('name');
        $uemail = $request->input('email');
        $data['code'] = 100;
        $phone = $request->input('phone');
        $ext = $request->input('ext');
        $shifttime = $request->input('shifttime');
        $supervisor = $request->input('supervisor');
        $updaterole = $request->input('updaterole');
		$updateextensionid =  $request->input('extension_id');
        $editdata1 = DB::update('update users set name =?,email=?,role_id=?,extension_id=? where id = ?', [$uname, $uemail, $updaterole, $updateextensionid, $request->id]);
        $editdata = DB::update('update user_details set mobile_number =?,deparment=?,shift_time=?,reporting_to=? where user_id = ?', [$phone, $ext, $shifttime, $supervisor, $request->id]);

        $users = UserData::FetchUsersData();

        $html = view('ajax.AjaxUserUpdateData')->with(['users' => $users])->render();
        $data['code'] = 200;
        $data['html'] = $html;

        return response()->json($data);

    }

    public function destroy($id)
    {

        $deleteusers = UserData::DeleteUsers($id);
        $delete = UserData::DeleteUsersDetails($id);
        return response()->json($deleteusers);
    }
	
	
	public function Filterdata(Request $request)
    {   
	
	    $fname 		= $request->get('fname');
		$femail 	= $request->get('femail');
		$fdepartment 		= $request->get('fdepartment');
		$fsupervisor 	= $request->get('fsupervisor');
		$fstime 		= $request->get('fstime');
		
        
        try{
			
			$data['code'] = 100;
            $data['message'] = 'Error';
           
            $users =DB::table('users')
		            ->join('user_details', 'users.id', '=', 'user_details.user_id')
		            ->join('shift_timing', 'user_details.shift_time', '=', 'shift_timing.id')
		            ->join('user_role', 'user_details.reporting_to', '=', 'user_role.id')
		            ->select('users.id','users.name','users.password','users.email','users.extension_id','user_details.deparment', 'user_details.mobile_number', 'user_details.shift_time', 'user_details.reporting_to', 'user_details.profile_pic','shift_timing.timing','user_role.role')->orderBy('users.id', 'asc');
			
							if(isset($fname)){
							    $users ->where('name', $fname);	
							}
							if(isset($femail)){
								$users ->where('email', $femail);
							}
							if(isset($fdepartment)){
							    $users ->where('deparment', $fdepartment);	
							}
							if(isset($fsupervisor)){
								$users ->where('reporting_to', $fsupervisor);
							}
							if(isset($fstime)){
							    $users ->where('shift_time', $fstime);	
							}
							
							
							$users=$users ->get();
							
				//echo "<pre>";	
				//print_r($users);
				//die;
				
                $data['code'] = 200;
                $data['message'] = 'success';
				$html = view('ajax.AjaxUserFilter')->with(['users'=>$users])->render();
                $data['html'] = $html;
            
        }catch(Exception $e){
            $data['message'] = 'Error'.$e->getMessage();
        }
        return response()->json($data);

	}
	
	
	

}

