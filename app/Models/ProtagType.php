<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class ProtagType extends Model
{
    public $timestamps = false;
    public $table = 'protagtype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetProtagTypes()
    {
        return $query = ProtagType::where('status', 1)->get();
    }
}
