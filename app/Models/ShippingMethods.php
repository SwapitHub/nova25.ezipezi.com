<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class ShippingMethods extends Model
{
    public $timestamps = false;
    public $table = 'shipping_methods';
    protected $guarded = [];
    private static $getList = null;

}
