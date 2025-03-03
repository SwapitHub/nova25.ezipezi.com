<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;
use App\Models\NewstagType;

class NewsTag extends Model
{
    public $timestamps = false;
    public $table = 'newstag';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetNewsTagTypes()
    {
        return $query = NewstagType::where('status', 1)->get();
    }

     public static function getNewsTagType($id)
    {
       return  $query = (new NewstagType)->where('id', $id)->first();
    }

     public static function getTags($id)
    {
       return  $query = (new NewsTag)->where('protype', $id)->where('status', 1)->get();
    }
}
