<?php
#app/Models/ShopCategoryDescription.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderDescription extends Model
{
    protected $primaryKey = ['category_id', 'lang'];
    public $incrementing  = false;
    public $timestamps    = false;
    public $table         = 'slider_description';
    protected $guarded    = [];
}
