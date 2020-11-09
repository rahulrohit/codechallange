<?php
namespace App;
use App\Files;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class FilesData extends Model
{
	protected $table ='files';
	protected $guarded =[];
	

	public static function FetchUsers()
	{
		$data= DB::table('files')
	      ->join('folder', 'files.parent_id', '=', 'folder.id')
          ->get();
	return $data;
	
	}
	

	
	public static function FetchUsersData($id=null)
	{
		
	$data= DB::table('files')
	      ->join('folder', 'files.parent_id', '=', 'folder.id')
          ->get();
	return $data;
	
	}
	
		
	
   public static function Deletefiles($id)
	{
		$delete = FilesData::where('id','=',$id)->delete();
		return $delete;
	}
	
	
}