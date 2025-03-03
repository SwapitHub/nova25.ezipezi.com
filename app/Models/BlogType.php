<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class BlogType extends Model
{
    public $timestamps = false;
    public $table = 'blogtype';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetBlogTypes()
    {
        return $query = (new BlogType)->where('status', 1)->orderBy('sort', 'ASC')->get();
    }  

    public function getCat($alias)
    {
         return  $query = (new BlogType)->where('status', 1)->where('alias', $alias)->first();
    }

    public static function getSingleCat($id)
    {
         return  $query = (new BlogType)->where('status', 1)->where('id', $id)->first();
    }
}
