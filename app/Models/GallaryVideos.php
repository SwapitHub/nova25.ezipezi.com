<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;

class GallaryVideos extends Model
{
    public $timestamps = false;
    public $table = 'gallary_videos';
    protected $guarded = [];
    private static $getList = null;
    
    public static function getImages($id)
    {
       return  $query = (new GallaryVideos)->where('video_id', $id)->get();
    }

     

}
