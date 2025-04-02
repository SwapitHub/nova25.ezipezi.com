<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class VideotagType extends Model
{
    public $timestamps = false;
    public $table = 'videotagtype';
    protected $guarded = [];
    private static $getList = null;

    
    public static function GetVideotagTypes()
    {
        return $query = VideotagType::where('status', 1)->get();
    }
}
