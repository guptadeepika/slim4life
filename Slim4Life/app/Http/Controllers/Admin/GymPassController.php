<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

class GymPassController extends BaseController
{
    public function getViewData() {
        $viewData['faClass'] = 'fa-table';
        $breadCrumData[0]['text'] = 'Dashboard';
        $breadCrumData[0]['url'] = url('/admin/dashboard');
        $breadCrumData[0]['breadFaClass'] = 'fa-dashboard';
        $viewData['breadCrumData'] = $breadCrumData;
        return $viewData;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $viewData = $this->getViewData();
        $data = [];
        $gymPassViewModel = new \App\Model\GymPassView();
        $gymPassList = $gymPassViewModel->getGymPasses($request);
        $data['gymPassList'] = $gymPassList;
        $data['mainTitle'] = 'Gym Passes';
        $data['adminDetail'] = $this->getAdminData();
        $viewData['breadCrumData'][1]['text'] = 'Gym Passes';
        $viewData['breadCrumData'][1]['breadFaClass'] = 'active';

        $data = array_merge($data, $viewData);
        return \View('admin.gym_passes.list')->with($data);
    }
    

   
    
}
