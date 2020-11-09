<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use DB;
use Image;
use App\Http\Requests;
use App\FolderData;
use App\Folder;
use App\FilesData;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class FolderController extends Controller
{

    public function index()
    {

        $data['users'] = FolderData::FetchUsersData();
        return view('folder', compact('data'));

    }
	
	  public function folder()
    {

        return view('addfolder');

    }
	public function folderpage($id){
       $data['users'] = FolderData::FetchUsers($id);
      return view('folderdetails', compact('data'));
   }
	
	
	
		public function store(Request $request){
	
		try
		{
				
				$folder = $request->input('folder');
			

	          $Data = array("name"=>$folder);
			  	
			  $roleadd = Folder::create($Data);

			

			return redirect('folder-list')->with('success', 'Folder added successfully');
        }
		catch(\Exception $e){
			echo $e->getMessage();
			die;
            return redirect()->back()->with('error', 'Error occurs! Please try again!'.$e->getMessage());
            
        }
		
	  }

      
    public function destroy($id)
    {

        $deleteusers = FolderData::DeleteUsers($id);
        $delete = FolderData::DeleteUsersDetails($id);
       return redirect('folder-list')->with('success', 'Folder Delete successfully');
    }
	
	
	
	public function filedestroy($id)
    {

        $deleteusers = FilesData::Deletefiles($id);
        //$delete = FolderData::DeleteUsersDetails($id);
       return redirect('folder-list')->with('success', 'Files Delete successfully');
    }
	
	

}

