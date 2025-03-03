<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public $timestamps = false;
    public $table = 'wishlist';
    protected $guarded = [];
    private static $getList = null;    
  
   public static function checkExist($uid,$id,$pg)
    {
        return $query = Wishlist::where('user_id', $uid)->where('post_id', $id)->where('tbl_data', $pg)->first();
    } 
   
}