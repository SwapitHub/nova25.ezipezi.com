<?php
#app/Http/Controller/ContentFront.php
namespace App\Http\Controllers;

use App\Models\ShopEmailTemplate;
use App\Models\ShopNews;
use App\Models\ShopPage;
use App\Models\Accommodation;
use App\Models\AccommodationImages;
use App\Models\AccommodationtagType;
use App\Models\AccommodationType;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PropertyImages;
use App\Models\PropertytagType;
use App\Models\ProCat;
use App\Models\Blog;
use App\Models\BlogImages;
use App\Models\NewstagType;
use App\Models\NewsType;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\ServiceImages;
use App\Models\ServicetagType;
use App\Models\ProType;
use App\Models\States;
use App\Models\ShopProduct;
use App\Models\ShopSubscribe;
use App\Models\TestTitle;
use App\Models\Testimonial;
use App\Models\Portfolio;
use App\Models\PortfolioType;
use App\Models\PortfolioImages;
use App\Models\PortfoliotagType;
use App\Models\PortfolioTab;
use App\Admin\Models\AdminUser;
use Illuminate\Http\Request;
use App\Admin\Admin;
use Auth;
use App\Models\Wishlist;
use App\Models\BlogType;
use App\Models\NewBlog;
use App\Models\BlogtagType;
use App\Models\NewBlogImages;

class ContentFront extends GeneralController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * [getContact description]
     * @return [type] [description]
     */
    public function getContact()
    {
        $page = $this->getPage('contact');
        return view(
            $this->templatePath . '.shop_contact',
            array(
                'title' => trans('front.contact'),
                'description' => '',
                'page' => $page,
                'keyword' => '',
                'og_image' => '',
            )
        );
    }

    /**
     * [postContact description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */


    public function postContact(Request $request)
    {

        $validator = $request->validate([
            'name' => 'required',
            'title' => 'required',
            'content' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ], [
            'name.required' => trans('validation.required'),
            'content.required' => trans('validation.required'),
            'title.required' => trans('validation.required'),
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.email'),
            'phone.required' => trans('validation.required'),
            'phone.regex' => trans('validation.phone'),
        ]);
        //Send email
        $data = $request->all();

        if (isset($data['g-recaptcha-response']) && !empty($data['g-recaptcha-response'])) {

            // Google secret API
            $secretAPIkey = sc_store('reCaptcha_secret_key');

            // reCAPTCHA response verification              

            $coregister = curl_init();
            $insertCoregister = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secretAPIkey . '&response=' . $data['g-recaptcha-response'];
            curl_setopt($coregister, CURLOPT_URL, $insertCoregister);
            // Set the result output to be a string.
            curl_setopt($coregister, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($coregister, CURLOPT_TIMEOUT, 0);

            $output_coregister = curl_exec($coregister);
            curl_close($coregister);
            $response = json_decode($output_coregister);


            if ($response->success) {
                $data['content'] = str_replace("\n", "<br>", $data['content']);

                if (sc_config('contact_to_admin')) {
                    $checkContent = (new ShopEmailTemplate)
                        ->where('group', 'contact_to_admin')
                        ->where('status', 1)
                        ->first();
                    if ($checkContent) {
                        $content = $checkContent->text;
                        $dataFind = [
                            '/\{\{\$title\}\}/',
                            '/\{\{\$name\}\}/',
                            '/\{\{\$email\}\}/',
                            '/\{\{\$phone\}\}/',
                            '/\{\{\$content\}\}/',
                        ];
                        $dataReplace = [
                            $data['title'],
                            $data['name'],
                            $data['email'],
                            $data['phone'],
                            $data['content'],
                        ];
                        $content = preg_replace($dataFind, $dataReplace, $content);
                        $data_email = [
                            'content' => $content,
                        ];

                        $config = [
                            'to' => 'swap.taranjit@gmail.com',
                            'replyTo' => $data['email'],
                            'subject' => $data['title'],
                        ];
                        /*sc_send_mail('mail.contact_to_admin', $data_email, $config, []);*/

                        $to      = sc_store('admin_email');
                        $subject = $data['title'];
                        $message = $content;
                        $headers = 'From: ' . sc_store('email') . "\r\n" .
                            "Reply-To:" . $data['email'] . "\r\n" .
                            'X-Mailer: PHP/' . phpversion() . "\r\n" .
                            'Content-type: text/html';

                        mail($to, $subject, $message, $headers);

                        mail($data['email'], $subject, $message, $headers);
                    }
                }

                return redirect()->back()->with('success', trans('front.thank_contact'));
            }
        } else {
            return redirect()
                ->route('contact')
                ->with('warning', 'reCaptcha not verified');
        }
    }

    /**
     * Render page
     * @param  [string] $alias
     */
    public function pages($alias = null)
    {
        $page = $this->getPage($alias);
        if ($page) {
            return view(
                $this->templatePath . '.shop_page',
                array(
                    'title' => $page->title,
                    'description' => '',
                    'keyword' => '',
                    'page' => $page,
                )
            );
        } else {
            return $this->pageNotFound();
        }
    }

    /**
     * Get page info
     * @param  [string] $alias [description]
     * @return [type]      [description]
     */
    public function getPage($alias = null)
    {
        return ShopPage::where('alias', $alias)
            ->where('status', 1)
            ->first();
    }

    /**
     * Render news
     * @return [type] [description]
     */
    public function news()
    {
        return view($this->templatePath . '.news-summary');
        /*$newstype = NewsType::GetNewsTypes();
       $news = (new Blog)->getAllNews();  
          
        return view(
            $this->templatePath . '.news_list',
            array(
                'title' => 'News',
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'news' => $news,
                'newstype' => $newstype,
            )
        );*/
    }

    public function newsSearch(Request $request)
    {
        $keyword = request('name') ?? '';
        $type = request('newstype') ?? '';

        $newstype = NewsType::GetNewsTypes();
        $news = (new Blog)->search($keyword, $type);

        return view(
            $this->templatePath . '.news_list',
            array(
                'title' => 'News',
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'news' => $news,
                'newstype' => $newstype,
            )
        );
    }

    public function serviceSearch(Request $request)
    {
        $keyword = request('name') ?? '';
        $type = request('servicetype') ?? '';

        $servicetype = ServiceType::GetServiceTypes();
        $services = (new Service)->search($keyword, $type);

        return view(
            $this->templatePath . '.service_list',
            array(
                'title' => 'Services',
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'services' => $services,
                'servicetype' => $servicetype,
            )
        );
    }

    /**
     * News detail
     *
     * @param   [string]  $alias 
     * @param   [type]  $id
     *
     * @return  view
     */
    public function newsDetail($alias)
    {
        $news_currently = ShopNews::where('alias', $alias)->first();

        if ($news_currently) {
            $title = ($news_currently) ? $news_currently->title : trans('front.not_found');
            return view(
                $this->templatePath . '.shop_news_detail',
                array(
                    'title' => $title,
                    'news_currently' => $news_currently,
                    'description' => sc_store('description'),
                    'keyword' => sc_store('keyword'),
                    'blogs' => (new ShopNews)->getItemsNews($limit = 4),
                    'og_image' => $news_currently->getImage(),
                )
            );
        } else {
            return view(
                $this->templatePath . '.notfound',
                array(
                    'title' => trans('front.not_found'),
                    'description' => '',
                    'keyword' => sc_store('keyword'),
                    'msg' => trans('front.item_not_found'),
                )
            );
        }
    }

    public function allservices()
    {
        return view($this->templatePath . '.service-summary');
        /* $servicetype = ServiceType::GetServiceTypes();
       $services = (new Service)->getAllServices();  
          
        return view(
            $this->templatePath . '.service_list',
            array(
                'title' => 'Services',
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'services' => $services,
                'servicetype' => $servicetype,
            )
        );*/
    }

    /**
     * email subscribe
     * @param  Request $request
     * @return json
     */
    public function emailSubscribe(Request $request)
    {
        $validator = $request->validate([
            'subscribe_email' => 'required|email',
        ], [
            'email.required' => trans('validation.required'),
            'email.email'    => trans('validation.email'),
        ]);
        $data       = $request->all();
        $checkEmail = ShopSubscribe::where('email', $data['subscribe_email'])
            ->first();
        if (!$checkEmail) {
            ShopSubscribe::insert(['email' => $data['subscribe_email']]);
        }
        return redirect()->back()
            ->with(['success' => trans('subscribe.subscribe_success')]);
    }

    public function allAccommo()
    {
        return view($this->templatePath . '.accommo-summary');
        /* $accommodation = (new Accommodation)->getAccomo();
         $acctype = AccommodationType::GetAccommodationTypes();

        return view(
            $this->templatePath . '.accommo_list',
            array(
                'title' => 'Accommodation',
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'accommodation' => $accommodation,
                'acctype' => $acctype,
            )
        );*/
    }

    public function accommoDetail($alias)
    {
        $admin = Admin::user();
        $status = '';
        if (empty($admin)) $status = 1;
        $accommodation = (new Accommodation)->getAcc($alias, $status);

        $accimgs = (new AccommodationImages)->getImages($accommodation->id);
        $tagtype = (new AccommodationtagType)->GetAccommodationtagTypes();

        if ($accommodation->faccommo) {
            $footerAccommmo = (new Accommodation)->footerAccommo($accommodation->accorder);
        }
        if ($accommodation->fnews) {
            $footerNews = (new Blog)->footerNews($accommodation->norder);
        }
        if ($accommodation->fprop) {
            $footerProperty = (new Property)->footerProperty($accommodation->porder);
        }
        if ($accommodation->fproduct) {
            $footerProduct = (new ShopProduct)->footerProduct($accommodation->proorder);
        }
        if ($accommodation->fservice) {
            $footerService = (new Service)->footerService($accommodation->sorder);
        }
        if ($accommodation->faport) {
            $footerPort = (new Portfolio)->footerPortfolio($accommodation->portorder);
        }
        if ($accommodation->fablog) {
            $footerBlog = (new NewBlog)->footerNewBlog($accommodation->blogorder);
        }
        return view(
            $this->templatePath . '.accommo_detail',
            array(
                'title' => $accommodation->name,
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'accommodation' => $accommodation,
                'accimgs' => $accimgs,
                'tagtype' => $tagtype,
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
    }

    public function accommoSearch(Request $request)
    {
        $keyword = request('name') ?? '';
        $type = request('acctype') ?? '';

        $accommodation = (new Accommodation)->search($keyword, $type);
        $acctype = AccommodationType::GetAccommodationTypes();

        return view(
            $this->templatePath . '.accommo_list',
            array(
                'title' => 'Accommodation',
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'accommodation' => $accommodation,
                'acctype' => $acctype,
            )
        );
    }

    public function allProperty()
    {
        return view($this->templatePath . '.property-summary');
        /*$property = (new Property)->getProperty();
         $protype = PropertyType::GetPropertyTypes();

        return view(
            $this->templatePath . '.property_list',
            array(
                'title' => 'Property',
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'property' => $property,
                'protype' => $protype,
            )
        );*/
    }

    public function propertySearch(Request $request)
    {
        $keyword = request('name') ?? '';
        $type = request('protype') ?? '';

        $property = (new Property)->search($keyword, $type);
        $protype = PropertyType::GetPropertyTypes();

        return view(
            $this->templatePath . '.property_list',
            array(
                'title' => 'Property',
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'property' => $property,
                'protype' => $protype,
            )
        );
    }

    public function getProcats()
    {
        $types = ShopProduct::getSubCats($_POST['type']);


        echo '<option value="">Choose Category</option>';
        if (count($types) >= 1) {
            foreach ($types as $dd) {
                $type = ProCat::getProcat($dd->procat); ?>

                <option value="<?php echo $type->id; ?>"><?php echo $type->name; ?>
                </option>
<?php }
        }
    }

    public function newsDetails($alias)
    {
        $admin = Admin::user();
        $status = '';
        if (empty($admin)) $status = 1;
        $news = (new Blog)->getNews($alias, $status);
        $newsimgs = (new BlogImages)->getImages($news->id);
        $tagtype = (new NewstagType)->GetNewstagTypes();

        if ($news->faccommo) {
            $footerAccommmo = (new Accommodation)->footerAccommo($news->accorder);
        }
        if ($news->fnews) {
            $footerNews = (new Blog)->footerNews($news->norder);
        }
        if ($news->fprop) {
            $footerProperty = (new Property)->footerProperty($news->porder);
        }
        if ($news->fproduct) {
            $footerProduct = (new ShopProduct)->footerProduct($news->proorder);
        }
        if ($news->fservice) {
            $footerService = (new Service)->footerService($news->sorder);
        }
        if ($news->faport) {
            $footerPort = (new Portfolio)->footerPortfolio($news->portorder);
        }
        if ($news->fablog) {
            $footerBlog = (new NewBlog)->footerNewBlog($news->blogorder);
        }
        return view(
            $this->templatePath . '.news_detail',
            array(
                'title' => $news->name,
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'newsD' => $news,
                'newsimgs' => $newsimgs,
                'tagtype' => $tagtype,
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
    }

    public function serviceDetails($alias)
    {
        $admin = Admin::user();
        $status = '';
        if (empty($admin)) $status = 1;
        $service = (new Service)->getServices($alias, $status);
        $serviceimgs = (new ServiceImages)->getImages($service->id);
        $tagtype = (new ServicetagType)->GetServicetagTypes();

        if ($service->faccommo) {
            $footerAccommmo = (new Accommodation)->footerAccommo($service->accorder);
        }
        if ($service->fnews) {
            $footerNews = (new Blog)->footerNews($service->norder);
        }
        if ($service->fprop) {
            $footerProperty = (new Property)->footerProperty($service->porder);
        }
        if ($service->fproduct) {
            $footerProduct = (new ShopProduct)->footerProduct($service->proorder);
        }
        if ($service->fservice) {
            $footerService = (new Service)->footerService($service->sorder);
        }
        if ($service->faport) {
            $footerPort = (new Portfolio)->footerPortfolio($service->portorder);
        }
        if ($service->fablog) {
            $footerBlog = (new NewBlog)->footerNewBlog($service->blogorder);
        }
        return view(
            $this->templatePath . '.service_detail',
            array(
                'title' => $service->name,
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'service' => $service,
                'serviceimgs' => $serviceimgs,
                'tagtype' => $tagtype,
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
    }

    public function productCat($alias)
    {
        $protype = ProType::GetProTypes();
        $cat = (new ProType)->getCat($alias);
        $products = array();
        if ($cat) {
            $products = (new ShopProduct)->searchProduct('', $cat->id);
        }


        return view(
            $this->templatePath . '.shop_products_list',
            array(
                'title' => trans('front.all_product'),
                'keyword' => '',
                'description' => '',
                'products' => $products,
                'layout_page' => 'product_list',
                'protype' => $protype,
                'proc' => [],
                'filter_sort' => [],
            )
        );
    }

    public function newsCat($alias)
    {

        $cat = (new NewsType)->getCat($alias);
        $newstype = NewsType::GetNewsTypes();
        $news = array();
        if ($cat) {
            $news = (new Blog)->getCatNews($cat->id);
        }

        return view(
            $this->templatePath . '.news_list',
            array(
                'title' => 'Blog',
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'news' => $news,
                'newstype' => $newstype,
            )
        );
    }

    public function serviceCat($alias)
    {

        $cat = (new ServiceType)->getCat($alias);
        $services = array();
        if ($cat) {
            $services = (new Service)->getCatServices($cat->id);
        }
        $servicetype = ServiceType::GetServiceTypes();


        return view(
            $this->templatePath . '.service_list',
            array(
                'title' => 'Blog',
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'services' => $services,
                'servicetype' => $servicetype,
            )
        );
    }

    public function propertyDetail($alias)
    {
        $admin = Admin::user();
        $status = '';
        if (empty($admin)) $status = 1;
        $property = (new Property)->getProAlias($alias, $status);
        $proimgs = (new PropertyImages)->getImages($property->id);

        $tagtype = (new PropertytagType)->GetPropertytagTypes();

        if ($property->faccommo) {
            $footerAccommmo = (new Accommodation)->footerAccommo($property->accorder);
        }
        if ($property->fnews) {
            $footerNews = (new Blog)->footerNews($property->norder);
        }
        if ($property->fprop) {
            $footerProperty = (new Property)->footerProperty($property->porder);
        }
        if ($property->fproduct) {
            $footerProduct = (new ShopProduct)->footerProduct($property->proorder);
        }
        if ($property->fservice) {
            $footerService = (new Service)->footerService($property->sorder);
        }
        if ($property->faport) {
            $footerPort = (new Portfolio)->footerPortfolio($property->portorder);
        }
        if ($property->fablog) {
            $footerBlog = (new NewBlog)->footerNewBlog($property->blogorder);
        }

        return view(
            $this->templatePath . '.property_detail',
            array(
                'title' => $property->name,
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'property' => $property,
                'proimgs' => $proimgs,
                'tagtype' => $tagtype,
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
    }


    public function getState()
    {
        $states = (new States)->getStatesId($_POST['cid']);
        echo '<option value="">Province</option>';
        foreach ($states as $state) {
            echo '<option value="' . $state->id . '">' . $state->name . '</option>';
        }
        exit();
    }

    public function summary()
    {
        return view($this->templatePath . '.summary');
    }

    public function addtofav()
    {
        if (Auth::user()) {
            $user = Auth::user();
            $checkExist = Wishlist::checkExist($user->id, $_POST['id'], $_POST['tbl']);
            if ($checkExist) {
                echo '<span class="danger">This item is already in favourite list.</span>';
            } else {
                $dataInsert = [
                    'user_id' => $user->id,
                    'page_data' => $_POST['page'],
                    'post_id' => $_POST['id'],
                    'tbl_data' => $_POST['tbl'],
                ];

                Wishlist::create($dataInsert);
                echo '<span class="success">Added to favourite list</span>';
            }
        } else {
            echo '<span class="danger">Login required to add to favourite</span>';
        }

        exit();
    }

    public function allblog()
    {
        return view($this->templatePath . '.blog-summary');
    }

    public function blogSearch(Request $request)
    {
        $keyword = request('name') ?? '';
        $type = request('blogtype') ?? '';

        $blogtype = BlogType::GetBlogTypes();
        $blog = (new NewBlog)->search($keyword, $type);

        return view(
            $this->templatePath . '.blog_list',
            array(
                'title' => 'Blog',
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'blog' => $blog,
                'blogtype' => $blogtype,
            )
        );
    }

    public function blogDetails($alias)
    {
        $admin = Admin::user();
        $status = '';
        if (empty($admin)) $status = 1;
        $blog = (new NewBlog)->getBlog($alias, $status);

        $previous = NewBlog::where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
        $next = NewBlog::where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->where('id', '>', $blog->id)->orderBy('id')->first();
        $blogimgs = (new NewBlogImages)->getImages($blog->id);
        $tagtype = (new BlogtagType)->GetBlogtagTypes();

        if ($blog->faccommo) {
            $footerAccommmo = (new Accommodation)->footerAccommo($blog->accorder);
        }
        if ($blog->fnews) {
            $footerNews = (new Blog)->footerNews($blog->norder);
        }
        if ($blog->fprop) {
            $footerProperty = (new Property)->footerProperty($blog->porder);
        }
        if ($blog->fproduct) {
            $footerProduct = (new ShopProduct)->footerProduct($blog->proorder);
        }
        if ($blog->fservice) {
            $footerService = (new Service)->footerService($blog->sorder);
        }
        if ($blog->faport) {
            $footerPort = (new Portfolio)->footerPortfolio($blog->portorder);
        }
        if ($blog->fablog) {
            $footerBlog = (new NewBlog)->footerNewBlog($blog->blogorder);
        }
        $blogcat = BlogType::getSingleCat($blog->blogtype);
        return view(
            $this->templatePath . '.blog_detail',
            array(
                'title' => $blog->name,
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'blog' => $blog,
                'blogimgs' => $blogimgs,
                'tagtype' => $tagtype,
                'admin' => $admin,
                'footerAccommmo' => $footerAccommmo ?? [],
                'footerNews' => $footerNews ?? [],
                'footerService' => $footerService ?? [],
                'footerProduct' => $footerProduct ?? [],
                'footerProperty' => $footerProperty ?? [],
                'team' => (new AdminUser)->GetTeamMember(),
                'blogcat' => $blogcat,
                'next' => $next,
                'previous' => $previous,
                'footerPort' => $footerPort ?? [],
                'footerBlog' => $footerBlog ?? [],

            )
        );
    }

    public function blogCat($alias)
    {

        $cat = (new BlogType)->getCat($alias);
        $blog = array();
        if ($cat) {
            $blog = (new NewBlog)->getCatBlog($cat->id);
        }
        $blogtype = BlogType::GetBlogTypes();


        return view(
            $this->templatePath . '.blog_list',
            array(
                'title' => 'Blog',
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'blog' => $blog,
                'blogtype' => $blogtype,
            )
        );
    }

    // public function allportfolio(Request $request)
    // {
    //     $defaultSort = 'featured'; 
    //     $defaultLimit = 8; 
    //     $sort = $request->query('sort', $defaultSort);
    //     $limit = $request->query('limit', $defaultLimit);
    //     $portfolioQuery = Portfolio::where('status', 1);
    //     if ($sort === 'latest') {
    //         $portfolioQuery->latest();
    //     } else {
    //         $portfolioQuery->where('featured', 1)->latest();
    //     }
    //     $feturedList = $portfolioQuery->take($limit)->get();
    //     return view($this->templatePath . '.portfolio-summary', compact('feturedList'));
    // }
    public function allportfolio(Request $request)
    {
        $sort = $request->query('sort', 'featured');
        $limit = $request->query('limit', 8);

        $portfolioQuery = Portfolio::where('status', 1);
        if ($sort === 'latest') {
            $portfolioQuery->latest();
        } else {
            $portfolioQuery->where('featured', 1)->latest();
        }

        $portfolios = $portfolioQuery->paginate($limit);

        if ($request->ajax()) {
            return response()->json([
                'listView' => view('partials.portfolio-items', compact('portfolios'))->render(),
                'gridView' => view('partials.portfolio-grid-items', compact('portfolios'))->render(),
                'nextPageUrl' => $portfolios->nextPageUrl()
            ]);
        }

        return view($this->templatePath . '.portfolio-summary', compact('portfolios'));
    }


    public function portfolioDetails($alias)
    {
        $admin = Admin::user();
        $status = '';
        if (empty($admin)) $status = 1;
        $portfolio = (new Portfolio)->getPortfolio($alias, $status);

        $previous = Portfolio::where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->where('id', '<', $portfolio->id)->orderBy('id', 'desc')->first();
        $next = Portfolio::where('status', 1)->where('expire', '>', now())->where('startdate', '<', now())->where('id', '>', $portfolio->id)->orderBy('id')->first();
        $portfolioimgs = (new PortfolioImages)->getImages($portfolio->id);
        $tagtype = (new PortfoliotagType)->GetPortfoliotagTypes();

        if ($portfolio->faccommo) {
            $footerAccommmo = (new Accommodation)->footerAccommo($portfolio->accorder);
        }
        if ($portfolio->fnews) {
            $footerNews = (new Blog)->footerNews($portfolio->norder);
        }
        if ($portfolio->fprop) {
            $footerProperty = (new Property)->footerProperty($portfolio->porder);
        }
        if ($portfolio->fproduct) {
            $footerProduct = (new ShopProduct)->footerProduct($portfolio->proorder);
        }
        if ($portfolio->fservice) {
            $footerService = (new Service)->footerService($portfolio->sorder);
        }
        if ($portfolio->faport) {
            $footerPort = (new Portfolio)->footerPortfolio($portfolio->portorder);
        }
        if ($portfolio->fablog) {
            $footerBlog = (new NewBlog)->footerNewBlog($portfolio->blogorder);
        }
        $portcat = PortfolioType::getSingleCat($portfolio->portfoliotype);
        return view(
            $this->templatePath . '.portfolio_detail',
            array(
                'title' => $portfolio->name,
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'portfolio' => $portfolio,
                'portfolioimgs' => $portfolioimgs,
                'tagtype' => $tagtype,
                'admin' => $admin,
                'footerAccommmo' => $footerAccommmo ?? [],
                'footerNews' => $footerNews ?? [],
                'footerService' => $footerService ?? [],
                'footerProduct' => $footerProduct ?? [],
                'footerProperty' => $footerProperty ?? [],
                'team' => (new AdminUser)->GetTeamMember(),
                'portcat' => $portcat,
                'next' => $next,
                'previous' => $previous,
                'footerPort' => $footerPort ?? [],
                'footerBlog' => $footerBlog ?? [],

            )
        );
    }

    public function portfolioCat($alias)
    {

        $cat = (new PortfolioType)->getCat($alias);
        $portfolio = array();
        if ($cat) {
            $portfolio = (new Portfolio)->getCatPortfolio($cat->id);
        }
        $portfoliotype = PortfolioType::GetPortfolioTypes();


        return view(
            $this->templatePath . '.portfolio_list',
            array(
                'title' => 'Portfolio',
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'portfolio' => $portfolio,
                'portfoliotype' => $portfoliotype,
            )
        );
    }

    public function portfolioSearch(Request $request)
    {
        $keyword = request('name') ?? '';
        $type = request('portfoliotype') ?? '';

        $portfoliotype = PortfolioType::GetPortfolioTypes();
        $portfolio = (new Portfolio)->search($keyword, $type);

        return view(
            $this->templatePath . '.portfolio_list',
            array(
                'title' => 'Portfolio',
                'description' => sc_store('description'),
                'keyword' => sc_store('keyword'),
                'portfolio' => $portfolio,
                'portfoliotype' => $portfoliotype,
            )
        );
    }
}
