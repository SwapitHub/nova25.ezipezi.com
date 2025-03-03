<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class ServicetagType extends Model
{
    public $timestamps = false;
    public $table = 'servicetagtype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetServicetagTypes()
    {
        return $query = ServicetagType::where('status', 1)->get();
    }
}
