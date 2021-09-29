<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WithdrawsController extends Controller
{
    /**
     * Show the categories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function withdraws() {
    	$withdraws = Withdraw::paginate(10);
    	$settings = Setting::find(1);
        return view('withdraws')->with([
        	'withdraws'=>$withdraws,
        	'settings'=>$settings,
        ]);
    }

    /**
     * Show the categories list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateWithdraw(Request $request) {
    	$withdraw = Withdraw::find($request->id);
        $withdraw->status = $request->status;
        $withdraw->save();
        Session::flash('success', 'Your withdraw Status has been updated successfully!');
        return redirect()->back();
    }

    /**
     * Delete Admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteWithdraw(Withdraw $withdraw)
    {
        $withdraw->delete();
        Session::flash('success', 'This Withdraw had been deleted successfully!');
        return redirect()->back();
    }
}
