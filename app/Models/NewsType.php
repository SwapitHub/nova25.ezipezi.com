<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class NewsType extends Model
{
    public $timestamps = false;
    public $table = 'newstype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetNewsTypes()
    {
        return $query = (new NewsType)->where('status', 1)->orderBy('sort', 'ASC')->get();
    }  

    public function getCat($alias)
    {
         return  $query = (new NewsType)->where('status', 1)->where('alias', $alias)->first();
    }

    public static function getsingleCat($id)
    {
         return  $query = (new NewsType)->where('id', $id)->first();
    }
}
