<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class EventtagType extends Model
{
    public $timestamps = false;
    public $table = 'eventtagtype';
    protected $guarded = [];
    private static $getList = null;

    
    public static function GetEventtagTypes()
    {
        return $query = EventtagType::where('status', 1)->get();
    }
}
