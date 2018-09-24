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

class AdminController extends BaseController
{
	die('dfgdf');
	public function login(Request $request)
	{ 
		
		if(Auth::check())
		{
			return Redirect::to('admin/dashboard');
		}
		
		if($request->isMethod('POST'))
		{		
			$validator = Validator::make($request->all(), ['email' => 'required', 'password' => 'required']);
			
			$remember = (Input::has('remember')) ? true : false;			
			
			if($validator->fails())
			{
				return Redirect::back()->withErrors($validator);
			}
			else
			{	
								
				if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'Active'], $remember))
				{		
					return Redirect::to('admin/dashboard');
				}
				else
				{
					Session::flash('error', \Config::get('flash_msg.LoginInvalid')); 
					
					return Redirect::back();
				}
			}
		}
		
		return view('admin/login');
    }
	
	public function logout()
	{
		try
		{
			Auth::logout();
			
			Session::flash('success', \Config::get('flash_msg.LogoutSuccess'));
			
			return Redirect::to('admin/');
		}
		catch(\Illuminate\Database\QueryException $e)
		{
			return Redirect::to('admin/');
		}
    }
	
	public function dashboard()
	{
		//die('ddd');
		$data['mainTitle'] = 'Dashboard';
		$data['subTitle'] = 'Dashboard';
		$data['faClass'] = 'fa-table';
		
		$breadCrumData[0]['text'] = 'Dashboard';
		$breadCrumData[0]['url'] = url('/admin/dashboard');
		$breadCrumData[0]['breadFaClass'] = 'fa-home';
		$data['breadCrumData'] = $breadCrumData;
		
		$gymModel = new \App\Model\Gym();
		$data['gymCount'] = $gymModel->getGymCount();
		
		$customerModel = new \App\Model\User();
		$data['customerCount'] = $customerModel->getCustomerCount();
		$data['adminDetail'] = $this->getAdminData();
		$gymPassViewModel = new \App\Model\GymPassView();
		$data['activatedGymPassCount'] = $gymPassViewModel->getActivatedGymPassCount();
		$data['redeemedGymPassCount'] = $gymPassViewModel->getRedeemedGymPassCount();
		$data['expiredGymPassCount'] = $gymPassViewModel->getExpiredGymPassCount();
		$data['purchasedGymPassCount'] = $gymPassViewModel->getPurchasedGymPassCount();
		
		return view('admin/dashboard', $data);		
	}
	
	public function changePassword(Request $request)
    {		
		if($request->isMethod('POST'))
		{
			$user = \Auth::user();
            
			$rules = array(
							'old_password' => 'required',
							'password' => 'required|alphaNum|between:6,16|confirmed'
						);
           
			$validator = Validator::make($request->all(), $rules);

			if($validator->fails())
			{
				return \Redirect::route('change-password')->withErrors($validator);
			}
			else
			{
               
				if (!\Hash::check($request->old_password, $user->password))
				{
					return \Redirect::route('change-password')->withErrors(\Config::get('flash_msg.PasswordNotMatch'));
				}
				else
				{
					$user->password = bcrypt($request->password);					
					$user->save();
					
					\Session::flash('success', \Config::get('flash_msg.PasswordChanged'));
					
					return \Redirect::route('change-password');
				}
			}
		}		
	
		
		$data['mainTitle'] = 'My Account';
		$data['subTitle'] = 'Change Password';
		$data['faClass'] = 'fa-table';
		$data['adminDetail'] = $this->getAdminData();
		$breadCrumData[0]['text'] = 'Dashboard';
		$breadCrumData[0]['url'] = url('/admin/dashboard');
		$breadCrumData[0]['breadFaClass'] = 'fa-home';
		$breadCrumData[1]['text'] = 'Change Password';		
		$breadCrumData[1]['breadFaClass'] = 'fa-th-list';
		$data['breadCrumData'] = $breadCrumData;
		
		return view('admin/change_password', $data);       
    }
	
	public function myProfile(Request $request)
    {		
		$user = Auth::user();
		
		if($request->isMethod('PUT'))
		{
           
			$rules = array('email' => 'required', 'first_name' => 'required', 'last_name' => 'required', 'mobile' => 'required');

			$input = Input::all();
			
			$validator = \Validator::make($input, $rules);

			if($validator->fails())
			{
               
				return \Redirect::route('adminProfile')->withInput($request->all())->withErrors($validator);
			}
			else
			{
									
                if($input['email'] != $user->email){
                    $user->email = $input['email'];
                }
					
				if($input['first_name'] != $user->first_name){
					$user->first_name = $input['first_name'];
                }	
				if($input['last_name'] != $user->last_name){
					$user->last_name = $input['last_name'];
                }	
				if($input['mobile'] != $user->mobile){
					$user->mobile = $input['mobile'];
                }	
		
				$user->save();
				
				\Session::flash('success', \Config::get('flash_msg.DetailUpdated'));
				
				return \Redirect::route('adminProfile');
			}
		}
		
		$data['mainTitle'] = 'My Account';
		$data['subTitle'] = 'My Profile';
		$data['faClass'] = 'fa-table';
		$data['adminDetail'] = $this->getAdminData();
		$breadCrumData[0]['text'] = 'Dashboard';
		$breadCrumData[0]['url'] = url('/admin/dashboard');
		$breadCrumData[0]['breadFaClass'] = 'fa-home';
		$breadCrumData[1]['text'] = 'My Profile';		
		$breadCrumData[1]['breadFaClass'] = 'fa-th-list';
		$data['breadCrumData'] = $breadCrumData;
		
		return view('admin/my_profile', $data)->withUser($user);        
    }	
	
	public function accessDenied()
	{		
		return view('admin/admin/access_denied');
	}
}
