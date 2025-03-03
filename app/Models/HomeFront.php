<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class HomeFront extends Model
{
    public $timestamps = false;
    public $table = 'home_content';
    protected $guarded = [];
    private static $getList = null;

    
	public static function getData()
    {
        return $query = (new HomeFront)->where('status', 1)->where('id', 1)->first();
    }  
   
}
