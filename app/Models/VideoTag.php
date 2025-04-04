<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;
use App\Models\VideotagType;

class VideoTag extends Model
{
    public $timestamps = false;
    public $table = 'videotag';
    protected $guarded = [];
    private static $getList = null;



    public static function GetVideoTagTypes()
    {
        return $query = VideotagType::where('status', 1)->get();
    }


    public static function getVideoTagType($id)
    {
       return  $query = (new VideotagType)->where('id', $id)->first();
    }

     public static function getTags($id)
    {
       return  $query = (new VideoTag)->where('protype', $id)->where('status', 1)->get();
    }
}
