<?php

namespace App\Http\Controllers;

use App\Http\Resources\Withdraws\WithdrawsCollection;
use App\Models\Player;
use App\Models\Setting;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class ApiWithdrawsController extends Controller
{
    /**
     * show player quizzes to continue
     *
     * @param  \App\Continuequiz $continuequiz
     * @return \Illuminate\Http\Response
     */
    public function getWithdraws($player_id, $key) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
            return WithdrawsCollection::collection(Withdraw::where('player_id', '=', $player_id)->get());
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    /**
* Withdrawal Request
*
* @return \Illuminate\Http\Response
*/
public function sendRequestWithdraw(Request $request) {
    $api_key = Setting::find(1)->api_secret_key;
    if ($request->key==$api_key) {
    $player = Player::find($request->player_id);
    $settings = Setting::find(1);
    if ($player->earnings_actual >= $settings->min_to_withdraw) {
        // Earnings Actual more than Minimum
        if ($request->amount <= $player->earnings_actual) {
            $pointsToReduce = (double) $request->amount*$settings->conversion_rate;
            // Add Withdraw
            Withdraw::create([
                'player_id'=>$request->player_id,
                'player_email'=>$request->player_email,
                'amount'=>$request->amount,
                'points'=>$pointsToReduce,
                'status'=>"pending",
                'payment_method'=>$request->method,
                'payment_info'=>$request->infos,
            ]);
            // Minus Player Earnings and Player Actual Score
            $player->actual_score = $player->actual_score - $pointsToReduce;
            $player->earnings_actual = $player->earnings_actual - $request->amount;
            $player->save();
            $result['success'] = '1';
            echo json_encode($result);
        } else {
            // Requested Amount is More Than Earnings Actual
            $result['success'] = '0';
            echo json_encode($result);
        }
    } else {
        // Player Earnings is Less Than Min to Withdraw
        $result['success'] = '2';
        echo json_encode($result);
    }
} else {
    $result['success'] = '3';
    $result['message'] = 'You are not allowed to do this operation!';
    echo json_encode($result);
}
}
}
