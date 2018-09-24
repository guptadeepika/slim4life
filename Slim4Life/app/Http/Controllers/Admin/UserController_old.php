<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use Auth;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Hash;
use App\Model\User;

class UserController extends BaseController
{
    public function __construct()
	{
        parent::__construct();
        
        $this->middleware('auth', ['except' => ['register']]);
    }
	
	public function register(Request $request)
	{ 
		if($request->isMethod('POST'))
		{
			$request->merge(['password' => Hash::make($request->password)]);
			//echo "<pre>";print_r($request->all());die('dd');
			$user = User::create($request->all(), ['except' => ['confirm_password'] ]);
			return Redirect::to('/');
		}
		return view('admin/users/add');
    }
	public function usersList(Request $request)
	{ 
		if($request->isMethod('POST'))
		{
			$request->merge(['password' => Hash::make($request->password)]);
			//echo "<pre>";print_r($request->all());die('dd');
			$user = User::create($request->all(), ['except' => ['confirm_password'] ]);
			return Redirect::to('/');
		}
		return view('admin/users/list');
    }
	
	
}
