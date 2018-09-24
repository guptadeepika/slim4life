<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
	public function __construct()
	{       
		$this->middleware('auth', ['except' => ['login']]);
	}
	/**
	* Author: Jitender.
	*
	* Description: generic function for Change status . you need to set "modelName" with route
	*/
    public function changeStatus($status = '', $id = 0){
        $id = \Crypt::decryptString($id);
        $modelName = \Route::current()->action['modelName'];
       
        $modelData = $modelName::FindOrFail($id);
        $modelData->status = $status;
        $modelData->save();
        return \Redirect::back()->withSuccess(\Config::get('flash_msg.StatusChanged'));
    }
     public function getAdminData()
     {
		$customerModel = new \App\Model\User();
		return $customerModel->getAdminDetail();		 
	 }
}
