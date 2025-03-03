<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class PortfolioTab extends Model
{
    public $timestamps = false;
    public $table = 'portfoliotab';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetPortfolioTabs($id)
    {
        return $query = (new PortfolioTab)->where('status', 1)->where('id', $id)->orderBy('sort', 'ASC')->first();
    }  

}
