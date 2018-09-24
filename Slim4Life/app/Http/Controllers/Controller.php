<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Image;
use Validator;
use Illuminate\Http\Request;
use File;
use DB;
use Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /* $params['fileCrop'] = false;
    * $params['xCord'] = 253;
    * $params['yCord'] = 153;
    * refrence url : http://image.intervention.io
    */
    public function imageUpload($params)
    {
        $errorMessages = '';
        $returnData['status'] = false;
        $returnData['fileName'] = '';
        $returnData['message'] = '';

        $inputFile = !empty($params['file']) ? $params['file'] : array();      

        $file = array('image' => $inputFile);
        $rules = array('image' => 'required|mimes:jpeg,jpg,png,gif|image|max:5000');
        $validator = Validator::make($file, $rules);
        if($validator->fails())
        {
            $errorMessages = $validator->errors()->all();
            $errorMessages = \Config::get('flash_msg.FileNotValid');
            $returnData['message'] = $errorMessages;
        }
        else
        {
            if($inputFile->isValid())
            {
                $fileName = !empty($params['file_name']) ? $params['file_name'] : $params['file']->getClientOriginalName() . '_' . rand(11111, 99999) . time();
                $fileResize = !empty($params['fileResize']) ? $params['fileResize'] : false;
                $fileCrop = !empty($params['fileCrop']) ? $params['fileCrop'] : false;
                $width = !empty($params['width']) ? (int)$params['width'] : 100;
                $height = !empty($params['height']) ? (int)$params['height'] : 100;
                $xCord = !empty($params['xCord']) ? (int)$params['xCord'] : 0;
                $yCord = !empty($params['yCord']) ? (int)$params['yCord'] : 0;
                $isThumb = !empty($params['isThumb']) ? $params['isThumb'] : false;
                $thumbWidth = !empty($params['thumbWidth']) ? $params['thumbWidth'] : 100;
                $thumbHeight = !empty($params['thumbHeight']) ? $params['thumbHeight'] : 100;
                $savePath = !empty($params['savePath']) ? $params['savePath'] : public_path() . '/images/uploaded/mix/';
                $thumbSavePath = !empty($params['thumbPath']) ? $params['thumbPath'] : public_path() . '/images/uploaded/mix/thumb/';
				
				//
				$folderPath = public_path() . '/images/uploaded/gym';
				$thumbSavePath = $folderPath . '/thumb/';			   
				
				if(!File::exists($folderPath))
				{
					File::makeDirectory($folderPath, 0777, true, true);
				}
				
				if(!File::exists($savePath))
				{
					File::makeDirectory($savePath, 0777, true, true);
				}
				
				if($isThumb)
				{
					if(!File::exists($thumbSavePath))
					{
						File::makeDirectory($thumbSavePath, 0777, true, true);
					}
				}  
                
                if(!empty($params['checkSavePath']))
                {
                    if($params['checkSavePath'])
                    {                        
                        if(!File::exists($savePath))
                        {
                            File::makeDirectory($savePath, 0777, true, true);
                        }
                        
                        if($isThumb)
                        {
                            if(!File::exists($thumbSavePath))
                            {
                                File::makeDirectory($thumbSavePath, 0777, true, true);
                            }
                        }                        
                    }
                }
                
                $destinationPath = $savePath;

                // upload path
                $extension = $inputFile->getClientOriginalExtension();

                // getting image extension
                $fileName = $fileName . '.' . $extension;

                // renameing image
                $Image = Image::make($inputFile->getRealPath());

                if($fileResize)
                {
                    $Image->resize($width, $height, function ($constraint) {$constraint->aspectRatio();})->save($destinationPath . '/' . $fileName);
                }
                else if($fileCrop){
                    $Image->crop($width, $height, $xCord, $yCord)->save($destinationPath . '/' . $fileName);
                }
                else
                {
                    $inputFile->move($destinationPath, $fileName);
                }
                if($isThumb)
                {
                    $Image->resize($thumbWidth, $thumbHeight, function ($constraint) {$constraint->aspectRatio();})->resizeCanvas($thumbWidth, $thumbHeight)->save($thumbSavePath . '/' . $fileName);
                }           
                

                // uploading file to given path
                $returnData['status'] = true;
                $returnData['message'] = $errorMessages;
                $returnData['fileName'] = $fileName;
                $returnData['savePath'] = $savePath;
            }
            else
            {
                $errorMessages = \Config::get('flash_msg.FileNotValid');
                $returnData['message'] = $errorMessages;
            }
        }

        return $returnData;
    }
    
    protected function sendMail($params = [])
    {
        $emailTemplateModel = new EmailTemplate();

        $params['emailTemplate'] = $emailTemplateModel->fetchEmailTemplateBySlug($params['emailSlug']);

        $params['toName'] = !empty($params['toName']) ? $params['toName'] : 'Admin';
        $params['fromName'] = !empty($params['fromName']) ? $params['fromName'] : \Config::get('constants.SiteName');
        $params['toEmail'] = !empty($params['toEmail']) ? $params['toEmail'] : \Config::get('constants.AdminEmailId');
        $params['fromEmail'] = !empty($params['fromEmail']) ? $params['fromEmail'] : \Config::get('constants.AdminEmailId');
        $params['emailSlug'] = $params['emailSlug'];
        $params['attachment'] = !empty($params['attachment']) ? $params['attachment'] : '';
        $params['originalFileName'] = !empty($params['originalFilename']) ? $params['originalFilename'] : '';
        
        if(!empty($params['noReply']))
            $params['fromEmail'] = \Config::get('constants.NoReplyEmailId');
        
        $body = str_replace('##SITE_NAME##', \Config::get('constants.SiteName'), $params['emailTemplate']['body']);
        
        if(!empty($params['replaceKeywords']))
        {
            foreach($params['replaceKeywords'] as $keyword => $replaceValue)
            {
                $body = str_replace($keyword, $replaceValue, $body);
            }
        }
        
        $params['emailTemplate']['body'] = $body;
        
        $commonEmailTemplate = new CommonEmailTemplate($params);
        Mail::to($params['toEmail'])->send($commonEmailTemplate);
    }
}
