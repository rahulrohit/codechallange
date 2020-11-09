<?php
namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class UserData extends Model
{
	protected $table ='users';
	protected $guarded =[];
	

	public static function FetchUsers($id)
	{
		
		$data=UserData::where('id','=',$id)->get();
		return $data;
	
	}
	

	
	public static function FetchUsersData($id=null)
	{
		
	$data=DB::table('users')
		->select('users.id','users.name','users.password','users.email','users.mobile')->orderBy('users.id', 'asc')
		->get();
	return $data;
	
	}
	
		public static function FetchUsersDatarahul($id=null)
	{
		
	$data=DB::table('users')
		->select('users.id','users.name','users.password','users.email','users.mobile')->where('users.email',session('email'))->orderBy('users.id', 'asc')
		->get();
		//$data = User::whereIn('id',session('email'))->get();

	print_r($data); die;
	
	}

	
   public static function DeleteUsers($id)
	{
		$delete = UserData::where('id','=',$id)->delete();
		return $delete;
	}
	
	 public static function DeleteUsersDetails($id)
	{
		$delete = DB::table('user_details')->where('user_id', $id)->delete();
		return $delete;
	}
}