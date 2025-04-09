<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;
use DB;

class NewBlog extends Model
{
   public $timestamps = false;
   public $table = 'newblog';
   protected $guarded = [];
   private static $getList = null;

   public function category()
   {
      return $this->belongsTo(BlogType::class, 'blogtype');
   }

   public static function getProvincia()
   {
      return  $query = (new Provincia)->where('status', 1)->get();
   }

   public static function getSingleProvincia($id)
   {
      return  $query = (new Provincia)->where('id', $id)->first();
   }

   public function getAllBlog()
   {
      return $query = (new NewBlog)->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC')->paginate(6);
   }

   public function search($keyword = '', $protype = '')
   {

      $obj = new NewBlog;

      $obj = $obj->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC');
      if ($keyword) {
         $obj = $obj->whereRaw('(id = ' . (int) $keyword . ' OR name like "%' . $keyword . '%" )');
      }
      if ($protype) {
         $obj = $obj->where('blogtype', $protype);
      }


      return $dataTmp = $obj->paginate(6);
   }

   public function getBlog($alias, $status = '')
   {

      $obj = new NewBlog;
      if ($status != '') {
         $obj = $obj->where('status', 1);
      }

      $obj = $obj->where('alias', $alias)->first();
      return $obj;
   }

   public function getCatBlog($id)
   {
      return $query = (new NewBlog)->where('status', 1)->where('blogtype', $id)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC')->paginate(6);
   }


   public function footerNewBlog($order = '')
   {
      $obj = new NewBlog;
      $obj = $obj->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now());
      if ($order == 'featured') {
         $obj = $obj->inRandomOrder();
      } else {
         $obj = $obj->orderBy('startdate', 'DESC');
      }

      $obj = $obj->limit(4)->get();
      return $obj;
   }

   public static function getHeaderCats()
   {
      return $query =  DB::table('newblog')
         ->select(DB::raw('blogtype'))
         ->where('status', 1)
         ->where('expire', '>', now())
         ->where('startdate', '<', now())
         ->groupBy('blogtype')
         ->get();
   }

   public static function catCount($newstype)
   {
      return  $query = NewBlog::where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->where('blogtype', $newstype)->count();
   }

   public static function getFavItem($tbl, $id)
   {
      return $query =  DB::table($tbl)
         ->where('status', 1)
         ->where('id', $id)
         ->where('expire', '>', now())
         ->where('startdate', '<', now())
         ->first();
   }
}
