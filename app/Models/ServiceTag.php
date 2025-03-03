<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;
use App\Models\ServicetagType;

class ServiceTag extends Model
{
    public $timestamps = false;
    public $table = 'servicetag';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetServiceTagTypes()
    {
        return $query = ServicetagType::where('status', 1)->get();
    }

     public static function getServiceTagType($id)
    {
       return  $query = (new ServicetagType)->where('id', $id)->first();
    }

     public static function getTags($id)
    {
       return  $query = (new ServiceTag)->where('protype', $id)->where('status', 1)->get();
    }
}
