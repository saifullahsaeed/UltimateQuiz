<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdsController extends Controller
{
    /**
     * Show the categories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ads() {
    	$ads = Ad::find(1);
        return view('ads')->with([
        	'ads'=>$ads,
        ]);
    }

    /**
     * Show the categories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateAds(Request $request) {
        $ads = Ad::find(1);
        $ads->admob_app_id = $request->admob_app_id;
        $ads->admob_banner = $request->admob_banner;
        $ads->admob_interstitial = $request->admob_interstitial;
        $ads->admob_native = $request->admob_native;
        $ads->admob_reward = $request->admob_reward;
        $ads->facebook_banner = $request->facebook_banner;
        $ads->facebook_interstitial = $request->facebook_interstitial;
        $ads->facebook_native = $request->facebook_native;
        $ads->facebook_reward = $request->facebook_reward;
        $ads->adcolony_app_id = $request->adcolony_app_id;
        $ads->adcolony_banner = $request->adcolony_banner;
        $ads->adcolony_interstitial = $request->adcolony_interstitial;
        $ads->adcolony_reward = $request->adcolony_reward;
        $ads->startapp_app_id = $request->startapp_app_id;
        $ads->banner_type = $request->banner_type;
        $ads->interstitial_type = $request->interstitial_type;
        $ads->video_type = $request->video_type;
        $ads->save();
        Session::flash('success', 'Your Ads are changed successfully!');
        return redirect()->back();
    }
}
