<?php
	
	namespace App\Admin\Controllers;
	
	use App\Http\Controllers\Controller;
	use App\Models\ShopLanguage;
	use App\Models\ShippingMethods;
	use App\Models\ShopNewsDescription;
	use Illuminate\Http\Request;
	use Validator;
	
	class ShopMethodController extends Controller
	{
		public $languages;
		
		public function __construct()
		{
			$this->languages = ShopLanguage::getList();
			
		}
		
		public function index()
		{
			$data = [
            'title' => 'Shipping Methods',
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
            'id' => trans('order_status.admin.id'),
            'name' => trans('order_status.admin.name'),
            'action' => trans('order_status.admin.action'),
			];
			$obj = new ShippingMethods;
			$obj = $obj->orderBy('id', 'desc');
			$dataTmp = $obj->paginate(20);
			
			$dataTr = [];
			foreach ($dataTmp as $key => $row) {
				$dataTr[] = [
                'id' => $row['id'],
                'name' => $row['title'] ?? 'N/A',
                'action' => '
				<a href="' . route('admin_shipping_methods.edit', ['id' => $row['id']]) . '"><span title="' . trans('admin_shipping_methods.admin.edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;
				
				<span onclick="deleteItem(' . $row['id'] . ');"  title="Delete" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></span>
				',
				];
			}
			
			$data['listTh'] = $listTh;
			$data['dataTr'] = $dataTr;
			$data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
			$data['result_items'] = trans('order_status.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);
			
			//menu_left
			$data['menu_left'] = '<div class="pull-left">
			<a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> Refresh</span></a> &nbsp;
			</div>';
			//=menu_left
			
			//menu_right
			$data['menu_right'] = '<div class="btn-group pull-right" style="margin-right: 10px">
			<a href="' . route('admin_shipping_methods.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
			<i class="fa fa-plus"></i><span class="hidden-xs">Add New</span>
			</a>
			</div>';
			//=menu_right
			
			$data['url_delete_item'] = route('admin_shipping_methods.delete');
			
			return view('admin.screen.ordermethods')
            ->with($data);
		}
		
		/**
			* Form create new order in admin
			* @return [type] [description]
		*/
		public function create()
		{
			$shopNews = [];
			$data = [
            'title' => 'Create a new shipping method',
            'sub_title' => '',
            'title_description' => 'Create a new shipping method',
            'icon' => 'fa fa-plus',
            'languages' => $this->languages,
            'shopNews' => $shopNews,
            'url_action' => route('admin_shipping_methods.create'),
			
			];
			
			return view('admin.screen.shipping_methods')
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
				return redirect()->back()
                ->withErrors($validator)
                ->withInput();
			}
			$dataInsert = [
            'title' => $data['name'],
			];
			ShippingMethods::create($dataInsert);
			//
			return redirect()->route('admin_shipping_methods.index')->with('success', trans('admin_shipping_status.admin.create_success'));
		}
		
		
		/**
			* Form edit
		*/
		public function edit($id)
		{
			$obj = ShippingMethods::find($id);
			if ($obj === null) {
				return 'no data';
			}
			$data = [
            'title' => 'Edit shipping method',
            'sub_title' => '',
            'title_description' => 'Edit shipping method',
            'icon' => 'fa fa-pencil-square-o',
            'obj' => $obj,
            'url_action' => route('admin_shipping_methods.edit', ['id' => $obj['id']]),
			];
			return view('admin.screen.shipping_methods')
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
			$obj = ShippingMethods::find($id);
			$obj->update($dataUpdate);
			//
			return redirect()->route('admin_shipping_methods.index')->with('success', trans('admin_shipping_methods.admin.edit_success'));
			
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
				ShippingMethods::destroy($arrID);
				return response()->json(['error' => 0, 'msg' => '']);
			}
		}
		
		
	}
