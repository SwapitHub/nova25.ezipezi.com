<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    public $timestamps = false;
    public $table = 'propertytype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetPropertyTypes()
    {
        return $query = (new PropertyType)->where('status', 1)->get();
    }

    public static function getsingleCat($id)
    {
         return  $query = (new PropertyType)->where('id', $id)->first();
    }
}
