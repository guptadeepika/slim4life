<?php
namespace App\Http\Controllers\Admin;
use Hash;
use Auth;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;
use Mail;

class GymController extends BaseController
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
	* @description: Show the list of gyms
	* @param  $request
	* @return \Illuminate\Http\Response
	*/
    public function index(Request $request) {
        $viewData = $this->getViewData();
        $data = [];
        $gymModel = new \App\Model\Gym();
        $gymList = $gymModel->getGyms($request);
        $data['gymList'] = $gymList;
        $data['adminDetail'] = $this->getAdminData();
        $data['mainTitle'] = 'Gym';
        $viewData['breadCrumData'][1]['text'] = 'Gym';
        $viewData['breadCrumData'][1]['url'] = url('/admin/user');
        $viewData['breadCrumData'][1]['breadFaClass'] = 'fa-dashboard';
        $viewData['breadCrumData'][2]['text'] = 'List';
        $viewData['breadCrumData'][2]['breadFaClass'] = 'active';
        $data = array_merge($data, $viewData);
       
        if($request->export){
            $csvData['records'] = $data['gymList'];
            $csvData['columns']['display'] = ['id','Gym Name','Email','Mobile','Gym Address'];
            $csvData['columns']['keys'] = ['id','name','email','mobile','address'];
            return \App\CustomClasses\Export::exportCSV($csvData); 
               
        }
        
        return \View('admin.gym.list')->with($data);
    }
	/**
	* @author: Deepika Gupta
	* @function: create
	* @description: To add new gym
	* @param  $request
	* @return \Illuminate\Http\Response
	*/
	public function create(Request $request)
	{ 
		$viewData = $this->getViewData();
        $data = [];
        $data['mainTitle'] = 'Gym';
        $data['adminDetail'] = $this->getAdminData();
        $viewData['breadCrumData'][1]['text'] = 'Gym';
        $viewData['breadCrumData'][1]['url'] = url('/admin/user');
        $viewData['breadCrumData'][1]['breadFaClass'] = 'fa-dashboard';
        $viewData['breadCrumData'][2]['text'] = 'Add';
        $viewData['breadCrumData'][2]['breadFaClass'] = 'active';
       
		$openingDay = new \App\Model\OpeningDay();
		$data['openingDaysList'] = $openingDay->fetchOpeningDaysList();
		$feature = new \App\Model\Feature();
		$data['featuresList'] = $feature->fetchFeaturesList();
		$activity = new \App\Model\Activity();
		$data['activityList'] = $activity->fetchActivityList();
		if($request->isMethod('POST'))
		{	
			$contactEmail = $request->email;
			$contactName = $request->name;
			$contactPwd = $request->password;	
			$request->merge(['password' => Hash::make($request->password)]);
			$params['file'] = $request['image'];
			$params['savePath'] = public_path() . '/images/uploaded/gym/';
			$params['thumbPath'] = public_path() . '/images/uploaded/gym/thumb';
			$params['isThumb'] = true;
			$params['thumbWidth'] = 50;
			$params['thumbHeight'] = 50;
			$returnData = $this->imageUpload($params);
			$profileImageName = '';
			if ($returnData['status']) {
				$gym['image'] = $returnData['fileName'];
			}
			$gym['name']=$request->name;
			$gym['email']=$request->email;
			$gym['address']=$request->address;
			$gym['latitude']=$request->latitude;
			$gym['longitude']=$request->longitude;
			$gym['mobile']=$request->mobile;
			$gym['pass_price']=$request->pass_price;
			$gym['password']=$request->password;			
			$gymdata = \App\Model\Gym::create($gym);
			
			// add in gym_opening_days table
			foreach($request->opening_days as $od)
			{
				$openingData['gym_id'] = $gymdata->id;
				$openingData['opening_day'] = $od;
				\App\Model\GymOpeningDay::create($openingData);
			}
			
			// add in gym_opening_days table
			$time_slot['morning_from_time'] = $request->morning_from_time;
			$time_slot['morning_to_time'] = $request->morning_to_time;
			$time_slot['evening_from_time'] = $request->evening_from_time;
			$time_slot['evening_to_time'] = $request->evening_to_time;
			$time_slot['gym_id'] = $gymdata->id;
			\App\Model\TimeSlot::create($time_slot);
			//Email
			Mail::send('emails.welcome', ['name' => $contactName ,'email' =>  $contactEmail, 'password' => $contactPwd], function($message)  use ($contactEmail, $contactName)
			{
				$message->to($contactEmail, $contactName)->subject('Gym Registration');
			});
			//End
			\Session::flash('success', \Config::get('flash_msg.GymAdded'));
			return Redirect::to('admin/gym-list');
		}
		$data = array_merge($data, $viewData);
		//echo "<pre>"; print_r($data); die;
		return view('admin/gym/create',$data);
    }
    /**
	* @author: Deepika Gupta
	* @function: edit
	* @description: To edit gym
	* @param  $request, int $id
	* @return \Illuminate\Http\Response
	*/
    public function edit(Request $request, $id = null) {
		
        $id = \Crypt::decryptString($id);
        $viewData = $this->getViewData();
        $data['adminDetail'] = $this->getAdminData();
        $data['mainTitle'] = 'Edit Gym';
        $data['subTitle'] = 'Edit Gym';
        $data['gymDetail'] = \App\Model\Gym::where('id', '=', $id)->with(['opening_day','time_slot'])->first();
        $data['sel_opening_day'] = [];
        foreach($data['gymDetail']->opening_day as $od)
        {
			$data['sel_opening_day'][] = $od->opening_day;
		}       
        $openingDay = new \App\Model\OpeningDay();
		$data['openingDaysList'] = $openingDay->fetchOpeningDaysList();
		$feature = new \App\Model\Feature();
		$data['featuresList'] = $feature->fetchFeaturesList();
		$activity = new \App\Model\Activity();
		$data['activityList'] = $activity->fetchActivityList();
        $viewData['breadCrumData'][1]['text'] = 'Gym';
        $viewData['breadCrumData'][1]['url'] = url('/admin/gym_list');
        $viewData['breadCrumData'][1]['breadFaClass'] = 'fa-dashboard';
        $viewData['breadCrumData'][2]['text'] = 'Edit Gym';
        $viewData['breadCrumData'][2]['breadFaClass'] = 'active';
		
        $data = array_merge($data, $viewData);
        return \View::make('admin.gym.edit')->with($data);
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
        $gymModel = new \App\Model\Gym();
     
        $gym = $gymModel::FindOrFail($id);
        if ($request->isMethod('POST')) {
            $validation = Validator::make(Input::all(), $gymModel->rules($gym->id));
            if ($validation->fails()) {
                return \Redirect::back()->withInput()->withErrors($validation->messages());
            }
            $input = Input::except(['_token']);
            //delete image from folder
            if(!empty($request['image']))
            {
				$main_image_path = public_path() . '/images/uploaded/gym/'.$gym->image;
				$thumb_image_path = public_path() . '/images/uploaded/gym/thumb/'.$gym->image;
				unlink($main_image_path);
				unlink($thumb_image_path);
			}
			
            $input['id'] = $gym->id;
            $params['file'] = $request['image'];
			$params['savePath'] = public_path() . '/images/uploaded/gym/';
			$params['thumbPath'] = public_path() . '/images/uploaded/gym/thumb';
			$params['isThumb'] = true;
			$params['thumbWidth'] = 50;
			$params['thumbHeight'] = 50;
			$returnData = $this->imageUpload($params);
			$profileImageName = '';
			if ($returnData['status']) {
				$input['image'] = $returnData['fileName'];
			}
			$input['name']=$request->name;
			$input['address']=$request->address;
			$input['latitude']=$request->latitude;
			$input['longitude']=$request->longitude;			
			$input['mobile']=$request->mobile;
			$input['pass_price']=$request->pass_price;  
			//save in gyms table
			$gym->fill($input)->save();
			
			//delete and add in gym_opening_days table
			$collection = \App\Model\GymOpeningDay::where('gym_id', $gym->id)->get(['id']);
			\App\Model\GymOpeningDay::destroy($collection->toArray());
			foreach($request->opening_days as $od)
			{				
				$openingData['gym_id'] = $gym->id;
				$openingData['opening_day'] = $od;
				\App\Model\GymOpeningDay::create($openingData);
			}
			
			// add in gym_opening_days table
			$time_slot['morning_from_time'] = $request->morning_from_time;
			$time_slot['morning_to_time'] = $request->morning_to_time;
			$time_slot['evening_from_time'] =$request->evening_from_time;
			$time_slot['evening_to_time'] = $request->evening_to_time;
			$time_slot['gym_id'] = $gym->id;
			\App\Model\TimeSlot::where('gym_id', '=', $gym->id)->update(['morning_from_time' => $time_slot['morning_from_time'], 'morning_to_time' => $time_slot['morning_to_time'], 'evening_from_time' => $time_slot['evening_from_time'], 'evening_to_time' => $time_slot['evening_to_time']]);
			
            \Session::flash('success', \Config::get('flash_msg.GymUpdated'));

            return \Redirect::to('admin/gym-list');
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
            $user = \App\Model\Gym::find($id);
            
            $user->delete();
            DB::commit();
            \Session::flash('success', \Config::get('flash_msg.GymDeleted'));
        } catch (\Laravel\Database\Exception $e) {
            DB::rollBack();
            \Log::exception($e);

            \Session::flash('error', \Config::get('flash_msg.GymNotDeleted'));
        }
        return \Redirect::to('admin/gym-list');
    }
	
	/**
	* @author: Deepika Gupta
	* @function: checkGym
	* @description: To check availibility of new gym's email
	* @param  $request
	* @return \Illuminate\Http\Response
	*/
	public function checkGym(Request $request)
	{
		$gymModel = new Gym();
        echo $checkAvailibility = $gymModel->checkAvailibility($request['email']);
        die;
	}
    
    
   
	
}
