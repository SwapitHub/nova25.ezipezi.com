<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogtagType;

class BlogTag extends Model
{
    public $timestamps = false;
    public $table = 'blogtag';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetBlogTagTypes()
    {
        return $query = BlogtagType::where('status', 1)->get();
    }

     public static function getBlogTagType($id)
    {
       return  $query = (new BlogtagType)->where('id', $id)->first();
    }

     public static function getTags($id)
    {
       return  $query = (new BlogTag)->where('protype', $id)->where('status', 1)->get();
    }
}
