<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;
use DB;

class Property extends Model
{
   public $timestamps = false;
   public $table = 'property';
   protected $guarded = [];
   private static $getList = null;


   public function category()
   {
      return $this->belongsTo(PropertyType::class, 'prpertytype');
   }
   public static function getProvincia()
   {
      return  $query = (new Provincia)->where('status', 1)->get();
   }
   public function location()
   {
      return $this->belongsTo(Sublocation::class, 'location');
   }
   public static function getSingleProvincia($id)
   {
      return  $query = (new Provincia)->where('id', $id)->first();
   }

   public static function getFeaturedNews()
   {
      return  $query = (new Property)->where('status', 1)->where('featured', 1)->limit(4)->get();
   }
   public static function getSANews()
   {
      return  $query = (new Property)->where('status', 1)->where('provincia', 2)->limit(2)->get();
   }

   public function getProperty()
   {

      $obj = new Property;

      $obj = $obj->where('status', 1);

      return $dataTmp = $obj->paginate(6);
   }

   public function getProAlias($alias, $status)
   {

      $obj = new Property;
      if ($status != '') {
         $obj = $obj->where('status', 1);
      }

      $obj = $obj->where('alias', $alias)->first();
      return $obj;
   }

   public function search($keyword = '', $protype = '')
   {

      $obj = new Property;

      $obj = $obj->where('status', 1);
      if ($keyword) {
         $obj = $obj->whereRaw('(id = ' . (int) $keyword . ' OR name like "%' . $keyword . '%" )');
      }
      if ($protype) {
         $obj = $obj->where('propertytype', $protype);
      }


      return $dataTmp = $obj->paginate(6);
   }

   public function footerProperty($order = '')
   {
      $obj = new Property;
      $obj = $obj->where('status', 1);
      if ($order == 'featured') {
         $obj = $obj->where('featured', 1)->inRandomOrder();
      } else {
         $obj = $obj->orderBy('id', 'DESC');
      }

      $obj = $obj->limit(4)->get();
      return $obj;
   }

   public static function getHeaderCats()
   {
      return $query =  DB::table('property')
         ->select(DB::raw('propertytype'))
         ->where('status', 1)
         ->groupBy('propertytype')
         ->get();
   }

   public static function catCount($newstype)
   {
      return  $query = Property::where('status', 1)->where('propertytype', $newstype)->count();
   }
}
