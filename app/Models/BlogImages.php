<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;

class BlogImages extends Model
{
    public $timestamps = false;
    public $table = 'blog_images';
    protected $guarded = [];
    private static $getList = null;
    
    public static function getImages($id)
    {
       return  $query = (new BlogImages)->where('blog_id', $id)->get();
    }

     

}
