<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;

class ServiceImages extends Model
{
    public $timestamps = false;
    public $table = 'service_images';
    protected $guarded = [];
    private static $getList = null;
    
    public static function getImages($id)
    {
       return  $query = (new ServiceImages)->where('service_id', $id)->get();
    }

     

}
