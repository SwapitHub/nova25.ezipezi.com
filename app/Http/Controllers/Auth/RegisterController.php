<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\GeneralController;
use App\Models\ShopEmailTemplate;
use App\Models\ShopUser;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends GeneralController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validate = [
            'reg_first_name' => 'required|string|max:100',
            'reg_last_name' => 'required|string|max:100',
            'reg_email' => 'required|string|email|max:255|unique:' . (new ShopUser)->getTable() . ',email',
            'username' => 'required|regex:/(^([0-9A-Za-z@\._]+)$)/|unique:' . (new ShopUser)->getTable() . ',username|string|max:100|min:3',            
            'reg_password' => 'required|string|min:6|confirmed',
            'reg_address1' => 'required|string|max:255',
            'reg_postcode' => 'nullable|min:4',
            'reg_company' =>  'nullable',
            'reg_phone' =>  'required',
            //'business_phone' =>  'required',
        ];
        
        /*if(sc_config('customer_address2')) {
            $validate['reg_address2'] = 'required|max:100';
        }*/
        
        if(sc_config('customer_country')) {
            $validate['reg_country'] = 'required|min:2';
        }        
        
         
        if(sc_config('customer_sex')) {
            $validate['reg_sex'] = 'required';
        }   
        if(sc_config('customer_birthday')) {
            $validate['reg_birthday'] = 'nullable|date|date_format:Y-m-d';
        } 
        if(sc_config('customer_group')) {
            $validate['reg_group'] = 'nullable';
        }  
        return Validator::make($data, $validate);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\ShopUser
     */
    protected function create(array $data)
    {
        if(!empty($data['province'])) $province = $data['province'] ;  
        else $province = 0;

        if(!empty($data['bprovince'])) $bprovince = $data['bprovince'];  
        else $bprovince = 0;


        $dataMap = [
            'first_name' => $data['reg_first_name'],
            'last_name' => $data['reg_last_name']??'',
            'email' => $data['reg_email'],
            'username' => $data['username'],
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
            'province' => $province,
            'bprovince' => $bprovince,
            'business_phone' => $data['business_phone'],
            'cell_phone' => $data['cell_phone'],
            'skype' => $data['skype'],
            'password' => bcrypt($data['reg_password']),
            'phone' => $data['reg_phone']??null,
            'address1' => $data['reg_address1'],
            'address2' => $data['reg_address2']??'',
            'country' => $data['reg_country']??'VN',
            'bcountry' => $data['bcountry'],
            'group' => $data['reg_group']??1,
            'sex' => $data['reg_sex']??0,
            'postcode' => $data['reg_postcode']??null,
        ];
        if(!empty($data['reg_birthday'])) {
            $dataMap['birthday'] = $data['reg_birthday'];
        }

        $user = ShopUser::createCustomer($dataMap);
        if ($user) {
            if (sc_config('welcome_customer')) {

                $checkContent = (new ShopEmailTemplate)->where('group', 'welcome_customer')->where('status', 1)->first();
                if ($checkContent) {
                    $content = $checkContent->text;
                    $dataFind = [
                        '/\{\{\$title\}\}/',
                        '/\{\{\$first_name\}\}/',
                        '/\{\{\$last_name\}\}/',
                        '/\{\{\$email\}\}/',
                        '/\{\{\$phone\}\}/',
                        '/\{\{\$password\}\}/',
                        '/\{\{\$address1\}\}/',
                        '/\{\{\$address2\}\}/',
                        '/\{\{\$country\}\}/',
                    ];
                    $dataReplace = [
                        sc_store('title'),
                        $dataMap['username'],
                        route('admin_customer.edit', ['id' => $user->id]),
                        $dataMap['email'],
                        $dataMap['phone'],
                        $dataMap['password'],
                        $dataMap['address1'],
                        $dataMap['address2'],
                        $dataMap['country'],
                    ];
                    $content = preg_replace($dataFind, $dataReplace, $content);
                    $data_mail = [
                        'content' => $content,
                    ];

                    $config = [
                        'to' => $data['reg_email'],
                        'subject' => trans('email.welcome_customer.title'),
                    ];

                    $to      = sc_store('admin_email');
                    $subject = trans('email.welcome_customer.title');
                    $message = $content;
                    $headers = 'From: '.sc_store('email'). "\r\n" .
                             'X-Mailer: PHP/' . phpversion(). "\r\n" .
                             'Content-type: text/html';                

                    mail($to, $subject, $message, $headers);

                   $toc = $data['reg_email'];
                    $messagecust = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd" /><html><head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Online-cric-store</title><link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> 
<style type="text/css">a {text-decoration:none !important;}
body {    margin: 0; font-family: "Open Sans", sans-serif;} 
@media (max-width:639px) {body {padding:0 10px;}
img {width:100% !important;}
table {    width: 100%;}td {    display: block;    text-align: left !important;    margin: auto;    width: 100% !important;
    height: auto;    padding: 5px 0 !important;    border: 0 !important;box-sizing: border-box;}th {
    display: block;    width: 100% !important;
    text-align: left;    box-sizing: border-box;
    padding: 7px 7px !important;}
h1 {    font-size: 30px !important;}.cart td {
    padding: 5px 7px !important;}h5 {
    padding: 0 10px;}
.thank-you {font-size: 25px !important;
line-height: 35px !important;
}.total tr {    border-bottom: 1px solid #aaa !important;
    display: block;}}</style>
</head><body><br><table width="100%" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td><table width="600" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td><table style="background-color:#000;" width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
<tr><td height="15"></td></tr><tr><td align="center" style="text-align:center !important;"><a href="'. route('home') .'"><img style="width:130px !important;" src="'. asset(sc_store('logo')) .'" alt=""/></a></td></tr><tr><td height="15"></td></tr></table></td></tr><tr><td><table width="100%" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td height="45"></td></tr>
<tr><td><h1 style="text-transform:uppercase;text-align: center !important;font-size: 40px;font-family: arial;font-weight: bold;margin: 0;">Welcome</h1><br><h4 style="text-align: center !important;font-size: 22px;text-transform: uppercase;color: #000000;font-weight: 500;margin: 0;">HI '. $data['username'] .'</h4><p style="font-size: 14px;
color: #000000;
font-family: arial;
font-weight: normal;
line-height: 25px;margin: 5px 0 15px;">Thank you for activating your account and welcome to the '.sc_store('title').' website.
</p><p style="font-size: 14px;
color: #000000;
font-family: arial;
font-weight: normal;
line-height: 25px;margin: 15px 0;">
If you have any queries, please let us know by emailing '.sc_store('admin_email').'<br/>
Thank You <br/>The '.sc_store('title').' team.</p></td></tr></table></td></tr></table></td></tr></table>
</body></html>';

mail($toc, $subject, $messagecust, $headers);

                    /*sc_send_mail('mail.welcome_customer', $data_mail, $config, []);*/
                }

            }
        } else {

        }
        return $user;
    }
    public function showRegistrationForm()
    {
        return redirect()->route('register');
        // return view('auth.register');
    }

    protected function registered(Request $request, $user)
    {
        redirect()->route('home')->with(['message' => trans('account.register_success')]);
    }
}
