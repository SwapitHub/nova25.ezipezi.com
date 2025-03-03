<?php
#app/Models/ShopBrand.php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    public $timestamps = false;
    public $table = 'testimonial';
    protected $guarded = [];
    private static $getList = null;    
  
   public static function GetTestimonial()
    {
        return $query = Testimonial::where('status', 1)->get();
    } 
   
}
