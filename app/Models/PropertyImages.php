<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;

class PropertyImages extends Model
{
    public $timestamps = false;
    public $table = 'property_images';
    protected $guarded = [];
    private static $getList = null;
    
    public static function getImages($id)
    {
       return  $query = (new PropertyImages)->where('property_id', $id)->get();
    }

     

}
