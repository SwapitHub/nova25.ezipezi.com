<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;
use App\Models\PortfoliotagType;

class PortfolioTag extends Model
{
    public $timestamps = false;
    public $table = 'portfoliotag';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetPortfolioTagTypes()
    {
        return $query = PortfoliotagType::where('status', 1)->get();
    }

     public static function getPortfolioTagType($id)
    {
       return  $query = (new PortfoliotagType)->where('id', $id)->first();
    }

     public static function getTags($id)
    {
       return  $query = (new PortfolioTag)->where('protype', $id)->where('status', 1)->get();
    }
}
