<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class PropertytagType extends Model
{
    public $timestamps = false;
    public $table = 'propertytagtype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetPropertytagTypes()
    {
        return $query = PropertytagType::where('status', 1)->get();
    }
}
