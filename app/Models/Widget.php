<?php

#app/Models/ShopCategory.php

namespace App\Models;



use App\Models\WidgetDescription;

use App\Models\ShopProduct;

use App\Models\ShopPage;

use Cache;

use DB;

use Illuminate\Database\Eloquent\Model;



class Widget extends Model

{

    public $timestamps = false;

    public $table = 'widget';

    protected $guarded = [];

    public $appends = [

        'name',

        'keyword',

        'description',

    ];



    public function products()

    {

        return $this->belongsToMany(ShopProduct::class, 'shop_product_category', 'category_id', 'product_id');

    }



    public function descriptions()

    {

        return $this->hasMany(WidgetDescription::class, 'category_id', 'id');

    }



/**

 * Get category parent

 */

    public function getParent()

    {

        return $this->find($this->parent);



    }



    protected static function boot()

    {

        parent::boot();

        // before delete() method call this

        static::deleting(function ($category) {

            //Delete category descrition

            $category->descriptions()->delete();

        });

    }



/**

 * [getCategories description]

 * @param  [type] $parent    [description]

 * @param  [type] $limit     [description]

 * @param  [type] $opt       [description]

 * @param  [type] $sortBy    [description]

 * @param  string $sortOrder [description]

 * @return [type]            [description]

 */

    public function getCategories($parent, $limit = null, $opt = null, $sortBy = null, $sortOrder = 'asc')

    {

        $query = $this->where('status', 1)->where('parent', $parent);

        $query = $query->sort($sortBy, $sortOrder);

        if (!(int) $limit) {

            return $query->get();

        } else

        if ($opt == 'paginate') {

            return $query->paginate((int) $limit);

        } else

        if ($opt == 'random') {

            return $query->inRandomOrder()->limit($limit)->get();

        } else {

            return $query->limit($limit)->get();

        }



    }



/**

 * Get all ID category children of parent

 * @param  integer $parent     [description]

 * @param  [type]  &$arrayID      [description]

 * @param  [object]  $categories [description]

 * @return [array]              [description]

 */

    public function getIdCategories($parent = 0, &$arrayID = null, $categories = null)

    {

        $categories = $categories ?? $this->getCategoriesAll();

        $arrayID = $arrayID ?? [];

        $lisCategory = $categories[$parent] ?? [];

        if (count($lisCategory)) {

            foreach ($lisCategory as $category) {

                $arrayID[] = $category->id;

                if (!empty($categories[$category->id])) {

                    $this->getIdCategories($category->id, $arrayID, $categories);

                }

            }

        }

        return $arrayID;

    }



    public function getTreeCategories($parent = 0, &$tree = null, $categories = null, &$st = '')

    {

        $categories = $categories ?? $this->getCategoriesAll();

        $tree = $tree ?? [];

        $lisCategory = $categories[$parent] ?? [];

        foreach ($lisCategory as $category) {

            $tree[$category->id] = $st . $category->name;

            if (!empty($categories[$category->id])) {

                $st .= '--';

                $this->getTreeCategories($category->id, $tree, $categories, $st);

                $st = '';

            }

        }



        return $tree;

    }



/**

 * [getCategoriesTop description]

 * @return [type] [description]

 */

    public function getCategoriesTop()

    {

        return $this->where('status', 1)->where('top', 1)->get();

    }



/*

Get thumb

 */

    public function getThumb()

    {

        return sc_image_get_path_thumb($this->image);

    }



/*

Get image

 */

    public function getImage()

    {

        return sc_image_get_path($this->image);



    }



    public function getUrl()

    {

        return route('category', ['alias' => $this->alias]);

    }



//Fields language

    public function getName()

    {

        return $this->processDescriptions()['name'] ?? '';

    }

    public function getKeyword()

    {

        return $this->processDescriptions()['keyword'] ?? '';

    }

    public function getDescription()

    {

        return $this->processDescriptions()['description'] ?? '';

    }



//Attributes

    public function getNameAttribute()

    {

        return $this->getName();

    }

    public function getKeywordAttribute()

    {

        return $this->getKeyword();



    }

    public function getDescriptionAttribute()

    {

        return $this->getDescription();



    }



//Scort

    public function scopeSort($query, $sortBy = null, $sortOrder = 'desc')

    {

        $sortBy = $sortBy ?? 'sort';

        return $query->orderBy($sortBy, $sortOrder);

    }



    public function processDescriptions()

    {

        return $this->descriptions->keyBy('lang')[sc_get_locale()] ?? [];

    }



    public function getCategoriesAll($onlyActive = false, $sortBy = null, $sortOrder = 'asc')

    {

        if (sc_config('cache_status')) {

            if (!Cache::has('all_cate_' . $onlyActive . $sortBy . $sortOrder)) {



                if ($onlyActive) {

                    $listFullCategory = $this->getCategoriesActive($sortBy = null, $sortOrder = 'asc');

                } else {

                    $listFullCategory = $this->getCategoriesFull($sortBy = null, $sortOrder = 'asc');

                }

                Cache::put('all_cate_' . $onlyActive . $sortBy . $sortOrder, $listFullCategory, $seconds = sc_config('cache_time', 600));

            }

            return Cache::get('all_cate_' . $onlyActive . $sortBy . $sortOrder);

        } else {

            if ($onlyActive) {

                $listFullCategory = $this->getCategoriesActive($sortBy = null, $sortOrder = 'asc');

            } else {

                $listFullCategory = $this->getCategoriesFull($sortBy = null, $sortOrder = 'asc');

            }

            return $listFullCategory;

        }



    }



    public function getCategoriesActive($sortBy = null, $sortOrder = 'asc')

    {

        $lang = sc_get_locale();

        $listFullCategory = $this->where('status', 1)

            ->sort($sortBy, $sortOrder)

            ->get()

            ->groupBy('parent');

        return $listFullCategory;

    }



    public function getCategoriesFull($sortBy = null, $sortOrder = 'asc')

    {

        $lang = sc_get_locale();

        $listFullCategory = $this->sort($sortBy, $sortOrder)

            ->get()

            ->groupBy('parent');

        return $listFullCategory;

    }



/**

 * [getCategory description]

 *

 * @param   [int]  $id     [$id description]

 * @param   [string]  $alias  [$alias description]

 *

 * @return  [type]          [return description]

 */

    public function getCategory($id = null, $alias = null) {

        $category = null;

        if($id) {

            $category = $this->where('id', (int)$id);

        } else {

            $category = $this->where('alias', $alias);

        }

        return $category

            ->where('status', 1)

            ->first();

    } 



    public static  function getSinglewidget($alias)

    {

       

            return $query = Widget::leftJoin('widget_description', 'widget_description.category_id', 'widget.id')

            ->where('widget_description.lang', sc_get_locale())->where('alias',$alias)->where('status',1)->first();

    }



public static  function getncmsCat()

    {

       

            return $query = DB::table('cms_category')->leftJoin('cms_category_description', 'cms_category_description.category_id', 'cms_category.id')->where('cms_category_description.lang', sc_get_locale())->whereIn('cms_category.alias', ['about', 'info'])->where('status',1)->orderBy('sort', 'asc')->get();

    }

    public static  function getcmsCat()

    {

       

            return $query = DB::table('cms_category')->leftJoin('cms_category_description', 'cms_category_description.category_id', 'cms_category.id')->where('cms_category_description.lang', sc_get_locale())->where('status',1)->orderBy('sort', 'asc')->whereNotIn('cms_category.alias',  array('about', 'info'))->get();

    }



    public static function getsubCats($id)

    {

       return $query = DB::table('cms_content')

        ->where('category_id', $id)

        ->where('status',1)

        ->count();

    }



    public static  function getcmsContent($id)

    {

       

            return $query = DB::table('cms_content')->leftJoin('cms_content_description', 'cms_content_description.cms_content_id', 'cms_content.id')->where('cms_content_description.lang', sc_get_locale())->where('status',1)->orderBy('sort', 'ASC')->where('cms_content.category_id',$id)->get();

    }

  



}

