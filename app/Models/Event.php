<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;
use DB;

class Event extends Model
{
    public $timestamps = false;
    public $table = 'events';
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

    public function getAllEvent()
    {
        return $query = (new Event)->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC')->paginate(6);
    }

    public function search($keyword = '', $protype = '')
    {

        $obj = new Event;

        $obj = $obj->where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC');
        if ($keyword) {
            $obj = $obj->whereRaw('(id = ' . (int) $keyword . ' OR name like "%' . $keyword . '%" )');
        }
        if ($protype) {
            $obj = $obj->where('eventtype', $protype);
        }


        return $dataTmp = $obj->paginate(6);
    }

    public function getEvent($alias, $status = '')
    {

        $obj = new Event;
        if ($status != '') {
            $obj = $obj->where('status', 1);
        }

        $obj = $obj->where('alias', $alias)->first();
        return $obj;
    }

    public function getCatEvent($id)
    {
        return $query = (new Event)->where('status', 1)->where('eventtype', $id)->where('expire', '>', now())->where('startdate', '<', now())->orderBy('startdate', 'DESC')->paginate(6);
    }


    public function footerEvent($order = '')
    {
        $obj = new Event;
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
        return $query =  DB::table('events')
            ->select(DB::raw('eventtype'))
            ->where('status', 1)
            ->where('expire', '>', now())
            ->where('startdate', '<', now())
            ->groupBy('eventtype')
            ->get();
    }

    public static function catCount($newstype)
    {
        return  $query = Event::where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->where('eventtype', $newstype)->count();
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
