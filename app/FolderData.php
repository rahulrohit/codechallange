<?php
namespace App;
use App\Folder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class FolderData extends Model
{
	protected $table ='folder';
	protected $guarded =[];
	

	public static function FetchUsers($id)
	{
		
		$data= DB::table('files')
	      ->where('parent_id','=',$id)
          ->get();
	return $data;
	
	}
	

	
	public static function FetchUsersData($id=null)
	{
		
	$data=DB::table('folder')
		->select('folder.id','folder.name')->orderBy('folder.id', 'asc')
		->get();
	return $data;
	
	}
	
		
	
   public static function DeleteUsers($id)
	{
		$delete = DB::table('folder')->where('id','=',$id)->delete();
		return $delete;
	}
	
	 public static function DeleteUsersDetails($id)
	{
		$delete = DB::table('files')->where('parent_id', $id)->delete();
		return $delete;
	}
}