<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;

class EventImages extends Model
{
    public $timestamps = false;
    public $table = 'event_images';
    protected $guarded = [];
    private static $getList = null;
    
    public static function getImages($id)
    {
       return  $query = (new EventImages)->where('event_id', $id)->get();
    }

     

}
