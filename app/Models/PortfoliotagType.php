<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class PortfoliotagType extends Model
{
    public $timestamps = false;
    public $table = 'portfoliotagtype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetPortfoliotagTypes()
    {
        return $query = PortfoliotagType::where('status', 1)->get();
    }
}
