<?php
namespace App\Models;

use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    public $timestamps = true;
    public $table = 'payment_methods';
    protected $guarded = [];
    private static $getList = null;

}
