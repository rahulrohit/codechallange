<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use DB;
use Image;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Files;
use App\FilesData;
use Excel;
use App\FolderData;

class FilesController extends Controller
{

 public function index(Request $request)
    {
	    $data['users'] = FilesData::FetchUsers();
		
       
        return view('files', compact('data'));

	}

public function filesform(Request $request)
    {
	   
        $data['dropdown'] = DB::table('folder')->select('id', 'name')
            ->get();
       return view('addfiles', compact('data'));
	}
	
   public function store(Request $request){
	
		try
		{
		    $files = $request->input('files');
			$folder = $request->input('folder_id');
			$status = "1";

	          $Data = array("files"=>$files,"parent_id"=>$folder,"status"=>$status);
			  	
			  $roleadd = Files::create($Data);
			return redirect('files-list')->with('success', 'Files added successfully');
        }
		catch(\Exception $e){
			echo $e->getMessage();
			die;
            return redirect()->back()->with('error', 'Error occurs! Please try again!'.$e->getMessage());
            
        }
		
	  }
		
	
		
}