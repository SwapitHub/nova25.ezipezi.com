<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventtagType;

class EventTag extends Model
{
    public $timestamps = false;
    public $table = 'eventtag';
    protected $guarded = [];
    private static $getList = null;



    public static function GetEventTagTypes()
    {
        return $query = EventtagType::where('status', 1)->get();
    }


    public static function getEventTagType($id)
    {
       return  $query = (new EventtagType)->where('id', $id)->first();
    }

     public static function getTags($id)
    {
       return  $query = (new EventTag)->where('protype', $id)->where('status', 1)->get();
    }
}
