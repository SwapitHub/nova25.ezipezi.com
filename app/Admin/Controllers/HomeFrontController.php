<?php
	#app/Http/Admin/Controllers/ShopBrandController.php
	namespace App\Admin\Controllers;
	
	use App\Http\Controllers\Controller;
	use App\Models\HomeFront;
	use Illuminate\Http\Request;
	use Validator;
	
	class HomeFrontController extends Controller
	{
		
		public function index()
		{
			
			$data = [
            'title' => 'Homepage Content',
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
            //'sort' => trans('sort'),
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
			$obj = new HomeFront;
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
				$dataTr[] = [
                'id' => $row['id'],
				
                
                //'sort' => $row['sort'],
                'status' => $row['status'] ? '<span class="label label-success">ON</span>' : '<span class="label label-danger">OFF</span>',
                'action' => '
				<a href="' . route('admin_homecontent.edit', ['id' => $row['id']]) . '"><span title="' . trans('edit') . '" type="button" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></span></a>&nbsp;
				
				',
				];
			}
			
			$data['listTh'] = $listTh;
			$data['dataTr'] = $dataTr;
			$data['pagination'] = $dataTmp->appends(request()->except(['_token', '_pjax']))->links('admin.component.pagination');
			$data['result_items'] = trans('log.admin.result_item', ['item_from' => $dataTmp->firstItem(), 'item_to' => $dataTmp->lastItem(), 'item_total' => $dataTmp->total()]);
			
			//menu_left
			/* $data['menu_left'] = '<div class="pull-left">
				<a class="btn   btn-flat btn-primary grid-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs"> ' . trans('refresh') . '</span></a> &nbsp;
			</div>';*/
			//=menu_left
			
			//menu_right
			/*    $data['menu_right'] = '<div class="btn-group pull-right" style="margin-right: 10px">
				<a href="' . route('admin_homecontent.create') . '" class="btn  btn-success  btn-flat" title="New" id="button_create_new">
				<i class="fa fa-plus"></i><span class="hidden-xs">' . trans('add_new') . '</span>
				</a>
			</div>';*/
			//=menu_right
			
			//menu_sort
			
			$optionSort = '';
			foreach ($arrSort as $key => $status) {
				$optionSort .= '<option  ' . (($sort_order == $key) ? "selected" : "") . ' value="' . $key . '">' . $status . '</option>';
			}
			
			/*      $data['menu_sort'] = '
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
			</div>';*/
			
			$data['script_sort'] = "$('#button_sort').click(function(event) {
			var url = '" . route('admin_homecontent.index') . "?sort_order='+$('#order_sort option:selected').val();
			$.pjax({url: url, container: '#pjax-container'})
			});";
			
			//=menu_sort
			
			//menu_search
			
			/*  $data['menu_search'] = '
                <form action="' . route('admin_homecontent.index') . '" id="button_search">
				<div onclick="$(this).submit();" class="btn-group pull-right">
				<a class="btn btn-flat btn-primary" title="Refresh">
				<i class="fa  fa-search"></i><span class="hidden-xs"> ' . trans('admin.search') . '</span>
				</a>
				</div>
				<div class="btn-group pull-right">
				<div class="form-group">
				<input type="text" name="keyword" class="form-control" placeholder="' . trans('search_place') . '" value="' . $keyword . '">
				</div>
				</div>
			</form>';*/
			//=menu_search
			
			$data['url_delete_item'] = route('admin_homecontent.delete');
			
			return view('admin.screen.list')
            ->with($data);
		}
		
		/**
			* Form create new order in admin
			* @return [type] [description]
		*/
		public function create()
		{
			$data = [
            'title' => 'Create Homepage Content',
            'sub_title' => '',
            'title_description' => 'Add Homepage Content',
            'icon' => 'fa fa-plus',
            'homefront' => [],
            'url_action' => route('admin_homecontent.create'),
			];
			return view('admin.screen.homefront')
            ->with($data);
		}
		
		/**
			* Post create new order in admin
			* @return [type] [description]
		*/
		public function postCreate()
		{
			$data = request()->all();
			
			$data['alias'] = !empty($data['alias'])?$data['alias']:'home-content';
			$data['alias'] = sc_word_format_url($data['alias']);
			$data['alias'] = sc_word_limit($data['alias'], 100);
			
			$validator = Validator::make($data, [
            'aboutus_img1' => 'required',
            'aboutus_img2' => 'required',
            'aboutus' => 'required',
            'savejob_bg' => 'required',
            'savejob' => 'required',
            'gallary_img1' => 'required',
            'gallary_img2' => 'required',
            'gallary_img3' => 'required',
            'gallary_img4' => 'required',
            'gallary_img5' => 'required',
            'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:test_title,alias|string|max:100',
            'sort' => 'numeric|min:0',
            'url' => 'url|nullable',
			],[
            //'name.required' => trans('validation.required', ['attribute' => trans('name')]),
            'alias.regex' => trans('admin.alias_validate'),
			]);
			
			if ($validator->fails()) {
				return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
			}
			$dataInsert = [         
            'aboutus_img1' => $data['aboutus_img1'],
            'aboutus_img2' => $data['aboutus_img2'],
            'aboutus' => $data['aboutus'],
            'savejob_bg' => $data['savejob_bg'],
            'savejob' => $data['savejob'],
            'gallary_img1' => $data['gallary_img1'],
            'gallary_img2' => $data['gallary_img2'],
            'gallary_img3' => $data['gallary_img3'],
            'gallary_img4' => $data['gallary_img4'],
            'gallary_img5' => $data['gallary_img5'],
            'alias' => $data['alias'],
            'url' => $data['url'],
            'sort' => (int) $data['sort'],
            'status' => (!empty($data['status']) ? 1 : 0),
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
			HomeFront::create($dataInsert);
			
			return redirect()->route('admin_homecontent.index')->with('success', trans('Homepage Content added successfully!'));
			
		}
		
		/**
			* Form edit
		*/
		public function edit($id)
		{
			$homefront = HomeFront::find($id);
			if ($homefront === null) {
				return 'no data';
			}
			$data = [
            'title' => 'Homepage Content edit',
            'sub_title' => '',
            'title_description' => '',
            'icon' => 'fa fa-pencil-square-o',
            'homefront' => $homefront,
            'url_action' => route('admin_homecontent.edit', ['id' => $homefront['id']]),
			];
			return view('admin.screen.homefront')
            ->with($data);
		}
		
		/**
			* update status
		*/
		public function postEdit($id)
		{
			$homefront = HomeFront::find($id);
			$data = request()->all();
			
			$data['alias'] = !empty($data['alias'])?$data['alias']:'home-content';
			$data['alias'] = sc_word_format_url($data['alias']);
			$data['alias'] = sc_word_limit($data['alias'], 100);
			
			$validator = Validator::make($data, [
            'aboutus_img1' => 'required',
            'aboutus_img2' => 'required',
            'aboutus' => 'required',
            'savejob_bg' => 'required',
            'savejob' => 'required',
            'gallary_img1' => 'required',
            'gallary_img2' => 'required',
            'gallary_img3' => 'required',
            'gallary_img4' => 'required',
            'gallary_img5' => 'required',
            'alias' => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:home_content,alias,' . $homefront->id . ',id|string|max:100',
            'sort' => 'numeric|min:0',
			], [
            //'name.required' => trans('validation.required', ['attribute' => trans('name')]),
            'alias.regex' => trans('admin.alias_validate'),
			]);
			
			if ($validator->fails()) {
				return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
			}
			//Edit
			
			$dataUpdate = [
			'aboutus_img1' => $data['aboutus_img1'],
			'aboutus_img1_alt' => $data['aboutus_img1_alt'],
            'aboutus_img2' => $data['aboutus_img2'],
            'aboutus_img2_alt' => $data['aboutus_img2_alt'],
            'aboutus' => $data['aboutus'],
            'savejob_bg' => $data['savejob_bg'],
            'savejob' => $data['savejob'],
            'gallary_img1' => $data['gallary_img1'],
            'gallary_img1_alt' => $data['gallary_img1_alt'],
            'gallary_img2' => $data['gallary_img2'],
            'gallary_img2_alt' => $data['gallary_img2_alt'],
            'gallary_img3' => $data['gallary_img3'],
            'gallary_img3_alt' => $data['gallary_img3_alt'],
            'gallary_img4' => $data['gallary_img4'],
            'gallary_img4_alt' => $data['gallary_img4_alt'],
            'gallary_img5' => $data['gallary_img5'],
            'gallary_img5_alt' => $data['gallary_img5_alt'],
            'alias' => $data['alias'],
            'url' => $data['url'],
            'sort' => (int) $data['sort'],
            'status' => (!empty($data['status']) ? 1 : 0),
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
			
			$homefront->update($dataUpdate);
			
			//
			return redirect()->route('admin_homecontent.index')->with('success', trans('Homepage Content updated successfully!'));
			
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
				TestTitle::destroy($arrID);
				return response()->json(['error' => 0, 'msg' => '']);
			}
		}
		
	}
