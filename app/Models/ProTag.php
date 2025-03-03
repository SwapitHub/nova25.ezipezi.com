<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProtagType;

class ProTag extends Model
{
    public $timestamps = false;
    public $table = 'protag';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetProTagTypes()
    {
        return $query = ProtagType::where('status', 1)->get();
    }

     public static function getProTagType($id)
    {
       return  $query = (new ProtagType)->where('id', $id)->first();
    }

    public static function getTags($id)
    {
       return  $query = (new ProTag)->where('status', 1)->where('protype', $id)->get();
    }
}
