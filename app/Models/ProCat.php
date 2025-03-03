<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProType;

class ProCat extends Model
{
    public $timestamps = false;
    public $table = 'procat';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetProTypes()
    {
        return $query = ProType::where('status', 1)->get();
    }

     public static function getProType($id)
    {
       return  $query = (new ProType)->where('id', $id)->first();
    }

     public static function getProcats($id)
    {
       return  $query = (new ProCat)->where('protype', $id)->get();
    }

    public static function getProcat($id)
    {
       return  $query = (new ProCat)->where('id', $id)->first();
    }
}
