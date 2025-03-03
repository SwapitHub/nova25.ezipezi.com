<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;

class AccommodationImages extends Model
{
    public $timestamps = false;
    public $table = 'accommodation_images';
    protected $guarded = [];
    private static $getList = null;
    
    public static function getImages($id)
    {
       return  $query = (new AccommodationImages)->where('accommodation_id', $id)->get();
    }

     

}
