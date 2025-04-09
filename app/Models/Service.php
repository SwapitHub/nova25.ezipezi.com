<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;
use DB;

class Service extends Model
{
   public $timestamps = false;
   public $table = 'service';
   protected $guarded = [];
   private static $getList = null;

   public function category()
   {
      return $this->belongsTo(ServiceType::class, 'servicetype');
   }

   public function blogLocation()
   {
      return $this->belongsTo(Sublocation::class, 'location');
   }

   public static function getProvincia()
   {
      return  $query = (new Provincia)->where('status', 1)->get();
   }

   public static function getSingleProvincia($id)
   {
      return  $query = (new Provincia)->where('id', $id)->first();
   }

   public function getAllServices()
   {
      return $query = (new Service)->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC')->paginate(6);
   }

   public function search($keyword = '', $protype = '')
   {

      $obj = new Service;

      $obj = $obj->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC');
      if ($keyword) {
         $obj = $obj->whereRaw('(id = ' . (int) $keyword . ' OR name like "%' . $keyword . '%" )');
      }
      if ($protype) {
         $obj = $obj->where('servicetype', $protype);
      }


      return $dataTmp = $obj->paginate(6);
   }

   public function getServices($alias, $status = '')
   {

      $obj = new Service;
      if ($status != '') {
         $obj = $obj->where('status', 1);
      }

      $obj = $obj->where('alias', $alias)->first();
      return $obj;
   }

   public function getCatServices($id)
   {
      return $query = (new Service)->where('status', 1)->where('servicetype', $id)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC')->paginate(6);
   }


   public function footerService($order = '')
   {
      $obj = new Service;
      $obj = $obj->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now());
      if ($order == 'featured') {
         $obj = $obj->where('featured', 1)->inRandomOrder();
      } else {
         $obj = $obj->orderBy('startdate', 'DESC');
      }

      $obj = $obj->limit(4)->get();
      return $obj;
   }

   public static function getHeaderCats()
   {
      return $query =  DB::table('service')
         ->select(DB::raw('servicetype'))
         ->where('status', 1)
         ->where('expire', '>', now())
         ->where('startdate', '<', now())
         ->groupBy('servicetype')
         ->get();
   }

   public static function catCount($newstype)
   {
      return  $query = Service::where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->where('servicetype', $newstype)->count();
   }
}
