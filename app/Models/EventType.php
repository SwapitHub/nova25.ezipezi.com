<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    public $timestamps = false;
    public $table = 'eventtype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetEventTypes()
    {
        return $query = (new EventType)->where('status', 1)->orderBy('sort', 'ASC')->get();
    }  

    public function getCat($alias)
    {
         return  $query = (new EventType)->where('status', 1)->where('alias', $alias)->first();
    }

    public static function getSingleCat($id)
    {
         return  $query = (new EventType)->where('status', 1)->where('id', $id)->first();
    }
}
