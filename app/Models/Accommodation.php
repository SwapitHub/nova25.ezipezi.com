<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;
use DB;

class Accommodation extends Model
{
    public $timestamps = false;
    public $table = 'accommodation';
    protected $guarded = [];
    private static $getList = null;

    public function category()
    {
       return $this->belongsTo(AccommodationType::class, 'accommodationtype');
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

    public static function getFeaturedNews()
    {
       return  $query = (new Accommodation)->where('status', 1)->where('featured', 1)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC')->limit(4)->get();
    }
    public static function getSANews()
    {
       return  $query = (new Accommodation)->where('status', 1)->where('provincia', 2)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC')->limit(2)->get();
    }

     public function getAccomo()
    {
        
        $obj = new Accommodation;

        $obj = $obj->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC');        
       
        return $dataTmp = $obj->paginate(6);

        
    }

      public function search($keyword='',$protype='')
    {
        
        $obj = new Accommodation;

        $obj = $obj->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC');    
        if ($keyword) {
            $obj = $obj->whereRaw('(id = ' . (int) $keyword . ' OR name like "%' . $keyword . '%" )');
        }
         if ($protype) {
            $obj = $obj->where('accommodationtype', $protype);
        }
         
       
        return $dataTmp = $obj->paginate(6);

        
    }

    public function getAcc($alias, $status='')
    {
      $obj = new Accommodation;
      if($status!='')
      {
         $obj = $obj->where('status', 1);
      }
     
       $obj = $obj->where('alias', $alias)->first();
        return $obj;

    }

    public function footerAccommo($order='')
    {
      $obj = new Accommodation;
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
       return $query =  DB::table('accommodation')
             ->select(DB::raw('accommodationtype'))
             ->where('status', 1)
             ->where('expire', '>', now())
             ->where('startdate', '<', now())
             ->groupBy('accommodationtype')
             ->get();
         
    }

    public static function catCount($newstype)
    {
         return  $query = Accommodation::where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->where('accommodationtype', $newstype)->count();
         
    }
}
