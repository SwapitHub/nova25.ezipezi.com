<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;
use App\Models\GallarytagType;

class GallaryTag extends Model
{
    public $timestamps = false;
    public $table = 'gallarytag';
    protected $guarded = [];
    private static $getList = null;



    public static function GetGallaryTagTypes()
    {
        return $query = GallarytagType::where('status', 1)->get();
    }


    public static function getGallaryTagType($id)
    {
       return  $query = (new GallarytagType)->where('id', $id)->first();
    }

     public static function getTags($id)
    {
       return  $query = (new GallaryTag)->where('protype', $id)->where('status', 1)->get();
    }
}
