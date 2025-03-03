<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class NewstagType extends Model
{
    public $timestamps = false;
    public $table = 'newstagtype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetNewstagTypes()
    {
        return $query = NewstagType::where('status', 1)->get();
    }
}
