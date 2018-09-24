<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use Mail;
class UserController extends BaseController 
{
	
	/**
	* @author: Deepika Gupta
	* @function: getViewData
	* @description: It's a common function for all to show breadcrumb
	* @return \Illuminate\Http\Response
	*/
    public function getViewData() {
        $viewData['faClass'] = 'fa-table';
        $breadCrumData[0]['text'] = 'Dashboard';
        $breadCrumData[0]['url'] = url('/admin/dashboard');
        $breadCrumData[0]['breadFaClass'] = 'fa-dashboard';
        $viewData['breadCrumData'] = $breadCrumData;
        return $viewData;
    }
	/**
	* @author: Deepika Gupta
	* @function: index
	* @description: Show the list of customers
	* @param  $request
	* @return \Illuminate\Http\Response
	*/
    public function index(Request $request) {
		
        $viewData = $this->getViewData();
        $data = [];
        $userModel = new \App\Model\User();
        $userList = $userModel->getCustomers($request);
        $data['userList'] = $userList;
        $data['adminDetail'] = $this->getAdminData();
        $data['mainTitle'] = 'Customers';
        $viewData['breadCrumData'][1]['text'] = 'Customer';
        $viewData['breadCrumData'][1]['url'] = url('/admin/user');
        $viewData['breadCrumData'][1]['breadFaClass'] = 'fa-dashboard';
        $viewData['breadCrumData'][2]['text'] = 'List';
        $viewData['breadCrumData'][2]['breadFaClass'] = 'active';
        if($request->export){
            $csvData['records'] = $userList;
            $csvData['columns']['display'] = ['id','Name','Email','Mobile','Address'];
            $csvData['columns']['keys'] = ['id','full_name','email','mobile','address'];
            return \App\CustomClasses\Export::exportCSV($csvData);                
        }
        $data = array_merge($data, $viewData);
        return \View('admin.users.list')->with($data);
    }
    /**
	* @author: Deepika Gupta
	* @function: create
	* @description: To add new customer
	* @param  $request
	* @return \Illuminate\Http\Response
	*/
    public function create() {
        $viewData = $this->getViewData();
        $data = [];
        $viewData['breadCrumData'][1]['text'] = 'User';
        $viewData['breadCrumData'][1]['url'] = url('/admin/user');
        $viewData['breadCrumData'][1]['breadFaClass'] = 'fa-dashboard';
        $viewData['breadCrumData'][2]['text'] = 'Add User';
        $viewData['breadCrumData'][2]['breadFaClass'] = 'active';
        $data['adminDetail'] = $this->getAdminData();
        $data = array_merge($data, $viewData);
        return \View('admin.users.create')->with($data);
    }

    public function store(Request $request) {
        if ($request->isMethod('POST')) {
            $userModel = new \App\Model\User();
            $validation = Validator::make(Input::all(), $userModel->rules());
            if ($validation->fails()) { 
                return \Redirect::back()->withInput()->withErrors($validation->messages());
            }
            $input = $request->except(['_token']);
            DB::beginTransaction();
            try {
                $input['password']= bcrypt($input['password']);
                $user = \App\Model\User::create($input);
            } catch (\Exception $e) {
                \DB::rollBack();
            }

            if (!empty($user->id)) {
                //Email
                $contactEmail =$request->email;
                $contactName = $request->first_name.' '.$request->last_name;
                $contactPwd = $request->password;
				Mail::send('emails.welcome', ['name' => $contactName ,'email' =>  $contactEmail, 'password' => $contactPwd], function($message)  use ($contactEmail, $contactName)
				{
					$message->to($contactEmail, $contactName)->subject('Customer Registration');
				});
                //End
                DB::commit();
                \Session::flash('success', \Config::get('flash_msg.CustomerAdded'));
                return \Redirect::to('admin/user');
            } else {
                \DB::rollBack();
                return back()->with('error', \Config::get('flash_msg.CustomerNotSaved'));
            }
        }
    }

    public function show(User $user) {
        //
    }
	
	/**
	* @author: Deepika Gupta
	* @function: edit
	* @description: To edit customer
	* @param  int $id
	* @return \Illuminate\Http\Response
	*/
    public function edit($id = null) {
        $id = \Crypt::decryptString($id);
        $viewData = $this->getViewData();
        $data['mainTitle'] = 'Edit User';
        $data['subTitle'] = 'Edit User';
        $data['userDetail'] = \App\Model\User::FindOrFail($id);
        $data['adminDetail'] = $this->getAdminData();
        $viewData['breadCrumData'][1]['text'] = 'User';
        $viewData['breadCrumData'][1]['url'] = url('/admin/user');
        $viewData['breadCrumData'][1]['breadFaClass'] = 'fa-dashboard';
        $viewData['breadCrumData'][2]['text'] = 'Add User';
        $viewData['breadCrumData'][2]['breadFaClass'] = 'active';

        $data = array_merge($data, $viewData);
        return \View::make('admin.users.edit')->with($data);
    }
    
	/**
	* @author: Deepika Gupta
	* @function: update
	* @description: To update the details of gym
	* @param  $request, int $id
	* @return \Illuminate\Http\Response
	*/
    public function update(Request $request, $id = null) {
        $id = \Crypt::decryptString($id);
        $userModel = new \App\Model\User();
     
        $user = $userModel::FindOrFail($id);
        if ($request->isMethod('PUT')) {
            $validation = Validator::make(Input::all(), $userModel->rules($user->id));
            if ($validation->fails()) {
                return \Redirect::back()->withInput()->withErrors($validation->messages());
            }$input = Input::except(['_token']);
            $input['id'] = $user->id;

            $user->fill($input)->save();

            \Session::flash('success', \Config::get('flash_msg.CustomerUpdated'));

            return \Redirect::to('admin/user');
        }
    }
    
    /**
	* @author: Deepika Gupta
	* @function: destroy
	* @description: To delete any gym
	* @param  $request, int $id
	* @return \Illuminate\Http\Response
	*/
    public function destroy(Request $request, $id = null) {
        $id = \Crypt::decryptString($id);
        try {
            DB::beginTransaction();
            $user = \App\Model\User::find($id);
            
            $user->delete();
            DB::commit();
            \Session::flash('success', \Config::get('flash_msg.CustomerDeleted'));
        } catch (\Laravel\Database\Exception $e) {
            DB::rollBack();
            \Log::exception($e);

            \Session::flash('error', \Config::get('flash_msg.CustomerNotDeleted'));
        }
        return \Redirect::to('admin/user');
    }
    /**
	* @author: Jitender Nagar
	* @function: changePassword
	* @description: To change the password of admin
	* @param  $request
	* @return \Illuminate\Http\Response
	*/
    
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
		
		return view('admin/users/change_password', $data);       
    }
	
	/**
	* @author: Deepika Gupta
	* @function: checkGym
	* @description: To check availibility of new customer's email
	* @param  $request
	* @return \Illuminate\Http\Response
	*/
	public function checkCustomer(Request $request)
	{
		$userModel = new User();
        echo $checkAvailibility = $userModel->checkAvailibility($request['email']);
        die;
	}
}
