<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class AccommodationType extends Model
{
    public $timestamps = false;
    public $table = 'accommodationtype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetAccommodationTypes()
    {
        return $query = (new AccommodationType)->where('status', 1)->get();
    }

    public static function getsingleCat($id)
    {
         return  $query = (new AccommodationType)->where('id', $id)->first();
    }
}
