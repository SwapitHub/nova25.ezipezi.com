<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class PortfolioType extends Model
{
    public $timestamps = false;
    public $table = 'portfoliotype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetPortfolioTypes()
    {
        return $query = (new PortfolioType)->where('status', 1)->orderBy('sort', 'ASC')->get();
    }  

    public function getCat($alias)
    {
         return  $query = (new PortfolioType)->where('status', 1)->where('alias', $alias)->first();
    }

    public static function getSingleCat($id)
    {
         return  $query = (new PortfolioType)->where('status', 1)->where('id', $id)->first();
    }
}
