<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PlayersController extends Controller
{
    /**
     * Show the players list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function players() {
    	$players = Player::paginate(10);
        return view('players')->with([
        	'players'=>$players
        ]);
    }

    /**
     * Create New Player.
     *
     * @return \Illuminate\Http\Response
     */
    public function newPlayer(Request $request) {
    	$setting = Setting::find(1);
        if (!empty($request->image_url)) {
            $new_name = time() . $request->file('image_url')->getClientOriginalName();
            $request->image_url->move('uploads/players/', $new_name);
            $player = Player::create([
            'username' => $request->username,
            'email_or_phone' => $request->email_or_phone,
            'password' => Hash::make($request->password),
            'total_score'=>$request->actual_score,
            'actual_score'=>$request->actual_score,
            'referral_code'=>Str::random(6).Str::random(2),
            'login_method'=>"admin",
            'device_id'=>Str::random(5).Str::random(5),
            'image_url'=>URL::to('uploads/players/'.$new_name),
            'coins'=>$request->coins,
            'last_claim'=>date("Y-m-d H:i:s", time()-86400),
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'instagram'=>$request->instagram,
            'earnings_withdrawed'=>0,
            'blocked'=>"no",
            'earnings_actual' => $request->actual_score / $setting->conversion_rate,
            ]);
            $newRef = $player->referral_code . $player->id;
            $player->referral_code = $newRef;
            $player->save();
            Session::flash('success', 'New player created successfully!');
            return redirect()->back();
        } else {
        	Session::flash('error', 'Please enter a valid infos!');
            return redirect()->back();
        }
    }

    /**
     * Edit Player.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editPlayer($id) {
    	$player = Player::find($id);
        return view('edit-player')->with([
        	'player'=>$player
        ]);
    }

    /**
     * Update Player Infos
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function updatePlayer(Request $request, Player $player)
    {
    	$setting = Setting::find(1);
        if (!empty($request->image_url)) {
            $new_name = time() . $request->file('image_url')->getClientOriginalName();
            $request->image_url->move('uploads/players/', $new_name);
            $player->image_url = URL::to('uploads/players/'.$new_name);
        }
        $player->username = $request->username;
        $player->email_or_phone = $request->email_or_phone;
        $player->actual_score = $request->actual_score;
        $player->total_score = $request->total_score;
        $player->referral_code = $request->referral_code;
        $player->coins = $request->coins;
        $player->facebook = $request->facebook;
        $player->twitter = $request->twitter;
        $player->instagram = $request->instagram;
        $player->earnings_actual = $request->actual_score / $setting->conversion_rate;
        $player->save();
        Session::flash('success', 'Your Player Infos had been updated successfully!');
        return redirect()->back();
    }

    /**
     * Edit Player.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deletePlayer($id) {
    	$player = Player::find($id);
        $player->withdraws()->delete();
        $player->delete();
        Session::flash('success', 'This Player had been deleted successfully!');
        return redirect()->back();
    }
}
