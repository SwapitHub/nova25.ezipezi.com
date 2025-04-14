<?php

#app/Models/ShopCategory.php

namespace App\Models;



use App\Models\SliderDescription;

use App\Models\ShopProduct;

use App\Models\ShopPage;

use Cache;

use DB;

use Illuminate\Database\Eloquent\Model;


class TextSlider extends Model
{
    public $timestamps = false;
    public $table = 'text_slider';
    protected $guarded = [];
}
