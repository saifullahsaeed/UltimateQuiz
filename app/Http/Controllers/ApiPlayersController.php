<?php

namespace App\Http\Controllers;

use App\Http\Resources\Players\PlayersCollection;
use App\Http\Resources\Players\PlayersResource;
use App\Models\Blocked;
use App\Models\Player;
use App\Models\Refer;
use App\Models\Quiz;
use App\Models\Completedquestion;
use App\Models\Continuequiz;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ApiPlayersController extends Controller
{
    /**
     * Verify player situation.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function verifyIfEmailDoesNotExistAndNotBlocked(Request $request) {
    	$api_key = Setting::find(1)->api_secret_key;
        if ($request->key==$api_key) {
        $player = Player::where('email_or_phone', '=', $request->email)->first();
        $blocked = Blocked::where('email','=', $request->email)->first();
        if ($player) {
        	// Check if player exist and is blocked
        	if ($player->blocked=="yes") {
        		$result['success'] = 'blocked';
                $result['message'] = 'This email exist but blocked';
                echo json_encode($result);
        	} else {
        		$result['success'] = 'already';
                $result['message'] = 'This user already exist in database';
                echo json_encode($result);
        	}
        } elseif($blocked) {
                $result['success'] = 'blocked';
                $result['message'] = 'This email is blocked';
                echo json_encode($result);
        } else {
        	$result['success'] = 'ready';
            $result['message'] = 'This email is ready to use';
            echo json_encode($result);
        }
    }
    }

    /**
     * Block This Email
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function blockThisEmail(Request $request) {
    	$api_key = Setting::find(1)->api_secret_key;
        if ($request->key==$api_key) {
        	Blocked::create([
        		'email'=>$request->email
        	]);
        	$result['success'] = 'done';
            $result['message'] = 'This email is blocked now!';
            echo json_encode($result);
        }
    }

    /**
     * Add New Player
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function addNewPlayer(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        $one_device = Setting::find(1)->one_device;
        $device = Player::where('device_id', '=', $request->device)->first();
        // Verify If Api Key is Correct
        if ($request->key==$api_key) {
            // Verify If OneDevice Is Activated Or Not
            if ($one_device=="yes") {
                if ($device) {
                $result['success'] = 'device_error';
                $result['message'] = 'Device Option is YES and a player is already created with this device id!';
                echo json_encode($result);
                } else {
                $player = Player::create([
                'username'=>$request->username,
                'email_or_phone'=>$request->email,
                'password'=>Hash::make($request->password),
                'actual_score'=>0,
                'total_score'=>0,
                'coins'=>0,
                'login_method'=>"email",
                'device_id'=>$request->device,
                'earnings_withdrawed'=>0,
                'earnings_actual'=>0,
                'blocked'=>"no",
                'image_url'=> URL::to('img/player.png'),
                'last_claim'=>date("Y-m-d H:i:s", time()-86400),
                'referral_code'=>Str::random(6),
                ]);
                $player->referral_code = $player->referral_code.$player->id;
                $player->save();
                $result['success'] = 'done';
                $result['message'] = 'New Player Created Successfully!';
                echo json_encode($result);
                }
            } else {
               $player = Player::create([
                'username'=>$request->username,
                'email_or_phone'=>$request->email,
                'password'=>Hash::make($request->password),
                'actual_score'=>0,
                'total_score'=>0,
                'coins'=>0,
                'login_method'=>"email",
                'device_id'=>$request->device.Str::random(4).$request->email,
                'earnings_withdrawed'=>0,
                'earnings_actual'=>0,
                'blocked'=>"no",
                'image_url'=> URL::to('img/player.png'),
                'last_claim'=>date("Y-m-d H:i:s", time()-86400),
                'referral_code'=>Str::random(6),
                ]);
                $player->referral_code = $player->referral_code.$player->id;
                $player->save();
                $result['success'] = 'done';
                $result['message'] = 'New Player Created Successfully!';
                echo json_encode($result); 
            }
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    /**
     * Check Referral Code
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function approveReferral(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        $player = Player::where('email_or_phone', '=', $request->email)->first();
        $referral = Player::where('referral_code', '=', $request->referral)->first();
        $bonus = Setting::find(1)->referral_register_points;
        $conversion_rate = Setting::find(1)->conversion_rate;
        if ($request->key==$api_key) {
            // Check if referral code exist
            if ($referral) {
                // Check if this referral already exist or not to avoid duplication problem
                $refer = Refer::where([
                    'player_id'=>$player->id,
                    'player_email'=>$player->email_or_phone,
                    'referred_source_id'=>$referral->id
                ])->first();
                if ($refer) {
                    $result['success'] = 'duplication';
                    $result['message'] = 'Referral Code Correct';
                    echo json_encode($result);
                } else {
                    Refer::create([
                    'player_id'=>$player->id,
                    'player_email'=>$player->email_or_phone,
                    'referred_source_id'=>$referral->id
                    ]);
                    // add Bonus points to both players & refresh actual earnings
                    $player->actual_score = $player->actual_score + $bonus;
                    $player->total_score = $player->total_score + $bonus;
                    $player->earnings_actual = $player->actual_score / $conversion_rate;
                    $player->save();
                    $referral->actual_score = $referral->actual_score + $bonus;
                    $referral->total_score = $referral->total_score + $bonus;
                    $referral->earnings_actual = $referral->actual_score / $conversion_rate;
                    $referral->save();
                    $result['success'] = 'done';
                    $result['message'] = 'Referral Code Correct';
                    echo json_encode($result);
                }
            } else {
                // Referral Code Not Correct
                $result['success'] = 'code_not_correct';
                $result['message'] = 'Referral Code Not Correct';
                echo json_encode($result);
            }
        }
        else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    /**
     * Add New Player via Facebook
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function addNewPlayerViaFb(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        $one_device = Setting::find(1)->one_device;
        $device = Player::where('device_id', '=', $request->device)->first();
        $player = Player::where('email_or_phone', '=', $request->email)->first();
        // Verify If Api Key is Correct
        if ($request->key==$api_key) {
            if ($player) {
                $result['success'] = 'email_error';
                $result['message'] = 'This user Already Registered!';
                echo json_encode($result);
            } else {
               // Verify If OneDevice Is Activated Or Not
            if ($one_device=="yes") {
                if ($device) {
                $result['success'] = 'device_error';
                $result['message'] = 'Device Option is YES and a player is already created with this device id!';
                echo json_encode($result);
                } else {
                $player = Player::create([
                'username'=>$request->username,
                'email_or_phone'=>$request->email,
                'password'=>Hash::make(Str::random(8)),
                'actual_score'=>0,
                'total_score'=>0,
                'coins'=>0,
                'login_method'=>"facebook",
                'device_id'=>$request->device,
                'earnings_withdrawed'=>0,
                'earnings_actual'=>0,
                'blocked'=>"no",
                'image_url'=> $request->image,
                'last_claim'=>date("Y-m-d H:i:s", time()-86400),
                'referral_code'=>Str::random(6),
                ]);
                $player->referral_code = $player->referral_code.$player->id;
                $player->save();
                $result['success'] = 'done';
                $result['message'] = 'New Player Created Successfully!';
                echo json_encode($result);
                }
            } else {
               $player = Player::create([
                'username'=>$request->username,
                'email_or_phone'=>$request->email,
                'password'=>Hash::make(Str::random(8)),
                'actual_score'=>0,
                'total_score'=>0,
                'coins'=>0,
                'login_method'=>"facebook",
                'device_id'=>$request->device.Str::random(4).$request->email,
                'earnings_withdrawed'=>0,
                'earnings_actual'=>0,
                'blocked'=>"no",
                'image_url'=> $request->image,
                'last_claim'=>date("Y-m-d H:i:s", time()-86400),
                'referral_code'=>Str::random(6),
                ]);
                $player->referral_code = $player->referral_code.$player->id;
                $player->save();
                $result['success'] = 'done';
                $result['message'] = 'New Player Created Successfully!';
                echo json_encode($result); 
            } 
            }
            
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    /**
     * Add New Player via Google
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function addNewPlayerViaGoogle(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        $one_device = Setting::find(1)->one_device;
        $device = Player::where('device_id', '=', $request->device)->first();
        $player = Player::where('email_or_phone', '=', $request->email)->first();
        // Verify If Api Key is Correct
        if ($request->key==$api_key) {
            if ($player) {
                $result['success'] = 'email_error';
                $result['message'] = 'This user Already Registered!';
                echo json_encode($result);
            } else {
               // Verify If OneDevice Is Activated Or Not
            if ($one_device=="yes") {
                if ($device) {
                $result['success'] = 'device_error';
                $result['message'] = 'Device Option is YES and a player is already created with this device id!';
                echo json_encode($result);
                } else {
                $player = Player::create([
                'username'=>$request->username,
                'email_or_phone'=>$request->email,
                'password'=>Hash::make(Str::random(8)),
                'actual_score'=>0,
                'total_score'=>0,
                'coins'=>0,
                'login_method'=>"google",
                'device_id'=>$request->device,
                'earnings_withdrawed'=>0,
                'earnings_actual'=>0,
                'blocked'=>"no",
                'image_url'=> $request->image,
                'last_claim'=>date("Y-m-d H:i:s", time()-86400),
                'referral_code'=>Str::random(6),
                ]);
                $player->referral_code = $player->referral_code.$player->id;
                $player->save();
                $result['success'] = 'done';
                $result['message'] = 'New Player Created Successfully!';
                echo json_encode($result);
                }
            } else {
               $player = Player::create([
                'username'=>$request->username,
                'email_or_phone'=>$request->email,
                'password'=>Hash::make(Str::random(8)),
                'actual_score'=>0,
                'total_score'=>0,
                'coins'=>0,
                'login_method'=>"google",
                'device_id'=>$request->device.Str::random(4).$request->email,
                'earnings_withdrawed'=>0,
                'earnings_actual'=>0,
                'blocked'=>"no",
                'image_url'=> $request->image,
                'last_claim'=>date("Y-m-d H:i:s", time()-86400),
                'referral_code'=>Str::random(6),
                ]);
                $player->referral_code = $player->referral_code.$player->id;
                $player->save();
                $result['success'] = 'done';
                $result['message'] = 'New Player Created Successfully!';
                echo json_encode($result); 
            } 
            }
            
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    /**
     * Verify if player otp exist or not
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function verifyIfPlayerExistOtp(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($request->key==$api_key) {
        $player = Player::where('email_or_phone', '=', $request->phone)->first();
        $device = Player::where('device_id', '=', $request->device)->first();
        $one_device = Setting::find(1)->one_device;
        if ($player) {
            $result['success'] = 'already';
            $result['message'] = $player->id;
            echo json_encode($result);
        }
        else {
            if ($one_device=="yes") {
                if ($device) {
                    $result['success'] = 'one_device';
                    $result['message'] = 'One player per device is allowed';
                    echo json_encode($result);
                } else {
                    $result['success'] = 'done';
                    echo json_encode($result);
                }
            } else {
                $result['success'] = 'done';
                echo json_encode($result);
            }
            
        }
    }
    }

    /**
     * Add New Player via Google
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function addNewPlayerViaOtp(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($request->key==$api_key) {
            $player = Player::create([
                'username'=>$request->phone,
                'email_or_phone'=>$request->phone,
                'password'=>Hash::make(Str::random(8)),
                'actual_score'=>0,
                'total_score'=>0,
                'coins'=>0,
                'login_method'=>"otp",
                'device_id'=>$request->device,
                'earnings_withdrawed'=>0,
                'earnings_actual'=>0,
                'blocked'=>"no",
                'image_url'=> URL::to('img/player.png'),
                'last_claim'=>date("Y-m-d H:i:s", time()-86400),
                'referral_code'=>Str::random(6),
                ]);
                $player->referral_code = $player->referral_code.$player->id;
                $player->save();
                $result['success'] = 'done';
                $result['message'] = 'New Player Created Successfully!';
                echo json_encode($result);
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    /**
     * Complete Player Profile Infos
     *
     * @param  \App\player  $player
     * @return \Illuminate\Http\Response
     */
    public function completeInfos(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($request->key==$api_key) {
        $user = Player::where('email_or_phone', '=', $request->email)->first();
        $user->username = $request->username;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->instagram = $request->instagram;
        $user->save();
        $result['success'] = '1';
        echo json_encode($result);
        } else {
            $result['success'] = '404';
            $result['message'] = 'You are not authenticated!';
            echo json_encode($result); 
        }
    }

    /**
     * Change player profile Image.
     *
     * @param  \App\player  $player
     * @return \Illuminate\Http\Response
     */
    public function changeImage(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($request->key==$api_key) {
            $player = Player::all()->where('email_or_phone', $request->email)->first();
    // Get image string posted from Android App
    $base=$request->image;
    $filename = $player->id.Str::random(10);
    $binary=base64_decode($base);
    header('Content-Type: bitmap; charset=utf-8');
    $file = fopen('uploads/players/'.$filename, 'wb');
    fwrite($file, $binary);
    fclose($file);
    $player->image_url = URL::to("uploads/players/".$filename);
    $player->save();
    $result['success'] = '1';
    $result['image'] = URL::to("uploads/players/".$filename);
    echo json_encode($result);
        } else {
            $result['success'] = '404';
            $result['message'] = 'You are not authenticated!';
            echo json_encode($result); 
        }
    }

    /**
     * Login chef.
     *
     * @param  \App\chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function loginPlayerWithEmail(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($request->key==$api_key) {
            // Get Data From request
        $email = $request->email;
        $password = $request->password;

        $checkPassword = "";

        // Check if player exists 
        $player = Player::where('email_or_phone', '=', $email)->first();

        if ( $player == null ) {
            $result['success'] = 'emailError';
            $result['email_error'] = 'Sorry! No Player with this Email!';
            echo json_encode($result);
        } else {
            // Check Password
            if (Hash::check($password,$player->password)) {
                $checkPassword = "true";
            } 
            else {
                $checkPassword = "false";
            }
            // Password Error
            if ( $player && $checkPassword == "false") {
                $result['success'] = 'passwordError';
                $result['password_error'] = 'Sorry! This password is not valid';
                echo json_encode($result);
            }
            // If No Errors
            if ( $player && $checkPassword == "true") {
                $result['success'] = '1';
                $result['message'] = 'Your Are Logged Successfully';
            echo json_encode($result);
            }
        }
        } else {
           $result['success'] = '404';
           $result['message'] = 'You are not authenticated!';
           echo json_encode($result); 
        }
    }

    /**
     * show best players
     *
     * @param  \App\Player $player
     * @return \Illuminate\Http\Response
     */
    public function bestPlayers($key) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
            return PlayersCollection::collection(Player::orderBy('total_score', 'desc')->take(15)->get());
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }


/**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function verifyUserSituation(Request $request)
    {
        $api_key = Setting::find(1)->api_secret_key;
        if ($request->key==$api_key) {
            // Get Data From request
        $email = $request->email;
        // Check if player exists 
        $player = Player::where(['email_or_phone'=>$request->email,'blocked'=>"no"])->first();
        if ( $player == null ) {
            $result['success'] = 'deleted';
            $result['message_error'] = 'Sorry! Your account is blocked!';
            echo json_encode($result);
        } else {
            $result['success'] = 'loggedSuccess';
            $result['message'] = 'This user Still in Database';
            echo json_encode($result);
        }
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function getPlayerData(Request $request)
    {
        $api_key = Setting::find(1)->api_secret_key;
        if ($request->key==$api_key) {
            $email = $request->email;
            $player = PlayersResource::collection(Player::where('email_or_phone', '=', $email)->get());
            echo json_encode($player);
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }

    }

    /**
     * Display list of Players By score
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function firstAndSecondAndTirthPlayers($key) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
            $players = Player::orderBy('total_score', 'desc')->take(3)->get();
            return PlayersCollection::collection($players);
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    /**
     * Display list of Players By score
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function allPlayersLeaderBoards($key) {

        $api_key = Setting::find(1)->api_secret_key;
        if ($key==$api_key) {
            $players = Player::orderBy('total_score', 'desc')->skip(3)->take(47)->get();
        return PlayersCollection::collection($players);
        } else {
            $result['success'] = 'api_error';
            $result['message'] = 'You are not allowed to do this operation!';
            echo json_encode($result);
        }
    }

    /**
     * Complete Player Profile Infos
     *
     * @param  \App\player  $player
     * @return \Illuminate\Http\Response
     */
    public function changeCoins(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        $hintcoins = Setting::find(1)->hint_coins;
        if ($request->key==$api_key) {
        $user = Player::where('email_or_phone', '=', $request->email)->first();
        if ($user->coins>=$hintcoins) {
            $user->coins = $user->coins - $hintcoins;
        $user->save();
        $result['success'] = '1';
        echo json_encode($result);
        } else {
            $result['success'] = '0';
        echo json_encode($result);
        }
        } else {
            $result['success'] = '404';
            $result['message'] = 'You are not authenticated!';
            echo json_encode($result); 
        }
    }

    /**
     * Complete Player Profile Infos
     *
     * @param  \App\player  $player
     * @return \Illuminate\Http\Response
     */
    public function addCoins(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        $free_coins = Setting::find(1)->video_ad_coins;
        $hintcoins = Setting::find(1)->hint_coins;
        if ($request->key==$api_key) {
        $user = Player::where('email_or_phone', '=', $request->email)->first();
        $user->coins = $user->coins + $free_coins;
        $user->save();
        $result['success'] = '1';
            echo json_encode($result); 
        } else {
            $result['success'] = '404';
            $result['message'] = 'You are not authenticated!';
            echo json_encode($result); 
        }
    }
    /**
     * Complete Player Profile Infos
     *
     * @param  \App\player  $player
     * @return \Illuminate\Http\Response
     */
    public function addPointsandMakeQuestionCompleted(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        $conversion_rate = Setting::find(1)->conversion_rate;
        $user = Player::where('email_or_phone', '=', $request->email)->first();

        if ($request->key==$api_key) {
            // Check If Completed Option is Set To Yes or No
            $completed_option = Setting::find(1)->completed_option;
            if ($completed_option=="yes") {
                // Check if this question is already completed or not
                $completed = Completedquestion::where([
                'question_id'=>$request->question_id,
                'player_id'=>$user->id,
                'quiz_id'=>$request->quiz_id,
                'subcategory_id'=>$request->subcategory_id,
                'category_id'=>$request->category_id,
                'points'=>$request->points,
                'question_type'=>"text",
                ])->first();
                if ($completed) {
                    $result['success'] = 'finish';
                    echo json_encode($result); 
                } else {
                    $user->actual_score = $user->actual_score + (int) $request->points;
                    $user->total_score = $user->total_score + (int) $request->points;
                    $user->earnings_actual = $user->actual_score / $conversion_rate;
                    $user->save();

                    Completedquestion::create([
                    'question_id'=>$request->question_id,
                    'player_id'=>$user->id,
                    'quiz_id'=>$request->quiz_id,
                    'subcategory_id'=>$request->subcategory_id,
                    'category_id'=>$request->category_id,
                    'points'=>$request->points,
                    'question_type'=>"text",
                    ]);
                    $continue = Continuequiz::where([
                        'quiz_id'=>$request->quiz_id,
                        'player_id'=>$user->id
                        ])->first();
                    if ($continue) {
                        $result['success'] = '1';
                        $result['actual_score'] = $user->actual_score;
                        echo json_encode($result);
                    } else {
                        $myquizName = Quiz::find($request->quiz_id)->name;
                        $myquizImage = Quiz::find($request->quiz_id)->image_url;
                        Continuequiz::create([
                        'quiz_id'=>$request->quiz_id,
                        'quiz_name'=>$myquizName,
                        'quiz_image_url'=>$myquizImage,
                        'subcategory_id'=>$request->subcategory_id,
                        'category_id'=>$request->category_id,
                        'player_id'=>$user->id,
                        ]);
                        $result['success'] = '1';
                        $result['actual_score'] = $user->actual_score;
                        echo json_encode($result);
                    }
                }
            } else {
                // Completed Option is set to NO - Add Points to user
                $user = Player::where('email_or_phone', '=', $request->email)->first();
                $user->actual_score = $user->actual_score + (int) $request->points;
                $user->total_score = $user->total_score + (int) $request->points;
                $user->earnings_actual = $user->actual_score / $conversion_rate;
                $user->save();
                $result['success'] = '2';
                $result['actual_score'] = $user->actual_score;
                echo json_encode($result);
            }
        } else {
            $result['success'] = '404';
            $result['message'] = 'You are not authenticated!';
            echo json_encode($result); 
        }
    }

    /**
     * Complete Player Profile Infos
     *
     * @param  \App\player  $player
     * @return \Illuminate\Http\Response
     */
    public function addPointsandMakeImageQuestionCompleted(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        $conversion_rate = Setting::find(1)->conversion_rate;
        $user = Player::where('email_or_phone', '=', $request->email)->first();

        if ($request->key==$api_key) {
            // Check If Completed Option is Set To Yes or No
            $completed_option = Setting::find(1)->completed_option;
            if ($completed_option=="yes") {
                // Check if this question is already completed or not
                $completed = Completedquestion::where([
                'question_id'=>$request->question_id,
                'player_id'=>$user->id,
                'quiz_id'=>$request->quiz_id,
                'subcategory_id'=>$request->subcategory_id,
                'category_id'=>$request->category_id,
                'points'=>$request->points,
                'question_type'=>"image",
                ])->first();
                if ($completed) {
                    $result['success'] = 'finish';
                    echo json_encode($result); 
                } else {
                    $user->actual_score = $user->actual_score + (int) $request->points;
                    $user->total_score = $user->total_score + (int) $request->points;
                    $user->earnings_actual = $user->actual_score / $conversion_rate;
                    $user->save();

                    Completedquestion::create([
                    'question_id'=>$request->question_id,
                    'player_id'=>$user->id,
                    'quiz_id'=>$request->quiz_id,
                    'subcategory_id'=>$request->subcategory_id,
                    'category_id'=>$request->category_id,
                    'points'=>$request->points,
                    'question_type'=>"image",
                    ]);
                    $continue = Continuequiz::where([
                        'quiz_id'=>$request->quiz_id,
                        'player_id'=>$user->id
                        ])->first();
                    if ($continue) {
                        $result['success'] = '1';
                        $result['actual_score'] = $user->actual_score;
                        echo json_encode($result);
                    } else {
                        $myquizName = Quiz::find($request->quiz_id)->name;
                        $myquizImage = Quiz::find($request->quiz_id)->image_url;
                        Continuequiz::create([
                        'quiz_id'=>$request->quiz_id,
                        'quiz_name'=>$myquizName,
                        'quiz_image_url'=>$myquizImage,
                        'subcategory_id'=>$request->subcategory_id,
                        'category_id'=>$request->category_id,
                        'player_id'=>$user->id,
                        ]);
                        $result['success'] = '1';
                        $result['actual_score'] = $user->actual_score;
                        echo json_encode($result);
                    }
                }
            } else {
                // Completed Option is set to NO - Add Points to user
                $user = Player::where('email_or_phone', '=', $request->email)->first();
                $user->actual_score = $user->actual_score + (int) $request->points;
                $user->total_score = $user->total_score + (int) $request->points;
                $user->earnings_actual = $user->actual_score / $conversion_rate;
                $user->save();
                $result['success'] = '2';
                $result['actual_score'] = $user->actual_score;
                echo json_encode($result);
            }
        } else {
            $result['success'] = '404';
            $result['message'] = 'You are not authenticated!';
            echo json_encode($result); 
        }
    }

    /**
     * Complete Player Profile Infos
     *
     * @param  \App\player  $player
     * @return \Illuminate\Http\Response
     */
    public function addPointsandMakeAudioQuestionCompleted(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        $conversion_rate = Setting::find(1)->conversion_rate;
        $user = Player::where('email_or_phone', '=', $request->email)->first();

        if ($request->key==$api_key) {
            // Check If Completed Option is Set To Yes or No
            $completed_option = Setting::find(1)->completed_option;
            if ($completed_option=="yes") {
                // Check if this question is already completed or not
                $completed = Completedquestion::where([
                'question_id'=>$request->question_id,
                'player_id'=>$user->id,
                'quiz_id'=>$request->quiz_id,
                'subcategory_id'=>$request->subcategory_id,
                'category_id'=>$request->category_id,
                'points'=>$request->points,
                'question_type'=>"audio",
                ])->first();
                if ($completed) {
                    $result['success'] = 'finish';
                    echo json_encode($result); 
                } else {
                    $user->actual_score = $user->actual_score + (int) $request->points;
                    $user->total_score = $user->total_score + (int) $request->points;
                    $user->earnings_actual = $user->actual_score / $conversion_rate;
                    $user->save();

                    Completedquestion::create([
                    'question_id'=>$request->question_id,
                    'player_id'=>$user->id,
                    'quiz_id'=>$request->quiz_id,
                    'subcategory_id'=>$request->subcategory_id,
                    'category_id'=>$request->category_id,
                    'points'=>$request->points,
                    'question_type'=>"audio",
                    ]);
                    $continue = Continuequiz::where([
                        'quiz_id'=>$request->quiz_id,
                        'player_id'=>$user->id
                        ])->first();
                    if ($continue) {
                        $result['success'] = '1';
                        $result['actual_score'] = $user->actual_score;
                        echo json_encode($result);
                    } else {
                        $myquizName = Quiz::find($request->quiz_id)->name;
                        $myquizImage = Quiz::find($request->quiz_id)->image_url;
                        Continuequiz::create([
                        'quiz_id'=>$request->quiz_id,
                        'quiz_name'=>$myquizName,
                        'quiz_image_url'=>$myquizImage,
                        'subcategory_id'=>$request->subcategory_id,
                        'category_id'=>$request->category_id,
                        'player_id'=>$user->id,
                        ]);
                        $result['success'] = '1';
                        $result['actual_score'] = $user->actual_score;
                        echo json_encode($result);
                    }
                }
            } else {
                // Completed Option is set to NO - Add Points to user
                $user = Player::where('email_or_phone', '=', $request->email)->first();
                $user->actual_score = $user->actual_score + (int) $request->points;
                $user->total_score = $user->total_score + (int) $request->points;
                $user->earnings_actual = $user->actual_score / $conversion_rate;
                $user->save();
                $result['success'] = '2';
                $result['actual_score'] = $user->actual_score;
                echo json_encode($result);
            }
        } else {
            $result['success'] = '404';
            $result['message'] = 'You are not authenticated!';
            echo json_encode($result); 
        }
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function checkLastClaim(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($request->key==$api_key) {
        $player = Player::find($request->user_id);
        $old = $player->last_claim;
        $now = date("Y-m-d H:i:s");
        $datetime1 = strtotime($old); // convert to timestamps
        $datetime2 = strtotime($now); // convert to timestamps
        $hours = (int)(($datetime2 - $datetime1)/3600);
        if ($hours>=24) {
           $result['success'] = "dazt";
           echo json_encode($result);
        } else {
            $result['success'] = "mazal";
           echo json_encode($result);
        }
    }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chef  $chef
     * @return \Illuminate\Http\Response
     */
    public function addDailyRewardCoins(Request $request) {
        $api_key = Setting::find(1)->api_secret_key;
        if ($request->key==$api_key) {
        $user = Player::where('email_or_phone', '=', $request->email)->first();
        $coinsToAdd = Setting::find(1)->daily_reward;
        $user->coins = $user->coins+$coinsToAdd;
        $now = date("Y-m-d H:i:s");
        $user->last_claim = $now;
        $user->save();
        $result['success'] = $coinsToAdd;
        echo json_encode($result);
    }
}

}
