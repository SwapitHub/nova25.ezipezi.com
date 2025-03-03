<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class BlogTab extends Model
{
    public $timestamps = false;
    public $table = 'blogtab';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetBlogTabs($id)
    {
        return $query = (new BlogTab)->where('status', 1)->where('id', $id)->orderBy('sort', 'ASC')->first();
    }  

}
