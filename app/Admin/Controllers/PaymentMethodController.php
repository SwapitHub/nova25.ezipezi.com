<?php
#app/Http/Admin/Controllers/ShopPaymentStatusController.php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PaymentModel;
use Illuminate\Http\Request;
use Validator;

class PaymentMethodController extends Controller
{

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {

        $data = [
            'title' => 'Payment method list',
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
            'id' => trans('payment_status.admin.id'),
            'name' => trans('payment_status.admin.name'),
            'action' => trans('payment_status.admin.action'),
        ];
        $objOrder = new PaymentModel;
        $objOrder = $objOrder->orderBy('id', 'desc');
        $dataTmp = $objOrder->paginate(20);

        $dataTr = [];
        foreach ($dataTmp as $key => $row) {
            $dataTr[] = [
                'id' => $row['id'],
                'name' => $row['title'] ?? 'N/A',
                'action' => '
                    <a href="' . route('admin_payment_method.edit', ['id' => $row['id']]) . '"><span title="' . trans('payment_status.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;

                  <span onclick="deleteItem(' . $row['id'] . ');"  title="Delete" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
                  ',
            ];
        }

        $data['listTh'] = $listTh;
        $data['dataTr'] = $dataTr;
        $data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
        $data['result_items'] = trans('payment_status.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);

//menu_left
        $data['menu_left'] = '<div class="pull-left">
                      <a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('payment_status.admin.refresh') . '</span></a> &nbsp;
                      </div>';
//=menu_left

//menu_right
        $data['menu_right'] = '<div class="btn-group pull-right" style="margin-right: 10px">
                           <a href="' . route('admin_payment_method.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
                           <i class="fa fa-plus"></i><span class="hidden-xs">' . trans('payment_status.admin.add_new') . '</span>
                           </a>
                        </div>';
//=menu_right

        $data['url_delete_item'] = route('admin_payment_method.delete');

        return view('admin.screen.payment_method_list')
            ->with($data);
    }

/**
 * Form create new order in admin
 * @return [type] [description]
 */
    public function create()
    {
        $data = [
            'title' => 'Create a new payment method',
            'sub_title' => '',
            'title_description' => 'Create a new payment method',
            'icon' => 'fa fa-plus',
            'obj' => [],
            'url_action' => route('admin_payment_method.create'),
        ];
        return view('admin.screen.payment_method')
            ->with($data);
    }

/**
 * Post create new order in admin
 * @return [type] [description]
 */
    public function postCreate()
    {
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'name' => 'required',
        ], [
            'name.required' => trans('validation.required'),
        ]);

        if ($validator->fails()) {
            // dd($validator->messages());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $dataInsert = [
            'title' => $data['name'],
        ];
        PaymentModel::create($dataInsert);
//
        return redirect()->route('admin_payment_method.index')->with('success', trans('admin_payment_method.admin.create_success'));

    }

/**
 * Form edit
 */
    public function edit($id)
    {
        $obj = PaymentModel::find($id);
        if ($obj === null) {
            return 'no data';
        }
        $data = [
            'title' => 'Edit Payment Method',
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'obj' => $obj,
            'url_action' => route('admin_payment_method.edit', ['id' => $obj['id']]),
        ];
        return view('admin.screen.payment_method')
            ->with($data);
    }

/**
 * update status
 */
    public function postEdit($id)
    {
        $data = request()->all();
        $dataOrigin = request()->all();
        $validator = Validator::make($dataOrigin, [
            'name' => 'required',
        ], [
            'name.required' => trans('validation.required'),
        ]);

        if ($validator->fails()) {
            // dd($validator->messages());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
//Edit
        $dataUpdate = [
            'title' => $data['name'],
        ];
        $obj = PaymentModel::find($id);
        $obj->update($dataUpdate);
//
        return redirect()->route('admin_payment_method.index')->with('success', 'method updated');

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
            PaymentModel::destroy($arrID);
            return response()->json(['error' => 0, 'msg' => '']);
        }
    }

}
