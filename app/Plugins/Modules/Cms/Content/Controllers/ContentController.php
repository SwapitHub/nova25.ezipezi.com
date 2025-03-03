<?php
#App\Plugins\Modules\Cms\Content\Controllers\ContentController.php
namespace App\Plugins\Modules\Cms\Content\Controllers;

use App\Plugins\Modules\Cms\Content\Models\CmsCategory;
use App\Plugins\Modules\Cms\Content\Models\CmsContent;
use App\Http\Controllers\GeneralController;
use App\Plugins\Modules\Cms\Content\AppConfig;
use App\Admin\Admin;
use App\Models\Accommodation;
use App\Models\Blog;
use App\Models\Property;
use App\Models\Service;
use App\Models\ShopProduct;
use App\Models\Testimonial;
use App\Models\TestTitle;
use App\Models\Portfolio;
use App\Models\NewBlog;
use App\Admin\Models\AdminUser;


class ContentController extends GeneralController
{
    public $plugin;
    public function __construct()
    {
        parent::__construct();
        $this->plugin = new AppConfig;
    }

/**
 * [news description]
 * @return [type] [description]
 */
public function category($alias)
{
    $category_currently = CmsCategory::where('alias', $alias)->first();

    $entries = (new CmsCategory)
        ->getContentsToCategory($category_currently->id, $limit = sc_config('product_new'), $opt = 'paginate');
    return view(
        $this->plugin->pathPlugin.'::cms_category',
        array(
            'title' => $category_currently['title'],
            'description' => $category_currently['description'],
            'keyword' => $category_currently['keyword'],
            'entries' => $entries,
        )
    );
}

public function content($alias)
{
    

    
      $admin = Admin::user();
    $status='';
    if(empty($admin)) $status = 1;
    $obj = new CmsContent;
    if($status!='')
    {
        $obj = $obj->where('status',$status);
        
    }
    $entry_currently = $obj->where('alias', $alias)->first(); 
    
     
    if ($entry_currently) {
      
    if($entry_currently->faccommo){
        $footerAccommmo = (new Accommodation)->footerAccommo($entry_currently->accorder);
    }
     if($entry_currently->fnews){
        $footerNews = (new Blog)->footerNews($entry_currently->norder);
    }
     if($entry_currently->fprop){
        $footerProperty = (new Property)->footerProperty($entry_currently->porder);
    }
     if($entry_currently->fproduct){
        $footerProduct = (new ShopProduct)->footerProduct($entry_currently->proorder);
    }
     if($entry_currently->fservice){
        $footerService = (new Service)->footerService($entry_currently->sorder);
    }
    if($entry_currently->faport){
            $footerPort = (new Portfolio)->footerPortfolio($entry_currently->portorder);
        }
        if($entry_currently->fablog){
            $footerBlog = (new NewBlog)->footerNewBlog($entry_currently->blogorder);
        }

        $title = ($entry_currently) ? $entry_currently->title : trans('front.not_found');
        return view($this->plugin->pathPlugin.'::cms_entry_detail',
            array(
                'title' => $title,
                'entry_currently' => $entry_currently,
                'description' => $entry_currently['description'],
                'keyword' => $entry_currently['keyword'],
                'og_image' => $entry_currently->getImage(),
                'admin' => $admin,
                'footerAccommmo' => $footerAccommmo ?? [],
                'footerNews' => $footerNews ?? [],
                'footerService' => $footerService ?? [],
                'footerProduct' => $footerProduct ?? [],
                'footerProperty' => $footerProperty ?? [],
                'team' => (new AdminUser)->GetTeamMember(),
                'footerPort' => $footerPort ?? [],
                'footerBlog' => $footerBlog ?? [],
                

            )
        );
    } else {
        return view('templates.' . sc_store('template') . '.notfound',
            array(
                'title' => trans('front.not_found'),
                'description' => '',
                'keyword' => sc_store('keyword'),
                'msg' => trans('front.item_not_found'),
            )
        );
    }

}
}
