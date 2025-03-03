<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class TestTitle extends Model
{
    public $timestamps = false;
    public $table = 'test_title';
    protected $guarded = [];
    private static $getList = null;

    
	public static function getTitle()
    {
        return $query = (new TestTitle)->where('status', 1)->first();
    }  
   
}
