<?php
namespace App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
class RolesMaster extends Model
{
	protected $table ='user_role';
	
	public static function FetchRoles($id)
	{
		$data=RolesMaster::where('id','=',$id)->get();
		return $data;
	
	}
	
	public static function FetchRolesData($id=null)
	{
		
	$data=DB::table('user_role')->orderBy('id', 'asc')->get(); 
	return $data;
	
	}
	
	
	
	
   public static function DeleteRoles($id)
	{
		$delete = RolesMaster::where('id','=',$id)->delete();
		return $delete;
	}
	
}