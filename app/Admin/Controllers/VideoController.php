<?php
#app/Http/Admin/Controllers/ShopBrandController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Localidad;
use App\Models\Portfolio;
use App\Models\Video;
use App\Models\PortfolioImages;
use App\Models\GallaryVideos;
use App\Models\VideoType;
use App\Models\Branch;
use App\Admin\Admin;
use App\Models\VideotagType;
use App\Models\ShopProduct;
use Illuminate\Http\Request;
use App\Admin\Models\AdminUser;
use Validator;

class VideoController extends Controller
{

    public function index()
    {
        $admin = Admin::user();

        $data = [
            'title' => 'Video',
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
            'id' => trans('id'),
            'name' => trans('name'),
            'Thumbnail' => trans('image'),
            'country' => trans('country'),
            'state' => trans('state'),
            'expire' => 'Expiry Date',
            'status' => trans('status'),
            'featured' => trans('featured'),
            'action' => trans('action'),
        ];

        $sort_order = request('sort_order') ?? 'id_desc';
        $keyword = request('keyword') ?? '';
        $arrSort = [
            'id__desc' => trans('id_desc'),
            'id__asc' => trans('id_asc'),
            'name__desc' => trans('name_desc'),
            'name__asc' => trans('name_asc'),
        ];
        $obj = new Video;
        if ($keyword) {
            $obj = $obj->whereRaw('(name like "%' . $keyword . '%" )');
        }
        if ($admin->role != 1) {
            $obj = $obj->where('userid', $admin->id);
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
            $prov = Localidad::getSingleProvincia($row['provincia']);
            $state = Localidad::getSingleState($row['state']);
            $dataTr[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'thumbnail' => sc_image_render($row['image'], '50px'),
                'country' => $prov->name,
                'state' => $state->name,
                'expire' => $row['expire'],
                'status' => $row['status'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>',
                'featured' => $row['featured'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>',
                'action' => '
                    <a href="' . route('video.edit', ['id' => $row['id']]) . '"><span title="' . trans('edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;

                  <span onclick="deleteItem(' . $row['id'] . ');"  title="' . trans('delete') . '" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
                  ',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('log.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);

        //menu_left
        $data['menu_left'] = '<div class="pull-left">
                      <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('refresh') . '</span></a> &nbsp;
                      </div>';
        //=menu_left

        //menu_right
        $data['menu_right'] = '<div class="btn-group pull-right" style="margin-right: 10px">
                           <a href="' . route('video.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus"></i><span class="hidden-xs">' . trans('add_new') . '</span>
                           </a>
                        </div>';
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
      var url = '" . route('video.index') . "?sort_order='+$('#order_sort option:selected').val();
      $.pjax({url: url, container: '#pjax-container'})
    });";

        //=menu_sort

        //menu_search

        $data['menu_search'] = '
                <form action="' . route('video.index') . '" id="button_search">
                   <div onclick="$(this).submit();" class="btn-group pull-right">
                           <a class="btn btn-flat btn-primary" title="Refresh">
                              <i class="fa  fa-search"></i><span class="hidden-xs"> ' . trans('admin.search') . '</span>
                           </a>
                   </div>
                   <div class="btn-group pull-right">
                         <div class="form-group">
                           <input type="text" name="keyword" class="form-control" placeholder="' . trans('search') . '" value="' . $keyword . '">
                         </div>
                   </div>
                </form>';
        //=menu_search

        $data['url_delete_item'] = route('video.delete');

        return view('admin.screen.list')
            ->with($data);
    }

    /**
     * Form create new order in admin
     * @return [type] [description]
     */
    public function create()
    {
        $provi =  Localidad::getProvincia();
        $portfoliotype = VideoType::GetVideoTypes();
        $branch = Branch::getBranches();
        $tagtype = VideotagType::GetVideotagTypes();
        $users =  AdminUser::GetAdminUsers();

        $data = [
            'title' => 'Add new Video',
            'sub_title' => '',
            'title_description' => 'Create Video',
            'icon' => 'fa fa-plus',
            'Video' => [],
            'states' => [],
            'subloc' => [],
            'url_action' => route('video.create'),
            'provi' => $provi,
            'videotype' => $portfoliotype,
            'branch' => $branch,
            'subImages' => [],
            'tagtype' => $tagtype,
            'users' => $users,

        ];
        return view('admin.screen.add_video')
            ->with($data);
    }

    /**
     * Post create new order in admin
     * @return [type] [description]
     */
    public function postCreate()
    {
        $data = request()->all();
        $admin = Admin::user();

        $data['alias'] = !empty($data['alias']) ? $data['alias'] : $data['name'];
        $data['alias'] = sc_word_format_url($data['alias']);
        $data['alias'] = sc_word_limit($data['alias'], 100);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:100',
            'location' => 'required',
            'image' => 'required',
            'videotype' => 'required',
            'branch' => 'required',
            'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:video,alias|string|max:100',
            'sort' => 'numeric|min:0',
            'provincia' => 'required',
            'localidad' => 'required',
            'expire' => 'required',
            'url' => 'url|nullable',
        ], [
            'name.required' => trans('validation.required', ['attribute' => trans('portfolio')]),
            'alias.regex' => trans('localidad.alias_validate'),
            'provincia.required' => 'The country field is required.',
            'localidad.required' => 'The state field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }

        if (!empty($data['tags'])) $tags =  implode(",", $data['tags']);
        else $tags = '';

        if (!empty($data['author'])) $author =  implode(",", $data['author']);
        else $author = '';

        $subImages = $data['sub_image'] ?? [];
        $dataInsert = [
            'name' => $data['name'],
            'content' => $data['content'],
            'embedcode' => $data['embedcode'],
            'userid' => $admin->id,
            'introduction' => $data['introduction'],
            'longitude' => $data['longitude'],
            'lattitude' => $data['lattitude'],
            'street1' => $data['street1'],
            'street2' => $data['street2'],
            'street3' => $data['street3'],
            'image' => $data['image'],
            'imagealt' => $data['image_alt'],
            'alias' => $data['alias'],
            'provincia' => $data['provincia'],
            'state' => $data['localidad'],
            'location' => $data['location'],
            'videotype' => $data['videotype'],
            'branch' => $data['branch'],
            'author' => $author,
            'tags' => $tags,
            'expire' => $data['expire'],
            'startdate' => $data['startdate'],
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
            'add_mainloc' => $data['add_mainloc'],
            'add_subloc' => $data['add_subloc'],
            'add_loc' => $data['add_loc'],
            'notes' => $data['notes'],
            'url' => $data['url'],
            'sort' => (int) $data['sort'],
            'status' => (!empty($data['status']) ? 1 : 0),
            'featured' => (!empty($data['featured']) ? 1 : 0),
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
            'tott' => !empty($data['tott']) ? 1 : 0,
            'aa' => !empty($data['aa']) ? 1 : 0,
            'faport' => !empty($data['faport']) ? 1 : 0,
            'portorder' => $data['portorder'],
            'blogorder' => $data['blogorder'],

        ];
        $blogid = Video::create($dataInsert);
      
        //Insert sub mages
        if ($subImages) {
            $alt = 0;
            foreach ($subImages as $key => $image) {
                if ($image) {
                    $dataImage = [
                        'video' => $image,
                        'videoalt' => $data['imagealt'][$alt],
                        'Video_id' => $blogid->id,
                    ];
                }
                GallaryVideos::create($dataImage);
                $alt++;
            }
        }

        return redirect()->route('video.index')->with('success', trans('Image Video created successfully!'));
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $provi =  Localidad::getProvincia();
        $portfoliotype = VideoType::GetVideoTypes();
        $branch = Branch::getBranches();
        $tagtype = VideotagType::GetVideotagTypes();
        $users =  AdminUser::GetAdminUsers();



        $portfolio = Video::find($id);
        $states =  ShopProduct::getLocalidads($portfolio->provincia);
        $add_subloc =  ShopProduct::getLocalidads($portfolio->add_subloc);
        $subloc =  ShopProduct::getSubloc($portfolio->state);
        $add_loc =  ShopProduct::getSubloc($portfolio->add_loc);
        $subImages = GallaryVideos::getImages($id);
        if ($portfolio === null) {
            return 'no data';
        }
        $data = [
            'title' => 'Edit Video',
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'video' => $portfolio,
            'url_action' => route('video.edit', ['id' => $portfolio['id']]),
            'provi' => $provi,
            'states' => $states,
            'subloc' => $subloc,
            'videotype' => $portfoliotype,
            'branch' => $branch,
            'subImages' => $subImages,
            'tagtype' => $tagtype,
            'users' => $users,
            'add_subloc' => $add_subloc,
            'add_loc' => $add_loc,
        ];
        return view('admin.screen.edit_video')
            ->with($data);
    }

    /**
     * update status
     */
    public function postEdit($id)
    {
        $portfolio = Video::find($id);
        $admin = Admin::user();
        $data = request()->all();
        $data['alias'] = !empty($data['alias']) ? $data['alias'] : $data['name'];
        $data['alias'] = sc_word_format_url($data['alias']);
        $data['alias'] = sc_word_limit($data['alias'], 100);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:100',
            'provincia' => 'required',
            'localidad' => 'required',
            'location' => 'required',
            'videotype' => 'required',
            'branch' => 'required',
            'expire' => 'required',
            'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:video,alias,' . $portfolio->id . ',id|string|max:100',
            'sort' => 'numeric|min:0',
        ], [
            'name.required' => trans('validation.required', ['attribute' => trans('portfolio')]),
            'alias.regex' => trans('localidad.alias_validate'),
            'provincia.required' => 'The country field is required.',
            'localidad.required' => 'The state field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }
        //Edit
        if (!empty($data['tags'])) $tags =  implode(",", $data['tags']);
        else $tags = '';

        if (!empty($data['author'])) $author =  implode(",", $data['author']);
        else $author = '';

        $dataUpdate = [
            'name' => $data['name'],
            'content' => $data['content'],
            'embedcode' => $data['embedcode'],
            'userid' => $admin->id,
            'introduction' => $data['introduction'],
            'longitude' => $data['longitude'],
            'lattitude' => $data['lattitude'],
            'street1' => $data['street1'],
            'street2' => $data['street2'],
            'street3' => $data['street3'],
            'image' => $data['image'],
            'imagealt' => $data['image_alt'],
            'alias' => $data['alias'],
            'provincia' => $data['provincia'],
            'state' => $data['localidad'],
            'location' => $data['location'],
            'sort' => (int) $data['sort'],
            'expire' => $data['expire'],
            'startdate' => $data['startdate'],
            'videotype' => $data['videotype'],
            'branch' => $data['branch'],
            'author' => $author,
            'tags' => $tags,
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
            'add_mainloc' => $data['add_mainloc'],
            'add_subloc' => $data['add_subloc'],
            'add_loc' => $data['add_loc'],
            'notes' => $data['notes'],
            'status' => (!empty($data['status']) ? 1 : 0),
            'featured' => (!empty($data['featured']) ? 1 : 0),
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
            'tott' => !empty($data['tott']) ? 1 : 0,
            'aa' => !empty($data['aa']) ? 1 : 0,
            'portorder' => $data['portorder'],
            'blogorder' => $data['blogorder'],
        ];

        $portfolio->update($dataUpdate);



        $imgexist =  $data['addmore'];
        $newimage =  $data['newimage'];


        if ($imgexist == 1) {
            $imageid =  count($data['imageid']);
            for ($i = 0; $i < $imageid; $i++) {
                $blogimg = GallaryVideos::find($data['imageid'][$i]);

                $dataImage = [
                    'video' => $data['sub_image'][$i],
                    'videoalt' => $data['imagealt'][$i]
                ];

                $blogimg->update($dataImage);
            }
        }

        if ($newimage == 1) {
            $newimg =  count($data['newimg']);
            for ($j = 0; $j < $newimg; $j++) {

                $datanImage = [
                    'video' => $data['new_image'][$j],
                    'videoalt' => $data['nimagealt'][$j],
                    'Video_id' => $id
                ];

                GallaryVideos::create($datanImage);
            }
        }



        return redirect()->route('video.index')->with('success', trans('Image Video updated successfully!'));
    }

    /*
Delete list item
Need mothod destroy to boot deleting in model
 */
    public function deleteList()
    {
        if (!request()->ajax()) {
            return response()->json(['error' => 1, 'msg' => 'Method not allow!']);
        } else {
            $ids = request('ids');
            $arrID = explode(',', $ids);
            Video::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

    public function deleteImg()
    {
        GallaryVideos::destroy($_POST['imgid']);
    }
}
