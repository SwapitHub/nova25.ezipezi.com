<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;
use DB;

class Blog extends Model
{
    public $timestamps = false;
    public $table = 'blog';
    protected $guarded = [];
    private static $getList = null;
    
    public static function getProvincia()
    {
       return  $query = (new Provincia)->where('status', 1)->get();
    }

     public static function getSingleProvincia($id)
    {
       return  $query = (new Provincia)->where('id', $id)->first();
    }

    public static function getFeaturedNews()
    {
       return  $query = (new Blog)->where('status', 1)->where('featured', 1)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC')->limit(4)->get();
    }
    public static function getSANews()  
    {  
        //$now=date("Y-m-d");
       return  $query = (new Blog)->where('status', 1)->where('provincia', 2)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC')->limit(2)->get();
    }

    public function getNews($alias,$status='')
    {
        
         $obj = new Blog;
      if($status!='')
      {
         $obj = $obj->where('status', 1);
      }
     
       $obj = $obj->where('alias', $alias)->first();
        return $obj;
    }

      public function getCatNews($id)  
    {
         return $query = (new Blog)->where('status', 1)->where('newstype', $id)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC')->paginate(6);
    }

      public function getAllNews()
    {
         return $query = (new Blog)->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC')->paginate(6);
    }

      public function search($keyword='',$protype='')
    {
        
        $obj = new Blog;

        $obj = $obj->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC');    
        if ($keyword) {
            $obj = $obj->whereRaw('(id = ' . (int) $keyword . ' OR name like "%' . $keyword . '%" )');
        }
         if ($protype) {
            $obj = $obj->where('newstype', $protype);
        }
         
       
        return $dataTmp = $obj->paginate(6);

        
    }

     public function footerNews($order='')
    {
      $obj = new Blog;
      $obj = $obj->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now());
       if($order=='featured')
      {
         $obj = $obj->where('featured', 1)->inRandomOrder();
      }
      else
      {
        $obj = $obj->orderBy('startdate', 'DESC');
      }
     
       $obj = $obj->limit(4)->get();
        return $obj;

    }

      public static function getHeaderCats()
    {
       return $query =  DB::table('blog')
             ->select(DB::raw('newstype'))
             ->where('status', 1)
             ->where('expire', '>', now())
             ->where('startdate', '<', now())
             ->groupBy('newstype')
             ->get();
         
    }

    public static function catCount($newstype)
    {
         return  $query = Blog::where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->where('newstype', $newstype)->count();
         
    }

}
