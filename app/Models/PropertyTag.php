<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;
use App\Models\PropertytagType;

class PropertyTag extends Model
{
    public $timestamps = false;
    public $table = 'propertytag';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetPropertyTagTypes()
    {
        return $query = PropertytagType::where('status', 1)->get();
    }

     public static function getPropertyTagType($id)
    {
       return  $query = (new PropertytagType)->where('id', $id)->first();
    }

    public static function getTags($id)
    {
       return  $query = PropertyTag::where('status', 1)->where('protype', $id)->get();
    }
}
