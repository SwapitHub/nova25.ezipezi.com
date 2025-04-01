<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class GallarytagType extends Model
{
    public $timestamps = false;
    public $table = 'gallarytagtype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetGallarytagTypes()
    {
        return $query = GallarytagType::where('status', 1)->get();
    }
}
