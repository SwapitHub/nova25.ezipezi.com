<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class BlogtagType extends Model
{
    public $timestamps = false;
    public $table = 'blogtagtype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetBlogtagTypes()
    {
        return $query = BlogtagType::where('status', 1)->get();
    }
}
