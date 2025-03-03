<?php
#app/Http/Admin/Controllers/ShopBrandController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Localidad;
use App\Models\Branch;
use App\Models\ShopProduct;
use Illuminate\Http\Request;
use Validator;

class BranchController extends Controller
{

    public function index()
    {
       

        $data = [
            'title' => 'Branches',
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
            'country' => trans('country'),
            'state' => trans('state'),
            'sort' => trans('sort'),
            'status' => trans('status'),
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
        $obj = new Branch;
        if ($keyword) {
            $obj = $obj->whereRaw('(name like "%' . $keyword . '%" )');
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
                'country' => $prov->name,
                'state' => $state->name,
                'sort' => $row['sort'],
                'status' => $row['status'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>',
                'action' => '
                    <a href="' . route('admin_branch.edit', ['id' => $row['id']]) . '"><span title="' . trans('edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;

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
                           <a href="' . route('admin_branch.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
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
      var url = '" . route('admin_branch.index') . "?sort_order='+$('#order_sort option:selected').val();
      $.pjax({url: url, container: '#pjax-container'})
    });";

//=menu_sort

//menu_search

        $data['menu_search'] = '
                <form action="' . route('admin_branch.index') . '" id="button_search">
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

        $data['url_delete_item'] = route('admin_branch.delete');

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

        $data = [
            'title' => 'Add new Branch',
            'sub_title' => '',
            'title_description' => 'Create Branch',
            'icon' => 'fa fa-plus',
            'branch' => [],
            'states' => [],
            'subloc' => [],
            'url_action' => route('admin_branch.create'),
            'provi' => $provi,
        ];
        return view('admin.screen.branch')
            ->with($data);
    }

/**
 * Post create new order in admin
 * @return [type] [description]
 */
    public function postCreate()
    {
        $data = request()->all();

        $data['alias'] = !empty($data['alias'])?$data['alias']:$data['name'];
        $data['alias'] = sc_word_format_url($data['alias']);
        $data['alias'] = sc_word_limit($data['alias'], 100);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:branch,email',
            'location' => 'required',
            'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:branch,alias|string|max:100',
            'sort' => 'numeric|min:0',
            'provincia' => 'required',
            'localidad' => 'required',
            'url' => 'url|nullable',
        ],[
            'name.required' => trans('validation.required', ['attribute' => trans('branch')]),
            'alias.regex' => trans('localidad.alias_validate'),
            'provincia.required' => 'The country field is required.',
            'localidad.required' => 'The state field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }
        $dataInsert = [
            'name' => $data['name'],
            'description' => $data['description'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'street1' => $data['street1'],
            'street2' => $data['street2'],
            'street3' => $data['street3'],
            'fax' => $data['fax'],
            'alias' => $data['alias'],
            'provincia' => $data['provincia'],
            'state' => $data['localidad'],
            'location' => $data['location'],
            'url' => $data['url'],
            'sort' => (int) $data['sort'],
            'status' => (!empty($data['status']) ? 1 : 0),
        ];
        Branch::create($dataInsert);

        return redirect()->route('admin_branch.index')->with('success', trans('Branch created successfully!'));

    }

/**
 * Form edit
 */
    public function edit($id)
    {
        $provi =  Localidad::getProvincia();
        

        $branch = Branch::find($id);
        $states =  ShopProduct::getLocalidads($branch->provincia);
        $subloc =  ShopProduct::getSubloc($branch->state);
        if ($branch === null) {
            return 'no data';
        }
        $data = [
            'title' => 'Edit sub location',
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'branch' => $branch,
            'url_action' => route('admin_branch.edit', ['id' => $branch['id']]),
            'provi' => $provi,
            'states' => $states,
            'subloc' => $subloc,
        ];
        return view('admin.screen.branch')
            ->with($data);
    }

/**
 * update status
 */
    public function postEdit($id)
    {
        $branch = Branch::find($id);
        $data = request()->all();
        $data['alias'] = !empty($data['alias'])?$data['alias']:$data['name'];
        $data['alias'] = sc_word_format_url($data['alias']);
        $data['alias'] = sc_word_limit($data['alias'], 100);

        $validator = Validator::make($data, [
            'name' => 'required|string|max:100',
            'provincia' => 'required',
            'localidad' => 'required',
            'email' => 'required|email|unique:branch,email,' . $branch->id . ',id',
            'location' => 'required',
            'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:branch,alias,' . $branch->id . ',id|string|max:100',
            'sort' => 'numeric|min:0',
        ], [
            'name.required' => trans('validation.required', ['attribute' => trans('location')]),
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

        $dataUpdate = [
            'name' => $data['name'],
            'description' => $data['description'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'street1' => $data['street1'],
            'street2' => $data['street2'],
            'street3' => $data['street3'],
            'fax' => $data['fax'],
            'alias' => $data['alias'],
            'url' => $data['url'],
            'provincia' => $data['provincia'],
            'state' => $data['localidad'],
            'location' => $data['location'],
            'sort' => (int) $data['sort'],
            'status' => (!empty($data['status']) ? 1 : 0),

        ];

        $branch->update($dataUpdate);

//
        return redirect()->route('admin_branch.index')->with('success', trans('Branch updated successfully!'));

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
            Branch::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

}
