<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Ads Api Routes
    Route::get('/ads/ids/{key}', 'ApiAdsController@getadsIds');
    Route::get('/lang/{key}', 'ApiAdsController@lang');

// Players Api Routes
    Route::post('/players/before/verify/email', 'ApiPlayersController@verifyIfEmailDoesNotExistAndNotBlocked');
    Route::post('/players/email/block', 'ApiPlayersController@blockThisEmail');
    Route::post('/players/email/add', 'ApiPlayersController@addNewPlayer');
    Route::post('/players/email/referral', 'ApiPlayersController@approveReferral');
    Route::post('/players/facebook/add', 'ApiPlayersController@addNewPlayerViaFb');
    Route::post('/players/google/add', 'ApiPlayersController@addNewPlayerViaGoogle');
    Route::post('/players/otp/verify', 'ApiPlayersController@verifyIfPlayerExistOtp');
    Route::post('/players/otp/add', 'ApiPlayersController@addNewPlayerViaOtp');
    Route::post('/players/image/upload', 'ApiPlayersController@changeImage');
    Route::post('/players/complete', 'ApiPlayersController@completeInfos');
    Route::post('/players/login', 'ApiPlayersController@loginPlayerWithEmail');
    Route::get('/players/best/15/{key}', 'ApiPlayersController@bestPlayers');
    Route::post('/players/situation', 'ApiPlayersController@verifyUserSituation');
    Route::post('/players/getplayerdata', 'ApiPlayersController@getPlayerData');
    Route::get('/players/firsts/{key}', 'ApiPlayersController@firstAndSecondAndTirthPlayers');
    Route::get('/players/leaderboards/{key}', 'ApiPlayersController@allPlayersLeaderBoards');
    Route::post('/players/coins/change', 'ApiPlayersController@changeCoins');
    Route::post('/players/coins/add', 'ApiPlayersController@addCoins');
    Route::post('/players/points', 'ApiPlayersController@addPointsandMakeQuestionCompleted');
    Route::post('/players/points/image', 'ApiPlayersController@addPointsandMakeImageQuestionCompleted');
    Route::post('/players/points/audio', 'ApiPlayersController@addPointsandMakeAudioQuestionCompleted');
    Route::post('/players/coins/daily', 'ApiPlayersController@addDailyRewardCoins');
    Route::post('/players/reward/last/claim/check', 'ApiPlayersController@checkLastClaim');

// Categories Api Routes
    Route::get('/categories/popular/{key}', 'ApiCategoriesController@showPopularCategories');
    Route::get('/categories/all/{key}', 'ApiCategoriesController@showAllCategories');

// Quizzes To Continue Api Routes
    Route::get('/{player_id}/quizzes/continue/{key}', 'ApiContinueQuizzesController@getPlayerContinueQuizzes');

// Quizzes Api Routes
    Route::get('/quizzes/recent/{key}', 'ApiQuizzesController@showRecentQuizzes');
    Route::get('/quizzes/{subcategory}/{key}', 'ApiQuizzesController@getSubcategoryQuizzes');

// Daily Quiz Api Routes
    Route::post('/quiz/daily/get', 'ApiDailyController@getDailyQuiz');

// Quiz Questions Api Routes
    Route::get('/quiz/daily/questions/text/{id}/{key}', 'ApiDailyController@getDailyQuizTextQuestions');
    Route::get('/quiz/daily/questions/image/{id}/{key}', 'ApiDailyController@getDailyQuizImageQuestions');
    Route::get('/quiz/daily/questions/audio/{id}/{key}', 'ApiDailyController@getDailyQuizAudioQuestions');

// Withdraws Api Routes
    Route::get('/withdraws/{player_id}/{key}', 'ApiWithdrawsController@getWithdraws');
    Route::post('/withdraws/request/send', 'ApiWithdrawsController@sendRequestWithdraw');

// Payment Methods Api Routes
    Route::get('/paymentmethods/{key}', 'ApiPaymentMethodsController@paymentMethods');

// Refers Api Routes
    Route::get('/refers/{referred_source_id}/{key}', 'ApiRefersController@getRefers');

// Subcategories Api Routes
    Route::get('/categories/subcategories/{id}/{key}', 'ApiSubcategoriesController@showSubcategories');

// Text Questions Api Routes
    Route::post('/questions/text/completed/check', 'ApiQuestionsController@checkIfTextQuestionIsCompleted');
    Route::post('/questions/image/completed/check', 'ApiQuestionsController@checkIfImageQuestionIsCompleted');
    Route::post('/questions/audio/completed/check', 'ApiQuestionsController@checkIfAudioQuestionIsCompleted');
    Route::get('/quizzes/questions/completed/{quiz}/{player}/{key}', 'ApiQuestionsController@getCompletedQuestionsForSingleQuiz');
