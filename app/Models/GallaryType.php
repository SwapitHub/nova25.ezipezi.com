<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class GallaryType extends Model
{
    public $timestamps = false;
    public $table = 'gallarytype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetGallaryTypes()
    {
        return $query = (new GallaryType)->where('status', 1)->orderBy('sort', 'ASC')->get();
    }  

    public function getCat($alias)
    {
         return  $query = (new GallaryType)->where('status', 1)->where('alias', $alias)->first();
    }

    public static function getSingleCat($id)
    {
         return  $query = (new GallaryType)->where('status', 1)->where('id', $id)->first();
    }
}
