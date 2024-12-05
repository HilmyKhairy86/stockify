<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AppSettings\AppSettingsService;
use App\Services\UserActivity\UserActivityService;

class SettingsController extends Controller
{
    protected $appSettingService;
    protected $userActivityService;
    public function __construct(AppSettingsService $appSettingService, UserActivityService $userActivityService)
    {
        $this->appSettingService = $appSettingService;
        $this->userActivityService = $userActivityService;
    }

    public function updateSetting(Request $request)
    {
        $data = $request->all();
        $this->appSettingService->updateSettings($data);
        if (isset($data['logo'])) {
            $act = [
                'user_id' => Auth::user()?->id,
                'kegiatan' => 'mengubah logo aplikasi',
                'tanggal' => now(),
            ];
            $this->userActivityService->createActivity($act);
        } elseif ($data['app_name']) {
            $act = [
                'user_id' => Auth::user()?->id,
                'kegiatan' => 'mengubah nama aplikasi',
                'tanggal' => now(),
            ];
            $this->userActivityService->createActivity($act);
        } elseif ($data['logo'] and $data['app_name']) {
            $act = [
                'user_id' => Auth::user()?->id,
                'kegiatan' => 'mengubah nama aplikasi dan logo',
                'tanggal' => now(),
            ];
            $this->userActivityService->createActivity($act);
        }
        return redirect()->back()->with('success','Action was successful!');
    }
}
