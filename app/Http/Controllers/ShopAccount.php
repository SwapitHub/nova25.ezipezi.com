<?php
#app/Http/Controller/ShopAccount.php
namespace App\Http\Controllers;

use App\Models\ShopCountry;
use App\Models\ShopOrder;
use App\Models\ShopOrderStatus;
use App\Models\ShopUser;
use App\Models\States;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShopAccount extends GeneralController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Index user profile
     *
     * @return  [type]  [return description]
     */
    public function index()
    {
        $user = Auth::user();
        return view($this->templatePath . '.account.index')
            ->with(
                [
                'title' => trans('account.my_profile'),
                'user' => $user,
                'layout_page' => 'shop_profile',
                ]
            );
    }

    /**
     * Form Change password
     *
     * @return  [type]  [return description]
     */
    public function changePassword()
    {
        $user = Auth::user();
        $id = $user->id;
        return view($this->templatePath . '.account.change_password')
        ->with(
            [
                'title' => trans('account.change_password'),
                'user' => $user,
                'layout_page' => 'shop_profile',
            ]
        );
    }

    /**
     * Post change password
     *
     * @param   Request  $request  [$request description]
     *
     * @return  [type]             [return description]
     */
    public function postChangePassword(Request $request)
    {
        $user = Auth::user();

        $id = $user->id;
        $dataUser = ShopUser::find($id);
        $password = $request->get('password');
        $password_old = $request->get('password_old');
        if (trim($password_old) == '') {
            return redirect()->back()
                ->with(
                    [
                        'password_old_error' => trans('account.password_old_required')
                    ]
                );
        } else {
            if (!\Hash::check($password_old, $dataUser->password)) {
                return redirect()->back()
                    ->with(
                        [
                            'password_old_error' => trans('account.password_old_notcorrect')
                        ]
                    );
            }
        }
        $messages = [
            'required' => trans('validation.required'),
        ];
        $v = Validator::make(
            $request->all(), 
            [
                'password_old' => 'required',
                'password' => 'required|string|min:6|confirmed',
            ],
            $messages
        );
        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }

        ShopUser::updateInfo(['password' => bcrypt($password)], $id);

        return redirect()->route('member.index')
            ->with(['message' => trans('account.update_success')]);
    }

    /**
     * Form change info
     *
     * @return  [type]  [return description]
     */
    public function changeInfomation()
    {
        $user = Auth::user();
        $id = $user->id;

        $dataUser = ShopUser::find($id);
        $states = (new States)->getStatesId($dataUser->country);
        $bstates = (new States)->getStatesId($dataUser->bcountry);
        return view($this->templatePath . '.account.change_infomation')
            ->with(
                [
                    'title' => trans('account.change_infomation'),
                    'dataUser' => $dataUser,
                    'layout_page' => 'shop_profile',
                    'countries' => ShopCountry::getArray(),
                    'states' => $states,
                    'bstates' => $bstates,
                ]
            );
    }

    /**
     * Process update info
     *
     * @param   Request  $request  [$request description]
     *
     * @return  [type]             [return description]
     */
    public function postChangeInfomation(Request $request)  
    {
        

        $user = Auth::user();  
        $id = $user->id;
        $data = request()->all();

         $validator = Validator::make($data, [
            'reg_first_name' => 'required|string|max:100',
            'reg_last_name' => 'required|string|max:100',
            'reg_address1' => 'required|string|max:255',
            'reg_postcode' => 'nullable|min:4',
            'reg_company' =>  'nullable',
            'reg_phone' =>  'required',
            'business_phone' =>  'required', 
            'reg_email' => 'required|string|email|max:255|unique:' . (new ShopUser)->getTable() . ',email,'. $id
        ]);

         $dataUpdate = [
            'first_name' => $data['reg_first_name'],
            'last_name' => $data['reg_last_name']??'',
            'email' => $data['reg_email'],
            'initials' => $data['initials'],
            'salutation' => $data['salutation'],
            'idtype' => $data['idtype'],
            'idnumber' => $data['idnumber'],
            'breg_postcode' => $data['breg_postcode'],
            'breg_address1' => $data['breg_address1'],
            'breg_address2' => $data['breg_address2'],
            'company' => $data['reg_company'],
            'companyreg' => $data['companyreg'],
            'companyvat' => $data['companyvat'],
            'suburb' => $data['suburb'],
            'bsuburb' => $data['bsuburb'],
            'city' => $data['city'],
            'bcity' => $data['bcity'],
            'province' => $data['province']??null,
            'bprovince' => $data['bprovince']??null,
            'business_phone' => $data['business_phone'],
            'cell_phone' => $data['cell_phone'],
            'skype' => $data['skype'],
            'phone' => $data['reg_phone']??null,
            'address1' => $data['reg_address1'],
            'address2' => $data['reg_address2']??'',
            'country' => $data['reg_country']??'VN',
            'bcountry' => $data['bcountry'],
            'group' => $data['reg_group']??1,
            'sex' => $data['reg_sex']??0,
            'postcode' => $data['reg_postcode']??null,
        ];      

       
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);  
        }

        ShopUser::updateInfo($dataUpdate, $id);

        return redirect()->route('member.index')
            ->with(['message' => trans('account.update_success')]);
    }

    /**
     * Render order list
     * @return [type] [description]
     */
    public function orderList()
    {
        $user = Auth::user();
        $id = $user->id;
        $orders = ShopOrder::with('orderTotal')->where('user_id', $id)->sort()->get();
        $statusOrder = ShopOrderStatus::pluck('name', 'id')->all();
        return view($this->templatePath . '.account.order_list')
            ->with(
                [
                'title' => trans('account.order_list'),
                'user' => $user,
                'orders' => $orders,
                'statusOrder' => $statusOrder,
                'layout_page' => 'shop_profile',
                ]
            );
    }

    public function favouriteList()
    {
        $user = Auth::user();
        $id = $user->id;
        $favlist = Wishlist::where('user_id', $id)->get(); 
        
        return view($this->templatePath . '.account.favourite_list')
            ->with(
                [
                'title' => 'Favourite List',
                'user' => $user,
                'favlist' => $favlist,
                'layout_page' => 'shop_profile',
                ]
            );
    }

}
