<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class EventTab extends Model
{
    public $timestamps = false;
    public $table = 'eventtab';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetEventTabs($id)
    {
        return $query = (new EventTab)->where('status', 1)->where('id', $id)->orderBy('sort', 'ASC')->first();
    }  

}
