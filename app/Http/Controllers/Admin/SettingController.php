<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Http\UploadedFile;


class SettingController extends BaseController
{
    use FileUpload;

    public function index(){
        $this->setPageTitle('Settings', 'Manage Settings');
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
//        return $request;
        $deleteLogo = $request->has('deleteLogo') ? 1 : 0;
        $deleteFavicon = $request->has('deleteFavicon') ? 1 : 0;
        if ($request->has('site_logo') && ($request->file('site_logo') instanceof UploadedFile)) {

            if (config('settings.site_logo') != null) {
                $this->deleteOne(config('settings.site_logo'));
            }
            $logo = $this->uploadOne($request->file('site_logo'), 'settings');
            Setting::set('site_logo', $logo);
        }
        if (!($request->has('site_logo') && ($request->file('site_logo') instanceof UploadedFile))) {
            if ($deleteLogo){
                if(Setting::where('key','site_logo')->first()->value != null)
                {
                    $this->deleteOne(Setting::where('key','site_logo')->first()->value);
                    Setting::set('site_logo', null);
                }
                $image = null;
            }
        }
        if ($request->has('site_favicon') && ($request->file('site_favicon') instanceof UploadedFile)) {

            if (config('settings.site_favicon') != null) {
                $this->deleteOne(config('settings.site_favicon'));
            }
            $favicon = $this->uploadOne($request->file('site_favicon'), 'settings');
            Setting::set('site_favicon', $favicon);
        }
        if (!($request->has('site_favicon') && ($request->file('site_favicon') instanceof UploadedFile))) {
            if ($deleteFavicon){
                if(Setting::where('key','site_favicon')->first()->value != null)
                {
                    $this->deleteOne(Setting::where('key','site_favicon')->first()->value);
                    Setting::set('site_favicon', null);
                }
                $image = null;
            }
        }
        if(!($request->has('site_logo') or $request->has('site_favicon')))
        {
            $keys = $request->except('_token','deleteLogo','deleteFavicon');

            foreach ($keys as $key => $value)
            {
                Setting::set($key, $value);
            }
        }
        return $this->responseRedirectBack('Settings updated successfully.', 'success');
    }

}
