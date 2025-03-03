<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    public $timestamps = false;
    public $table = 'states';
    protected $guarded = [];
    private static $getList = null;
    
    public static function getStates()
    {
       return  $query = (new States)->where('status', 1)->get();
    }

     public static function getStatesId($id)
    {
       return  $query = (new States)->where('country_code', $id)->where('status', 1)->get();
    }

}
