<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    /**
     * Show the categories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function settings() {
    	$settings = Setting::find(1);
        return view('settings')->with([
        	'settings'=>$settings,
        ]);
    }

    /**
     * Show the categories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateSettings(Request $request) {
        $settings = Setting::find(1);
        $settings->currency = $request->currency;
        $settings->completed_option = $request->completed_option;
        $settings->api_secret_key = $request->api_secret_key;
        $settings->min_to_withdraw = $request->min_to_withdraw;
        $settings->conversion_rate = $request->conversion_rate;
        $settings->hint_coins = $request->hint_coins;
        $settings->referral_register_points = $request->referral_register_points;
        $settings->video_ad_coins = $request->video_ad_coins;
        $settings->daily_reward = $request->daily_reward;
        $settings->lang = $request->lang;
        $settings->one_device = $request->one_device;
        $settings->fifty_fifty = $request->fifty_fifty;
        $settings->save();
        Session::flash('success', 'Your Settings are changed successfully!');
        return redirect()->back();
    }
}
