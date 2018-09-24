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

class FeatureController extends BaseController
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
	* @description: To add new feature
	* @return \Illuminate\Http\Response
	*/
	public function create(Request $request)
	{ 
		$viewData = $this->getViewData();
        $data = [];
        $data['mainTitle'] = 'Feature';
        $data['adminDetail'] = $this->getAdminData();
        $viewData['breadCrumData'][1]['text'] = 'Feature';
        $viewData['breadCrumData'][1]['url'] = url('/admin/feature-list');
        $viewData['breadCrumData'][1]['breadFaClass'] = 'fa-dashboard';
        $viewData['breadCrumData'][2]['text'] = 'Add';
        $viewData['breadCrumData'][2]['breadFaClass'] = 'active';
		if($request->isMethod('POST'))
		{
			$feature = \App\Model\Feature::create($request->all());
			\Session::flash('success', \Config::get('flash_msg.FeatureAdded'));	
			return Redirect::to('admin/feature-list');
		}
		$data = array_merge($data, $viewData);
		return view('admin/features/add',$data);
    }
    
    public function edit(Request $request, $id=null)
	{ 
		$id = Crypt::decryptString($id);
		$viewData = $this->getViewData();
        $data = [];
        $data['mainTitle'] = 'Feature';
        $data['adminDetail'] = $this->getAdminData();
        $viewData['breadCrumData'][1]['text'] = 'Feature';
        $viewData['breadCrumData'][1]['url'] = url('/admin/feature-list');
        $viewData['breadCrumData'][1]['breadFaClass'] = 'fa-dashboard';
        $viewData['breadCrumData'][2]['text'] = 'Edit';
        $viewData['breadCrumData'][2]['breadFaClass'] = 'active';

		$data['featureDetail'] = \App\Model\Feature::find($id);	
		$data = array_merge($data, $viewData);	
		return view('admin/features/edit',$data);
    }
    
    public function update(Request $request, $id=null)
	{
		$id = Crypt::decryptString($id);
		if($request->isMethod('POST'))
		{
			\App\Model\Feature::where('id', '=', $id)->update(['name' => $request['name']]);
		}
		\Session::flash('success', \Config::get('flash_msg.FeatureUpdated'));	
		return \Redirect::to('admin/feature-list');
    }
    
    public function delete(Request $request,$id=null)
	{ 
		$id = \Crypt::decryptString($id);
        try {
            DB::beginTransaction();
            $feature = \App\Model\Feature::find($id);
            
            $feature->delete();
            DB::commit();
            \Session::flash('success', \Config::get('flash_msg.FeatureDeleted'));
        } catch (\Laravel\Database\Exception $e) {
            DB::rollBack();
            \Log::exception($e);

            \Session::flash('error', \Config::get('flash_msg.FeatureNotDeleted'));
        }
        return \Redirect::to('admin/feature-list');
    }
	public function featuresList(Request $request)
	{ 
		$viewData = $this->getViewData();
        $data = [];
        $data['adminDetail'] = $this->getAdminData();
        $viewData['breadCrumData'][1]['text'] = 'Feature';
        $viewData['breadCrumData'][1]['url'] = url('/admin/feature-list');
        $viewData['breadCrumData'][1]['breadFaClass'] = 'fa-dashboard';
        $viewData['breadCrumData'][2]['text'] = 'Features List';
        $viewData['breadCrumData'][2]['breadFaClass'] = 'active';
        $data['mainTitle'] = 'Feature';
        $featureModel = new \App\Model\Feature();
        $data['featurelist'] = $featureModel->getFeatures($request);
		$data = array_merge($data, $viewData);
		return view('admin/features/list',$data);
    }
	
	
}
