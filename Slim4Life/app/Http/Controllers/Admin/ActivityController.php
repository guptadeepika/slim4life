<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use Auth;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Hash;
use Crypt;
use DB;

class ActivityController extends BaseController
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
	* @function: create
	* @description: To add new activity
	* @return \Illuminate\Http\Response
	*/	
	public function create(Request $request)
	{ 
		$viewData = $this->getViewData();
        $data = [];
        $data['mainTitle'] = 'Activity';
        $data['adminDetail'] = $this->getAdminData();
        $viewData['breadCrumData'][1]['text'] = 'Activity';
        $viewData['breadCrumData'][1]['url'] = url('/admin/activity-list');
        $viewData['breadCrumData'][1]['breadFaClass'] = 'fa-dashboard';
        $viewData['breadCrumData'][2]['text'] = 'Add';
        $viewData['breadCrumData'][2]['breadFaClass'] = 'active';
		if($request->isMethod('POST'))
		{
			$activity = \App\Model\Activity::create($request->all());
			\Session::flash('success', \Config::get('flash_msg.ActivityAdded'));	
			return Redirect::to('admin/activity-list');
		}
		$data = array_merge($data, $viewData);
		return view('admin/activities/add',$data);
    }
    
    public function edit(Request $request, $id=null)
	{ 
		$id = Crypt::decryptString($id);
		$viewData = $this->getViewData();
        $data = [];
        $data['mainTitle'] = 'Activity';
        $data['adminDetail'] = $this->getAdminData();
        $viewData['breadCrumData'][1]['text'] = 'Activity';
        $viewData['breadCrumData'][1]['url'] = url('/admin/activity-list');
        $viewData['breadCrumData'][1]['breadFaClass'] = 'fa-dashboard';
        $viewData['breadCrumData'][2]['text'] = 'Edit';
        $viewData['breadCrumData'][2]['breadFaClass'] = 'active';

		$data['activityDetail'] = \App\Model\Activity::find($id);	
		$data = array_merge($data, $viewData);	
		return view('admin/activities/edit',$data);
    }
    
    public function update(Request $request, $id=null)
	{ 
		$id = Crypt::decryptString($id);
		if($request->isMethod('POST'))
		{
			\App\Model\Activity::where('id', '=', $id)->update(['name' => $request['name']]);
		}
		\Session::flash('success', \Config::get('flash_msg.ActivityUpdated'));	
		return \Redirect::to('admin/activity-list');
    }
    
    public function delete(Request $request,$id=null)
	{ 
		$id = \Crypt::decryptString($id);
        try {
            DB::beginTransaction();
            $activity = \App\Model\Activity::find($id);
            
            $activity->delete();
            DB::commit();
            \Session::flash('success', \Config::get('flash_msg.ActivityDeleted'));
        } catch (\Laravel\Database\Exception $e) {
            DB::rollBack();
            \Log::exception($e);

            \Session::flash('error', \Config::get('flash_msg.ActivityNotDeleted'));
        }
        return \Redirect::to('admin/activity-list');
    }
	public function activitiesList(Request $request)
	{ 
		$viewData = $this->getViewData();
        $data = [];
        $viewData['breadCrumData'][1]['text'] = 'Activity';
        $viewData['breadCrumData'][1]['url'] = url('/admin/activity-list');
        $viewData['breadCrumData'][1]['breadFaClass'] = 'fa-dashboard';
        $viewData['breadCrumData'][2]['text'] = 'Activities List';
        $viewData['breadCrumData'][2]['breadFaClass'] = 'active';
        $data['mainTitle'] = 'Activity';
        $data['adminDetail'] = $this->getAdminData();
        $activityModel = new \App\Model\Activity();
        $data['list'] = $activityModel->getActivities($request);
		$data = array_merge($data, $viewData);
		return view('admin/activities/list',$data);
    }
	
	
}
