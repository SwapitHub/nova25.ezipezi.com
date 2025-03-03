<?php
#app/Http/Admin/Controllers/ShopProductController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopAttributeGroup;
use App\Models\ShopBrand;
use App\Models\ShopCategory;
use App\Models\ShopLanguage;
use App\Models\ShopProduct;
use App\Models\ShopProductAttribute;
use App\Models\ShopProductBuild;
use App\Models\ShopProductDescription;
use App\Models\ShopProductGroup;
use App\Models\ShopProductImage;
use App\Models\ShopVendor;
use App\Models\ProType;
use App\Models\ProCat;
use App\Models\Branch;
use App\Models\ProtagType;
use App\Admin\Models\AdminUser;
use App\Admin\Admin;


use Illuminate\Http\Request;
use Validator;

class ShopProductController extends Controller
{
    public $languages, $types, $kinds, $virtuals, $attributeGroup;

    public function __construct()
    {
        $this->languages = ShopLanguage::getList();
        $this->attributeGroup = ShopAttributeGroup::getList();
        $this->types = [
            SC_PRODUCT_NORMAL => trans('product.types.normal'),
            SC_PRODUCT_NEW => trans('product.types.new'),
            SC_PRODUCT_HOT => trans('product.types.hot'),
        ];
        $this->kinds = [
            SC_PRODUCT_SINGLE => trans('product.kinds.single'),
            SC_PRODUCT_BUILD => trans('product.kinds.build'),
            SC_PRODUCT_GROUP => trans('product.kinds.group'),
        ];
        $this->virtuals = [
            SC_VIRTUAL_PHYSICAL => trans('product.virtuals.physical'),
            SC_VIRTUAL_DOWNLOAD => trans('product.virtuals.download'),
            SC_VIRTUAL_ONLY_VIEW => trans('product.virtuals.only_view'),
            SC_VIRTUAL_SERVICE => trans('product.virtuals.service'),
        ];

    }

    public function index()
    {
         $admin = Admin::user();
        $data = [
            'title' => trans('product.admin.list'),
            'sub_title' => '',
            'icon' => 'fa fa-indent',
            'menu_left' => '',
            'menu_right' => '',
            'menu_sort' => '',
            'script_sort' => '',
            'menu_search' => '',
            'script_search' => '',
            'listTh' => '',
            'dataTr' => '',
            'pagination' => '',
            'result_items' => '',
            'url_delete_item' => '',
        ];

        $listTh = [
            'check_row' => '',
            'id' => trans('product.id'),
            'image' => trans('product.image'),
            'sku' => trans('product.sku'),
            'name' => trans('product.name'),            
        ];
        if(sc_config('product_cost')){
            $listTh['cost'] = trans('product.cost');
        }
        if(sc_config('product_price')){
            $listTh['price'] = trans('product.price');
        }
        if(sc_config('product_type')){
            $listTh['type'] = trans('product.type');
        }
         $listTh['expire'] = 'Expiry Date';
        if(sc_config('product_kind')){
            $listTh['kind'] = trans('product.kind');
        }
        if(sc_config('product_virtual')){
            $listTh['virtual'] = trans('product.virtual');
        }
        $listTh['status'] = trans('product.status');
        $listTh['action'] = trans('product.admin.action');


        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans('product.admin.sort_order.id_desc'),
            'id__asc' => trans('product.admin.sort_order.id_asc'),
            'name__desc' => trans('product.admin.sort_order.name_desc'),
            'name__asc' => trans('product.admin.sort_order.name_asc'),
        ];
        $obj = new ShopProduct;

        $obj = $obj
            ->leftJoin('shop_product_description', 'shop_product_description.product_id', 'shop_product.id')
            ->where('shop_product_description.lang', sc_get_locale());
        if ($keyword) {
            $obj = $obj->whereRaw('(id = ' . (int) $keyword . ' OR shop_product_description.name like "%' . $keyword . '%" )');
        }
        if($admin->role!=1)
        {
            $obj = $obj->where('shop_product.userid',$admin->id);
        }
        if ($sort_order && array_key_exists($sort_order, $arrSort)) {
            $field = explode('__', $sort_order)[0];
            $sort_field = explode('__', $sort_order)[1];
            $obj = $obj->orderBy($field, $sort_field);

        } else {
            $obj = $obj->orderBy('id', 'desc');
        }
        $dataTmp = $obj->paginate(20);

        $dataTr = [];
        foreach ($dataTmp as $key => $row) {
            $kind = $this->kinds[$row['kind']] ?? $row['kind'];
            if ($row['kind'] == SC_PRODUCT_BUILD) {
                $kind = '<span class="label label-success">' . $kind . '</span>';
            } elseif ($row['kind'] == SC_PRODUCT_GROUP) {
                $kind = '<span class="label label-danger">' . $kind . '</span>';
            }
            $type = $this->types[$row['type']] ?? $row['type'];
            if ($row['type'] == SC_PRODUCT_NEW) {
                $type = '<span class="label label-success">' . $type . '</span>';
            } elseif ($row['type'] == SC_PRODUCT_HOT) {
                $type = '<span class="label label-danger">' . $type . '</span>';
            }
            $dataMap = [
                'check_row' => '<input type="checkbox" class="grid-row-checkbox" data-id="' . $row['id'] . '">',
                'id' => $row['id'],
                'image' => sc_image_render($row->getThumb(), '50px', '50px'),
                'sku' => $row['sku'],
                'name' => $row['name'],                
                
            ];
            if(sc_config('product_cost')){
                $dataMap['cost'] = $row['cost'];
            }
            if(sc_config('product_price')){
                $dataMap['price'] = $row['price'];
            }
            if(sc_config('product_type')){
                $dataMap['type'] = $type;
            }
            $dataMap['expire'] = $row['expire'];
            if(sc_config('product_kind')){
                $dataMap['kind'] = $kind;
            }
            if(sc_config('product_virtual')){
                $dataMap['virtual'] = $this->virtuals[$row['virtual']] ?? $row['virtual'];
            }
            $dataMap['status'] = $row['status'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>';
            $dataMap['action'] = '
            <a href="' . route('admin_product.edit', ['id' => $row['id']]) . '">
            <span title="' . trans('product.admin.edit') . '" type="button" class="btn btn-flat btn-primary">
            <i class="fa fa-edit"></i>
            </span>
            </a>&nbsp;

            <span onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('admin.delete') . '" class="btn btn-flat btn-danger">
            <i class="fa fa-trash"></i>
            </span>';
            $dataTr[] = $dataMap;
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('product.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);
//menu_left
        $data['menu_left'] = '<div class="pull-left">
                    <button type="button" class="btn btn-default grid-select-all"><i class="fa fa-square-o"></i></button> &nbsp;

                    <a class="btn   btn-flat btn-danger grid-trash" title="Delete"><i class="fa fa-trash-o"></i><span class="hidden-xs"> ' . trans('admin.delete') . '</span></a> &nbsp;

                    <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('admin.refresh') . '</span></a> &nbsp;</div>
                    ';
//=menu_left

//menu_right

        $data['menu_right'] = '
                        <div class="btn-group pull-right" style="margin-right: 10px">
                           <a href="' . route('admin_product.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus"></i><span class="hidden-xs">' . trans('admin.add_new') . '</span>
                           </a>
                        </div>
                        ';
        if(sc_config('ImportProduct')) {
            $data['menu_right'] .= '
            <div class="btn-group pull-right" style="margin-right: 10px">
            <a href="' . route('admin_import_product.index') . '" class="btn  btn-success  btn-flat" title="New">
            <i class="fa fa fa-floppy-o"></i> <span class="hidden-xs">' . trans('admin.add_new_multi') . '</span>
            </a>
            </div>
            ';
            
        }

//=menu_right

//menu_sort

        $optionSort = '';
        foreach ($arrSort as $key => $status) {
            $optionSort .= '<option  ' . (($sort_order == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
        }

        $data['menu_sort'] = '
                       <div class="btn-group pull-left">
                        <div class="form-group">
                           <select class="form-control" id="order_sort">
                            ' . $optionSort . '
                           </select>
                         </div>
                       </div>

                       <div class="btn-group pull-left">
                           <a class="btn btn-flat btn-primary" title="Sort" id="button_sort">
                              <i class="fa fa-sort-amount-asc"></i><span class="hidden-xs"> ' . trans('admin.sort') . '</span>
                           </a>
                       </div>';

        $data['script_sort'] = "$('#button_sort').click(function(event) {
      var url = '" . route('admin_product.index') . "?sort_order='+$('#order_sort option:selected').val();
      $.pjax({url: url, container: '#pjax-container'})
    });";

//=menu_sort

//menu_search

        $data['menu_search'] = '
                <form action="' . route('admin_product.index') . '" id="button_search">
                   <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" title="Refresh">
                              <i class="fa  fa-search"></i><span class="hidden-xs"> ' . trans('admin.search') . '</span>
                           </a>
                   </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="' . trans('product.admin.search_place') . '" value="' . $keyword . '">
                         </div>
                   </div>
                </form>';
//=menu_search

        $data['url_delete_item'] = route('admin_product.delete');

        return view('admin.screen.list')
            ->with($data);
    }

/**
 * Form create new order in admin
 * @return [type] [description]
 */
    public function create()
    {
        $provi =  ShopProduct::getProvincia();
        $protype = ProType::GetProTypes();
        $branch = Branch::getBranches();
        $listProductSingle = (new ShopProduct)->getListSigle();
        $tagtype = ProtagType::GetProtagTypes();
        $users =  AdminUser::GetAdminUsers();

        // html select product group
        $htmlSelectGroup = '<div class="select-product">';
        $htmlSelectGroup .= '<table width="100%"><tr><td width="80%"><select class="form-control productInGroup select2" data-placeholder="' . trans('product.admin.select_product_in_group') . '" style="width: 100%;" name="productInGroup[]" >';
        $htmlSelectGroup .= '';
        foreach ($listProductSingle as $k => $v) {
            $htmlSelectGroup .= '<option value="' . $k . '">' . $v['name'] . '</option>';
        }
        $htmlSelectGroup .= '</select></td><td><span title="Remove" class="btn btn-flat btn-danger removeproductInGroup"><i class="fa fa-times"></i></span></td></tr></table>';
        $htmlSelectGroup .= '</div>';
        //End select product group

        // html select product build
        $htmlSelectBuild = '<div class="select-product">';
        $htmlSelectBuild .= '<table width="100%"><tr><td width="70%"><select class="form-control productInGroup select2" data-placeholder="' . trans('product.admin.select_product_in_build') . '" style="width: 100%;" name="productBuild[]" >';
        $htmlSelectBuild .= '';
        foreach ($listProductSingle as $k => $v) {
            $htmlSelectBuild .= '<option value="' . $k . '">' . $v['name'] . '</option>';
        }
        $htmlSelectBuild .= '</select></td><td style="width:100px"><input class="form-control"  type="number" name="productBuildQty[]" value="1" min=1></td><td><span title="Remove" class="btn btn-flat btn-danger removeproductBuild"><i class="fa fa-times"></i></span></td></tr></table>';
        $htmlSelectBuild .= '</div>';
        //end select product build

        // html select attribute
        $htmlProductAtrribute = '<tr><td><br><input type="text" name="attribute[attribute_group][]" value="attribute_value" class="form-control input-sm" placeholder="' . trans('product.admin.add_attribute_place') . '" /></td><td><br><span title="Remove" class="btn btn-flat btn-sm btn-danger removeAttribute"><i class="fa fa-times"></i></span></td></tr><tr><td><br><input type="text" name="priceattr[attribute_price][]"  class="form-control input-sm" placeholder="' . trans('price') . '" /></td><td></td></tr>';
        //end select attribute

        // html add more images
        $htmlMoreImage = '<div class="input-group"><input type="text" id="id_sub_image" name="sub_image[]" value="image_value" class="form-control input-sm sub_image" placeholder=""  /><span class="input-group-btn"><a data-input="id_sub_image" data-preview="preview_sub_image" data-type="product" class="btn btn-sm btn-primary lfm"><i class="fa fa-picture-o"></i> Choose</a></span></div><div id="preview_sub_image" class="img_holder"></div>';
        //end add more images

        $data = [
            'title' => trans('product.admin.add_new_title'),
            'sub_title' => '',
            'title_description' => trans('product.admin.add_new_des'),
            'icon' => 'fa fa-plus',
            'languages' => $this->languages,
            'categories' => (new ShopCategory)->getTreeCategories(),
            'brands' => (new ShopBrand)->getList(),
            'vendors' => (new ShopVendor)->getList(),
            'types' => $this->types,
            'virtuals' => $this->virtuals,
            'kinds' => $this->kinds,
            'attributeGroup' => $this->attributeGroup,
            'htmlSelectGroup' => $htmlSelectGroup,
            'htmlSelectBuild' => $htmlSelectBuild,
            'listProductSingle' => $listProductSingle,
            'htmlProductAtrribute' => $htmlProductAtrribute,
            'htmlMoreImage' => $htmlMoreImage,  
            'provi' => $provi,
            'states' => [],
            'subloc' => [],
            'branch' => $branch,
            'protype' => $protype,
            'tagtype' => $tagtype,
            'subImages' => [],
            'users' => $users,
        ];

        return view('admin.screen.product_add')
            ->with($data);
    }

/**
 * Post create new order in admin
 * @return [type] [description]
 */

    public function postCreate()
    {
        $admin = Admin::user();
        $data = request()->all();
        $langFirst = array_key_first(sc_language_all()->toArray()); //get first code language active
        $data['alias'] = !empty($data['alias'])?$data['alias']:$data['descriptions'][$langFirst]['name'];
        $data['alias'] = sc_word_format_url($data['alias']);
        $data['alias'] = sc_word_limit($data['alias'], 100);

        switch ($data['kind']) {
            case SC_PRODUCT_SINGLE: // product single
                $arrValidation = [
                    'kind' => 'required',
                    'provincia' => 'required',
                    'localidad' => 'required',
                    'location' => 'required',  
                    'protype' => 'required',  
                    'procat' => 'required',  
                    'expire' => 'required',  
                    'sort' => 'numeric|min:0',
                    'descriptions.*.name' => 'required|string|max:100',
                    'descriptions.*.content' => 'required|string',
                    
                    'sku' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_product,sku',
                    'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_product,alias|string|max:100',
                ];
                $arrMsg = [
                    'descriptions.*.name.required' => trans('validation.required', ['attribute' => trans('product.name')]),
                    'descriptions.*.content.required' => trans('validation.required', ['attribute' => trans('product.content')]),                    
                    'sku.regex' => trans('product.sku_validate'),
                    'alias.regex' => trans('product.alias_validate'),  
                    'provincia.required' => 'The country field is required.',
                    'localidad.required' => 'The state field is required.',
                    
                ];
                break;

            case SC_PRODUCT_BUILD: //product build
                $arrValidation = [
                    'kind' => 'required', 
                    'provincia' => 'required',
                    'localidad' => 'required',                   
                    'location' => 'required', 
                    'protype' => 'required',  
                    'procat' => 'required',
                     'expire' => 'required',                  
                    'sort' => 'numeric|min:0',
                    'descriptions.*.name' => 'required|string|max:100',
                    
                    'sku' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_product,sku',
                    'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_product,alias|string|max:100',
                    'productBuild' => 'required',
                    'productBuildQty' => 'required',

                ];
                $arrMsg = [
                    'descriptions.*.name.required' => trans('validation.required', ['attribute' => trans('product.name')]),                    
                    'sku.regex' => trans('product.sku_validate'),
                    'alias.regex' => trans('product.alias_validate'),
                ];
                break;

            case SC_PRODUCT_GROUP: //product group
                $arrValidation = [
                    'kind' => 'required',
                    'provincia' => 'required',
                    'localidad' => 'required',
                    'location' => 'required', 
                    'protype' => 'required',  
                    'procat' => 'required', 
                     'expire' => 'required',
                    'productInGroup' => 'required',
                    'sku' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_product,sku',
                    'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_product,alias|string|max:100',
                    'sort' => 'numeric|min:0',
                    'descriptions.*.name' => 'required|string|max:100',
                ];
                $arrMsg = [
                    'descriptions.*.name.required' => trans('validation.required', ['attribute' => trans('product.name')]),
                    'sku.regex' => trans('product.sku_validate'),
                    'alias.regex' => trans('product.alias_validate'),
                ];
                break;

            default:
                $arrValidation = [
                    'kind' => 'required',
                ];
                break;
        }

        $validator = Validator::make($data, $arrValidation, $arrMsg ?? []);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }

        if(!empty($data['tags'])) $tags =  implode(",",$data['tags']);  
        else $tags = ''; 

        if(!empty($data['author'])) $author =  implode(",",$data['author']);
        else $author = ''; 

        $category = $data['category'] ?? [];
        $attribute = $data['attribute'] ?? [];
        $priceattr = $data['priceattr'] ?? [];
        $descriptions = $data['descriptions'];
        $productInGroup = $data['productInGroup'] ?? [];
        $productBuild = $data['productBuild'] ?? [];
        $productBuildQty = $data['productBuildQty'] ?? [];
        $subImages = $data['sub_image'] ?? [];
        $dataInsert = [
            'brand_id' => $data['brand_id']??0,
            'vendor_id' => $data['vendor_id']??0,
            'provincia' => $data['provincia'],
            'userid' => $admin->id,
            'state' => $data['localidad'],
            'introduction' => $data['introduction'],
            'protype' => $data['protype'],
            'procat' => $data['procat'],
            'branch' => $data['branch'],
            'author' => $author,
            'location' => $data['location'],
            'price' => $data['price']??0,
            'sku' => $data['sku'],
            'cost' => $data['cost']??0,
            'stock' => $data['stock']??0,
            'type' => $data['type'] ?? SC_PRODUCT_NORMAL,
            'kind' => $data['kind']??SC_PRODUCT_SINGLE,
            'alias' => $data['alias'],
            'add_regname' => $data['add_regname'],
            'add_fname' => $data['add_fname'],
            'add_lname' => $data['add_lname'],
            'add_email' => $data['add_email'],
            'add_postal1' => $data['add_postal1'],
            'add_postal2' => $data['add_postal2'],
            'add_postal3' => $data['add_postal3'],
            'add_postcode' => $data['add_postcode'],
            'add_busiphone' => $data['add_busiphone'],
            'add_homephone' => $data['add_homephone'],
            'add_cellphone' => $data['add_cellphone'],
            'notes' => $data['notes'],
            'add_mainloc' => $data['add_mainloc'],
            'add_subloc' => $data['add_subloc'],
            'add_loc' => $data['add_loc'],
            'tags' => $tags,
            'expire' => $data['expire'],
            'startdate' => $data['startdate'],
            'virtual' => $data['virtual'] ?? SC_VIRTUAL_PHYSICAL,
            'date_available' => !empty($data['date_available']) ? $data['date_available'] : null,
            'image' => $data['image']??'',
            'status' => (!empty($data['status']) ? 1 : 0),
            'featured' => (!empty($data['featured']) ? 1 : 0),
            'sort' => (int) $data['sort'],
            'accorder' => $data['accorder'],
            'sorder' => $data['sorder'],
            'proorder' => $data['proorder'],
            'norder' => $data['norder'],
            'porder' => $data['porder'],
            'fprop' => !empty($data['fprop']) ? 1 : 0,
            'fnews' => !empty($data['fnews']) ? 1 : 0,
            'fproduct' => !empty($data['fproduct']) ? 1 : 0,
            'fservice' => !empty($data['fservice']) ? 1 : 0,
            'faccommo' => !empty($data['faccommo']) ? 1 : 0,
             'testimonial' => !empty($data['testimonial']) ? 1 : 0,
             'fablog' => !empty($data['fablog']) ? 1 : 0,
            'faport' => !empty($data['faport']) ? 1 : 0,
            'portorder' => $data['portorder'],
            'blogorder' => $data['blogorder'],
        ];
        //insert product
        $product = ShopProduct::create($dataInsert);

        //Promoton price
        if (isset($data['price_promotion']) && in_array($data['kind'], [SC_PRODUCT_SINGLE, SC_PRODUCT_BUILD])) {
            $arrPromotion['price_promotion'] = $data['price_promotion'];
            $arrPromotion['date_start'] = $data['price_promotion_start'] ? $data['price_promotion_start'] : null;
            $arrPromotion['date_end'] = $data['price_promotion_end'] ? $data['price_promotion_end'] : null;
            $product->promotionPrice()->create($arrPromotion);
        }

        //Insert category
        if ($category && in_array($data['kind'], [SC_PRODUCT_SINGLE, SC_PRODUCT_BUILD])) {
            $product->categories()->attach($category);
        }
        //Insert group
        if ($productInGroup && $data['kind'] == SC_PRODUCT_GROUP) {
            $arrDataGroup = [];
            foreach ($productInGroup as $pID) {
                if ((int) $pID) {
                    $arrDataGroup[$pID] = new ShopProductGroup(['product_id' => $pID]);
                }
            }
            $product->groups()->saveMany($arrDataGroup);
        }

        //Insert Build
        if ($productBuild && $data['kind'] == SC_PRODUCT_BUILD) {
            $arrDataBuild = [];
            foreach ($productBuild as $key => $pID) {
                if ((int) $pID) {
                    $arrDataBuild[$pID] = new ShopProductBuild(['product_id' => $pID, 'quantity' => $productBuildQty[$key]]);
                }
            }
            $product->builds()->saveMany($arrDataBuild);
        }

        //Insert attribute

        if ($attribute && $data['kind'] == SC_PRODUCT_SINGLE) {
            $arrDataAtt = [];
            foreach ($attribute as $group => $rowGroup) {
                if (count($rowGroup)) {
                    foreach ($rowGroup as $key => $nameAtt) {
                        if ($nameAtt) {
                            $arrDataAtt[] = new ShopProductAttribute(['name' => $nameAtt, 'attribute_group_id' => $group, 'price' => $priceattr[$group][$key]]);
                        }
                    }
                }

            }
           
            $product->attributes()->saveMany($arrDataAtt);
        }

        //Insert description
        $dataDes = [];
        $languages = $this->languages;
        foreach ($languages as $code => $value) {
            $dataDes[] = [
                'product_id' => $product->id,
                'lang' => $code,
                'name' => $descriptions[$code]['name'],
                'keyword' => $descriptions[$code]['keyword'],
                'description' => $descriptions[$code]['description'],
                'content' => $descriptions[$code]['content'] ?? '',
            ];
        }

        $proid = ShopProductDescription::insert($dataDes);

           if ($subImages) {            
            foreach ($subImages as $key => $image) {
                if ($image) {
                     $dataImage = [
                        'image' => $image,
                        'imagealt' => $data['imagealt'][$i],
                        'product_id' => $proid->id,                        
                    ];
                }
                ShopProductImage::create($dataImage);
            }
            
        }

        /*//Insert sub mages
        if ($subImages && in_array($data['kind'], [SC_PRODUCT_SINGLE, SC_PRODUCT_BUILD])) {
            $arrSubImages = [];
            foreach ($subImages as $key => $image) {
                if ($image) {
                    $arrSubImages[] = new ShopProductImage(['image' => $image]);
                }
            }
            $product->images()->saveMany($arrSubImages);
        }
*/
        return redirect()->route('admin_product.index')->with('success', trans('product.admin.create_success'));

    }

/**
 * Form edit
 */
    public function edit($id)
    {
        $provi =  ShopProduct::getProvincia();
        $protype = ProType::GetProTypes();
        $branch = Branch::getBranches();
        $tagtype = ProtagType::GetProtagTypes();
         $users =  AdminUser::GetAdminUsers();

        $product = ShopProduct::find($id);
       $states =  ShopProduct::getLocalidads($product->provincia);
        $add_subloc =  ShopProduct::getLocalidads($product->add_subloc);
        $subloc =  ShopProduct::getSubloc($product->state);
        $add_loc =  ShopProduct::getSubloc($product->add_loc);
        $procat = ProCat::getProcats($product->protype);
         $subImages = ShopProductImage::getImages($id);
        
        if ($product === null) {
            return 'no data';
        }

        $listProductSingle = (new ShopProduct)->getListSigle();

        // html select product group
        $htmlSelectGroup = '<div class="select-product">';
        $htmlSelectGroup .= '<table width="100%"><tr><td width="80%"><select class="form-control productInGroup select2" data-placeholder="' . trans('product.admin.select_product_in_group') . '" style="width: 100%;" name="productInGroup[]" >';
        $htmlSelectGroup .= '';
        foreach ($listProductSingle as $k => $v) {
            $htmlSelectGroup .= '<option value="' . $k . '">' . $v['name'] . '</option>';
        }
        $htmlSelectGroup .= '</select></td><td><span title="Remove" class="btn btn-flat btn-danger removeproductInGroup"><i class="fa fa-times"></i></span></td></tr></table>';
        $htmlSelectGroup .= '</div>';
        //End select product group

        // html select product build
        $htmlSelectBuild = '<div class="select-product">';
        $htmlSelectBuild .= '<table width="100%"><tr><td width="70%"><select class="form-control productInGroup select2" data-placeholder="' . trans('product.admin.select_product_in_build') . '" style="width: 100%;" name="productBuild[]" >';
        $htmlSelectBuild .= '';
        foreach ($listProductSingle as $k => $v) {
            $htmlSelectBuild .= '<option value="' . $k . '">' . $v['name'] . '</option>';
        }
        $htmlSelectBuild .= '</select></td><td style="width:100px"><input class="form-control"  type="number" name="productBuildQty[]" value="1" min=1></td><td><span title="Remove" class="btn btn-flat btn-danger removeproductBuild"><i class="fa fa-times"></i></span></td></tr></table>';
        $htmlSelectBuild .= '</div>';
        //end select product build

        // html select attribute
        $htmlProductAtrribute = '<tr><td><br><input type="text" name="attribute[attribute_group][]" value="attribute_value" class="form-control input-sm" placeholder="' . trans('product.admin.add_attribute_place') . '" /></td><td><br><span title="Remove" class="btn btn-flat btn-sm btn-danger removeAttribute"><i class="fa fa-times"></i></span></td></tr><tr><td><br><input type="text" name="priceattr[attribute_price][]"  value="price_value" class="form-control input-sm pricetr" placeholder="' . trans('price') . '" /></td><td></td></tr>';
        //end select attribute

        $data = [
            'title' => trans('product.admin.edit'),
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'languages' => $this->languages,
            'product' => $product,
            'categories' => (new ShopCategory)->getTreeCategories(),
            'brands' => (new ShopBrand)->getList(),
            'vendors' => (new ShopVendor)->getList(),
            'types' => $this->types,
            'virtuals' => $this->virtuals,
            'kinds' => $this->kinds,
            'attributeGroup' => $this->attributeGroup,
            'htmlSelectGroup' => $htmlSelectGroup,
            'htmlSelectBuild' => $htmlSelectBuild,
            'listProductSingle' => $listProductSingle,
            'htmlProductAtrribute' => $htmlProductAtrribute,
            'provi' => $provi,
            'states' => $states,
            'subloc' => $subloc,
            'branch' => $branch,
            'protype' => $protype,
            'procat' => $procat,
            'tagtype' => $tagtype,
            'subImages' => $subImages,
            'add_subloc' => $add_subloc,
            'add_loc' => $add_loc,
            'users' => $users,
        ];
        return view('admin.screen.product_edit')
            ->with($data);
    }

/**
 * update status
 */
    public function postEdit($id)
    {
        $admin = Admin::user();
        $product = ShopProduct::find($id);
        $data = request()->all();
        $langFirst = array_key_first(sc_language_all()->toArray()); //get first code language active
        $data['alias'] = !empty($data['alias'])?$data['alias']:$data['descriptions'][$langFirst]['name'];
        $data['alias'] = sc_word_format_url($data['alias']);
        $data['alias'] = sc_word_limit($data['alias'], 100);

        switch ($product['kind']) {
            case SC_PRODUCT_SINGLE: // product single
                $arrValidation = [
                    'sort' => 'numeric|min:0',
                    'provincia' => 'required',
                    'localidad' => 'required',
                    'location' => 'required', 
                    'protype' => 'required',  
                    'procat' => 'required',
                     'expire' => 'required',
                    'descriptions.*.name' => 'required|string|max:100',
                    'descriptions.*.content' => 'required|string',
                    
                    'sku' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_product,sku,' . $product->id . ',id',
                    'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_product,alias,' . $product->id . ',id|string|max:100',
                ];
                $arrMsg = [
                    'descriptions.*.name.required' => trans('validation.required', ['attribute' => trans('product.name')]),
                    'descriptions.*.content.required' => trans('validation.required', ['attribute' => trans('product.content')]),
                    
                    'sku.regex' => trans('product.sku_validate'),
                    'alias.regex' => trans('product.alias_validate'),
                    'provincia.required' => 'The country field is required.',
                    'localidad.required' => 'The state field is required.',
                ];
                break;
            case SC_PRODUCT_BUILD: //product build
                $arrValidation = [
                    'sort' => 'numeric|min:0',
                    'provincia' => 'required',
                    'localidad' => 'required',
                    'location' => 'required', 
                    'protype' => 'required',  
                    'procat' => 'required',
                     'expire' => 'required',
                    'descriptions.*.name' => 'required|string|max:100',
                    
                    'sku' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_product,sku,' . $product->id . ',id',
                    'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_product,alias,' . $product->id . ',id|string|max:100',
                    'productBuild' => 'required',
                    'productBuildQty' => 'required',
                ];
                $arrMsg = [
                    'descriptions.*.name.required' => trans('validation.required', ['attribute' => trans('product.name')]),
                    
                    'sku.regex' => trans('product.sku_validate'),
                    'alias.regex' => trans('product.alias_validate'),
                ];
                break;

            case SC_PRODUCT_GROUP: //product group
                $arrValidation = [
                    'sku' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_product,sku,' . $product->id . ',id',
                    'provincia' => 'required',
                    'localidad' => 'required',
                    'location' => 'required', 
                    'protype' => 'required',
                     'expire' => 'required',  
                    'procat' => 'required',
                    'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:shop_product,alias,' . $product->id . ',id|string|max:100',
                    'productInGroup' => 'required',
                    'sort' => 'numeric|min:0',
                    'descriptions.*.name' => 'required|string|max:100',
                ];
                $arrMsg = [
                    'sku.regex' => trans('product.sku_validate'),
                    'alias.regex' => trans('product.alias_validate'),
                    'descriptions.*.name.required' => trans('validation.required', ['attribute' => trans('product.name')]),
                ];
                break;

            default:
                break;
        }

        $validator = Validator::make($data, $arrValidation, $arrMsg ?? []);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }
//Edit

        $category = $data['category'] ?? [];
        $attribute = $data['attribute'] ?? [];
        $priceattr = $data['priceattr'] ?? [];

        if(!empty($data['tags'])) $tags =  implode(",",$data['tags']);  
        else $tags = ''; 

        if(!empty($data['author'])) $author =  implode(",",$data['author']);
        else $author = ''; 


        $productInGroup = $data['productInGroup'] ?? [];
        $productBuild = $data['productBuild'] ?? [];
        $productBuildQty = $data['productBuildQty'] ?? [];
        $subImages = $data['sub_image'] ?? [];

        $dataUpdate = [
            'image' => $data['image'] ?? '',
            'introduction' => $data['introduction'],
            'userid' => $admin->id,
            'image_alt' => $data['image_alt'],
            'brand_id' => $data['brand_id'] ?? 0,
            'vendor_id' => $data['vendor_id'] ?? 0,
            'provincia' => $data['provincia'],
            'state' => $data['localidad'],
            'protype' => $data['protype'],
            'procat' => $data['procat'],
            'branch' => $data['branch'],
            'author' => $author,
            'location' => $data['location'],
            'price' => $data['price'] ?? 0,
            'cost' => $data['cost'] ?? 0,
            'stock' => $data['stock'] ?? 0,
            'type' => $data['type'] ?? SC_PRODUCT_NORMAL,
            'virtual' => $data['virtual'] ?? SC_VIRTUAL_PHYSICAL,
            'date_available' => !empty($data['date_available']) ? $data['date_available'] : null,
            'sku' => $data['sku'],
            'alias' => $data['alias'],
            'add_regname' => $data['add_regname'],
            'add_fname' => $data['add_fname'],
            'add_lname' => $data['add_lname'],
            'add_email' => $data['add_email'],
            'add_postal1' => $data['add_postal1'],
            'add_postal2' => $data['add_postal2'],
            'add_postal3' => $data['add_postal3'],
            'add_postcode' => $data['add_postcode'],
            'add_busiphone' => $data['add_busiphone'],
            'add_homephone' => $data['add_homephone'],
            'add_cellphone' => $data['add_cellphone'],
            'notes' => $data['notes'],
            'add_mainloc' => $data['add_mainloc'],
            'add_subloc' => $data['add_subloc'],
            'add_loc' => $data['add_loc'],
            'tags' => $tags,
            'expire' => $data['expire'],
            'startdate' => $data['startdate'],
            'status' => (!empty($data['status']) ? 1 : 0),
            'featured' => (!empty($data['featured']) ? 1 : 0),
            'sort' => (int) $data['sort'],
            'accorder' => $data['accorder'],
            'sorder' => $data['sorder'],
            'proorder' => $data['proorder'],
            'norder' => $data['norder'],
            'porder' => $data['porder'],
            'fprop' => !empty($data['fprop']) ? 1 : 0,
            'fnews' => !empty($data['fnews']) ? 1 : 0,
            'fproduct' => !empty($data['fproduct']) ? 1 : 0,
            'fservice' => !empty($data['fservice']) ? 1 : 0,
            'faccommo' => !empty($data['faccommo']) ? 1 : 0,
             'testimonial' => !empty($data['testimonial']) ? 1 : 0,
             'fablog' => !empty($data['fablog']) ? 1 : 0,
            'faport' => !empty($data['faport']) ? 1 : 0,
            'portorder' => $data['portorder'],
            'blogorder' => $data['blogorder'],
        ];

        $product->update($dataUpdate);

        //Promoton price
        $product->promotionPrice()->delete();
        if (isset($data['price_promotion']) && in_array($product['kind'], [SC_PRODUCT_SINGLE, SC_PRODUCT_BUILD])) {
            $arrPromotion['price_promotion'] = $data['price_promotion'];
            $arrPromotion['date_start'] = $data['price_promotion_start'] ? $data['price_promotion_start'] : null;
            $arrPromotion['date_end'] = $data['price_promotion_end'] ? $data['price_promotion_end'] : null;
            $product->promotionPrice()->create($arrPromotion);
        }

        $product->descriptions()->delete();
        $dataDes = [];
        foreach ($data['descriptions'] as $code => $row) {
            $dataDes[] = [
                'product_id' => $id,
                'lang' => $code,
                'name' => $row['name'],
                'keyword' => $row['keyword'],
                'description' => $row['description'],
                'content' => $row['content'] ?? '',
            ];
        }
        ShopProductDescription::insert($dataDes);

        //Update category
        if (in_array($product['kind'], [SC_PRODUCT_SINGLE, SC_PRODUCT_BUILD])) {
            $product->categories()->detach();
            if (count($category)) {
                $product->categories()->attach($category);
            }

        }

        //Update group
        if ($product['kind'] == SC_PRODUCT_GROUP) {
            $product->groups()->delete();
            if (count($productInGroup)) {
                $arrDataGroup = [];
                foreach ($productInGroup as $pID) {
                    if ((int) $pID) {
                        $arrDataGroup[$pID] = new ShopProductGroup(['product_id' => $pID]);
                    }
                }
                $product->groups()->saveMany($arrDataGroup);
            }

        }

        //Update Build
        if ($product['kind'] == SC_PRODUCT_BUILD) {
            $product->builds()->delete();
            if (count($productBuild)) {
                $arrDataBuild = [];
                foreach ($productBuild as $key => $pID) {
                    if ((int) $pID) {
                        $arrDataBuild[$pID] = new ShopProductBuild(['product_id' => $pID, 'quantity' => $productBuildQty[$key]]);
                    }
                }
                $product->builds()->saveMany($arrDataBuild);
            }

        }

        //Update attribute

         if ($product['kind'] == SC_PRODUCT_SINGLE) {
            $product->attributes()->delete();
            if (count($attribute)) {
                $arrDataAtt = [];
                foreach ($attribute as $group => $rowGroup) {

                  if (count($rowGroup)) {
                        foreach ($rowGroup as $key => $nameAtt) {                     
                            if ($nameAtt) {
                                $arrDataAtt[] = new ShopProductAttribute(['name' => $nameAtt, 'attribute_group_id' => $group, 'price' => $priceattr[$group][$key]]);
                            }
                        }
                    }

                }
              
                $product->attributes()->saveMany($arrDataAtt);
            }

        }

        $imgexist=  $data['addmore'];
       $newimage=  $data['newimage'];    


       if($imgexist==1)
       {
        $imageid =  count($data['imageid']);
        for($i=0; $i<$imageid; $i++) {
            $blogimg = ShopProductImage::find($data['imageid'][$i]);           
            
               $dataImage = [
                        'image' => $data['sub_image'][$i],                    
                        'imagealt' => $data['imagealt'][$i]       
                    ];

                $blogimg->update($dataImage);
            }
       }
        
        if($newimage==1)  
        {
            $newimg =  count($data['newimg']);
            for($j=0; $j<$newimg; $j++) {                    
                    
               $datanImage = [
                        'image' => $data['new_image'][$j], 
                        'imagealt' => $data['nimagealt'][$j],                  
                        'product_id' => $id                    
                    ];

               ShopProductImage::create($datanImage);
                } 
        }

       /* //Update sub mages  
        if ($subImages && in_array($product['kind'], [SC_PRODUCT_SINGLE, SC_PRODUCT_BUILD])) {
            $product->images()->delete();
            $arrSubImages = [];
            foreach ($subImages as $key => $image) {
                if ($image) {
                    $arrSubImages[] = new ShopProductImage(['image' => $image]);
                }
            }
            $product->images()->saveMany($arrSubImages);
        }
*/
//
        return redirect()->route('admin_product.index')->with('success', trans('product.admin.edit_success'));

    }

/*
Delete list Item
Need mothod destroy to boot deleting in model
 */
    public function deleteList()
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            $arrCantDelete = [];
            foreach ($arrID as $key => $id) {
                if (ShopProductBuild::where('product_id', $id)->first() || ShopProductGroup::where('product_id', $id)->first()) {
                    $arrCantDelete[] = $id;}
            }
            if (count($arrCantDelete)) {
                return response()->json(['error' => 1, 'msg' => trans('product.admin.cant_remove_child') . ': ' . json_encode($arrCantDelete)]);
            } else {
                ShopProduct::destroy($arrID);
                return response()->json(['error' => 0, 'msg' => '']);
            }

        }
    }

     public function getloc()
    {
        
        $locals = ShopProduct::getLocalidads($_POST['prov']);
        echo '<option value="">Choose state</option>';
        foreach($locals as $local) { ?>
            <option value="<?php echo $local->id; ?>" ><?php echo $local->name; ?>
            </option>
        <?php } 
    }

     public function getsubloc()
    {
        
        $subloc = ShopProduct::getSubloc($_POST['loc']);
        echo '<option value="">Choose location</option>';
        foreach($subloc as $local) { ?>
            <option value="<?php echo $local->id; ?>" ><?php echo $local->name; ?>
            </option>
        <?php } 
    }

     public function getprotype()
    {
        
        $types = ProCat::getProcats($_POST['type']);
        echo '<option value="">Choose category</option>';
        foreach($types as $type) { ?>

            <option value="<?php echo $type->id; ?>" ><?php echo $type->name; ?>
            </option>
        <?php } 
    }

    public function deleteImg()
    {
        ShopProductImage::destroy($_POST['imgid']);
    }

}
