<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;

class Sublocation extends Model
{
    public $timestamps = false;
    public $table = 'sublocation';
    protected $guarded = [];
    private static $getList = null;
    
    public static function getProvincia()
    {
       return  $query = (new Provincia)->where('status', 1)->get();
    }

     public static function getSingleProvincia($id)
    {
       return  $query = (new Provincia)->where('id', $id)->first();
    }

}
