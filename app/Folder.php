<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class Folder extends Model
{

    protected $table = 'folder';
    protected $guarded = [];

   

   /* public function getDept()
    {
        return $this->belongsTo('App\Department','dept_id');

    }*/

}

