<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class AccommodationtagType extends Model
{
    public $timestamps = false;
    public $table = 'accommodationtagtype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetAccommodationtagTypes()
    {
        return $query = AccommodationtagType::where('status', 1)->get();
    }
}
