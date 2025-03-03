<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class ProType extends Model
{
    public $timestamps = false;
    public $table = 'protype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetProTypes()
    {
        return $query = ProType::where('status', 1)->orderBy('sort', 'ASC')->get();
    } 

    public function getCat($alias)
    {
         return  $query = (new ProType)->where('status', 1)->where('alias', $alias)->first();
    }

    public static function catByid($id)
    {
         return  $query = (new ProType)->where('status', 1)->where('id', $id)->first();
    }
}
