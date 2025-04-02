<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;

class GallaryImages extends Model
{
    public $timestamps = false;
    public $table = 'gallary_images';
    protected $guarded = [];
    private static $getList = null;
    
    public static function getImages($id)
    {
       return  $query = (new GallaryImages)->where('gallary_id', $id)->get();
    }

     

}
