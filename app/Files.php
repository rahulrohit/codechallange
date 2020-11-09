<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class Files extends Model
{

    protected $table = 'files';
    protected $guarded = [];

   
   /* public function getDept()
    {
        return $this->belongsTo('App\Department','dept_id');

    }*/

}

