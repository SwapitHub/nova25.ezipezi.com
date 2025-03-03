<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;
use App\Models\AccommodationtagType;

class AccommodationTag extends Model
{
    public $timestamps = false;
    public $table = 'accommodationtag';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetAccommodationTagTypes()
    {
        return $query = AccommodationtagType::where('status', 1)->get();
    }

     public static function getAccommodationTagType($id)
    {
       return  $query = (new AccommodationtagType)->where('id', $id)->first();
    }

     public static function getTags($id)
    {
       return  $query = AccommodationTag::where('status', 1)->where('acctype', $id)->get();
    }
}
