<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class TestimonialPosition extends Model
{
    public $timestamps = false;
    public $table = 'testimonial_position';
    protected $guarded = [];
    private static $getList = null;

    

    public static function GetPositions()
    {
        return $query = (new TestimonialPosition)->where('status', 1)->get();
    }  

    public static function GetPosition($id)
    {
        return $query = (new TestimonialPosition)->where('id', $id)->first();
    }  

}
