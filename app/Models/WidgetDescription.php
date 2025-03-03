<?php
#app/Models/ShopCategoryDescription.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WidgetDescription extends Model
{
    protected $primaryKey = ['category_id', 'lang'];
    public $incrementing  = false;
    public $timestamps    = false;
    public $table         = 'widget_description';
    protected $guarded    = [];
}
