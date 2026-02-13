<?php

namespace App\Http\Controllers\Setting;

use App\Models\setting;
use App\Traits\AttachFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    use AttachFiles;
    public function index () {
        $settings = setting::all();
        $setting["setting"]=$settings->flatMap(function ($settings) {
            return [$settings->Key => $settings->Value];
        });
        return view('pages.setting.index',$setting);
    }

    public function update(request $request){
        DB::beginTransaction();
        try {
            $info = $request->except("_token","_method");
            foreach ($info as $key=>$value){
              setting::where('Key',$key)->update(['Value'=>$value]);
            }

            if ($request->hasFile('logo')) {
                $logoSetting = setting::where('Key', 'logo')->first();
                if ($logoSetting) {
                    $this->deleteFile($logoSetting->id, 'logo');
                }
                $logoSetting = setting::firstOrCreate(['Key' => 'logo'], ['Value' => '']);
                $file = $request->file('logo');
                $this->uploadFile($file, $logoSetting, 'logo');
            }
            DB::commit();
            toastr()->success(trans('message.success'));
            return back();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
