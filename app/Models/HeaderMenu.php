<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class HeaderMenu extends Model
{
    public $timestamps = false;
    public $table = 'headermenu';
    protected $guarded = [];
    private static $getList = null;
   
        
    public static function getMenu($id)
    {
         return  $query = (new HeaderMenu)->where('id', $id)->first();
    }
}
