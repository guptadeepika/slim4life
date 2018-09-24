<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use Auth;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;
use App\Model\CmsPage;
use Entrust;

class CmsPagesController extends BaseController
{
	public function getViewData()
	{
		$viewData['faClass'] = 'fa-table';
		
		$breadCrumData[0]['text'] = 'Dashboard';
		$breadCrumData[0]['url'] = url('/admin/dashboard');
		$breadCrumData[0]['breadFaClass'] = 'fa-home';
		$breadCrumData[1]['text'] = 'Manage CMS';		
		$breadCrumData[1]['breadFaClass'] = 'fa-th-list';
		$viewData['breadCrumData'] = $breadCrumData;
		
		return $viewData;		
	}
    
    public function index(Request $request)
    {
        $cmsPageModel = new CmsPage();
        
		$data['cmsPages'] = $cmsPageModel->fetchCmsPages($request);
		
		$data['mainTitle'] = 'CMS Listing';
		$data['tableTitle'] = 'CMS Listing';
		$data['adminDetail'] = $this->getAdminData();
		$viewData = $this->getViewData();
		
		$data = array_merge($data, $viewData);
		
		return view::make('admin.cms-pages.index')->with($data);
    }

    public function create()
    {
	
        $viewData = $this->getViewData();

        $data['mainTitle'] = 'Add CMS';
        $data['subTitle'] = 'Add CMS';
		$data['adminDetail'] = $this->getAdminData();
        $viewData['breadCrumData'][1]['url'] = url('/admin/cms-pages');
        $viewData['breadCrumData'][2]['text'] = 'Add CMS';
        $viewData['breadCrumData'][2]['breadFaClass'] = 'fa-th-list';

        $data = array_merge($data, $viewData);

        return View::make('admin.cms-pages.create')->with($data);
		
    }

    public function store(Request $request)
    {
        $cmsPageModel = new CmsPage();
        
        $request->request->add(['created_by_user_id' => Auth::user()->id]);
        $request->request->add(['updated_by_user_id' => Auth::user()->id]);		
		$request->request->add(['slug' => str_slug($request->title, "-")]);
		
		$validation = Validator::make($request->all(), $cmsPageModel->rules());
			
		if($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->messages());
		}

		$input = $request->except(['_token']);
		
		$cmsPage = CmsPage::create($input);
		
		if(!empty($cmsPage->id))
		{
			Session::flash('success', \Config::get('flash_msg.PageAdded'));	
				
			return Redirect::to('/admin/cms-pages');
		}
		else
		{
			return back()->with('error', \Config::get('flash_msg.PageNotSaved'));
		}	
    }
    
    public function edit($id)
    {
        $id = \Crypt::decryptString($id);
		
		$viewData = $this->getViewData();
		
		$data['mainTitle'] = 'Edit CMS';
		$data['subTitle'] = 'Edit CMS';
		$data['adminDetail'] = $this->getAdminData();
		$data['cmsPage'] = CmsPage::find($id);
		
		$viewData['breadCrumData'][1]['url'] = url('/admin/cms-pages');
		$viewData['breadCrumData'][2]['text'] = 'Edit CMS';
		$viewData['breadCrumData'][2]['breadFaClass'] = 'fa-th-list';
		
		$data = array_merge($data, $viewData);

        return View::make('admin.cms-pages.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $id = \Crypt::decryptString($id);
		
		$cmsPageModel = new CmsPage();
		
		$cmsPage = CmsPage::findorfail($id);
		
		$request->request->add(['created_by_user_id' => $cmsPage->created_by_user_id]);
        $request->request->add(['updated_by_user_id' => Auth::user()->id]);
		$request->request->add(['slug' => str_slug($request->title, "-")]);
		
		$validation = Validator::make($request->all(), $cmsPageModel->rules());
			
		if($validation->fails())
		{
			return Redirect::back()->withInput()->withErrors($validation->messages());
		}
		else
		{            
			$updateStatus = $cmsPage->update($request->all());
			
			if($updateStatus)
			{
				Session::flash('success', \Config::get('flash_msg.PageUpdated'));
				
				return Redirect::to('/admin/cms-pages');
			}
			else
			{
				Session::flash('error', \Config::get('flash_msg.PageNotUpdated'));
				
				return Redirect::back();
			}
        }
    }

    public function destroy($id)
    {
        $id = \Crypt::decryptString($id);
		
		CmsPage::destroy($id);

        Session::flash('success', \Config::get('flash_msg.PageDeleted'));
		
        return Redirect::to('/admin/cms-pages');
    }
}
