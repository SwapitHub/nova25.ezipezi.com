<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;
use DB;

class Portfolio extends Model
{
    public $timestamps = false;
    public $table = 'portfolio';
    protected $guarded = [];
    private static $getList = null;

    public function category()
    {
       return $this->belongsTo(PortfolioType::class, 'portfoliotype');
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

        public function getAllPortfolio()
    {
         return $query = (new Portfolio)->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC')->paginate(6);
    }

    public function search($keyword='',$protype='')
    {
        
        $obj = new Portfolio;

        $obj = $obj->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC');    
        if ($keyword) {
            $obj = $obj->whereRaw('(id = ' . (int) $keyword . ' OR name like "%' . $keyword . '%" )');
        }
         if ($protype) {
            $obj = $obj->where('portfoliotype', $protype);
        }
         
       
        return $dataTmp = $obj->paginate(6);

        
    }

    public function getPortfolio($alias,$status='')
    {
        
         $obj = new Portfolio;
      if($status!='')
      {
         $obj = $obj->where('status', 1);
      }
     
       $obj = $obj->where('alias', $alias)->first();
        return $obj;
    }

      public function getCatPortfolio($id)  
    {
         return $query = (new Portfolio)->where('status', 1)->where('portfoliotype', $id)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC')->paginate(6);
    }
    

    public function footerPortfolio($order='')
    {
      $obj = new Portfolio;
      $obj = $obj->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now());
       if($order=='featured')
      {
         $obj = $obj->inRandomOrder();
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
       return $query =  DB::table('portfolio')
             ->select(DB::raw('portfoliotype'))
             ->where('status', 1)
             ->where('expire', '>', now())
             ->where('startdate', '<', now())
             ->groupBy('portfoliotype')
             ->get();
         
    }

     public static function catCount($newstype)
    {
         return  $query = Portfolio::where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->where('portfoliotype', $newstype)->count();
         
    }

     public static function getFavItem($tbl,$id)
    {
       return $query =  DB::table($tbl)
             ->where('status', 1)
             ->where('id', $id)
             ->where('expire', '>', now())
             ->where('startdate', '<', now())
             ->first();
         
    }


}
