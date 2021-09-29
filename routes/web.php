<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DailyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\QuizzesController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\WithdrawsController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {

	Route::get('/', 'HomeController@index')->name('home');
	// Admins Management
    Route::get('/admins', 'AdminsController@admins')->name('admins');
    Route::post('/admins/add', 'AdminsController@newAdmin')->name('admin.add');
    Route::get('/admins/{admin}/delete', 'AdminsController@destroyAdmin')->name('admin.destroy');
    // Players Management
    Route::get('/players', 'PlayersController@players')->name('players');
    Route::post('/players/new', 'PlayersController@newPlayer')->name('players.new');
    Route::get('/players/edit/{id}', 'PlayersController@editPlayer')->name('players.edit');
    Route::post('/players/edit/{player}/update', 'PlayersController@updatePlayer')->name('players.update');
    Route::get('/players/delete/{id}', 'PlayersController@deletePlayer')->name('players.delete');
    // Categories Management
    Route::get('/categories', 'CategoriesController@categories')->name('categories');
    Route::get('/categories/delete/{id}', 'CategoriesController@deleteCategory')->name('categories.delete');
    Route::post('/categories/new', 'CategoriesController@newCategory')->name('categories.new');
    Route::post('/categories/edit/{id}', 'CategoriesController@updateCategory')->name('category.update');
    // SubCategories Management
    Route::get('/subcategories', 'SubcategoriesController@categories')->name('subcategories');
    Route::get('/subcategories/{id}', 'SubcategoriesController@subcategories')->name('subcategories.get');
    Route::post('/subcategories/{id}/new', 'SubcategoriesController@newSubcategory')->name('subcategories.new');
    Route::get('/subcategories/delete/{id}', 'SubcategoriesController@deleteSubcategory')->name('subcategories.delete');
    Route::post('/subcategories/edit/{id}', 'SubcategoriesController@updateSubcategory')->name('subcategory.update');
    // Quizzes Management
    Route::get('/quizzes', 'QuizzesController@categories')->name('quizzes');
    Route::get('/quizzes/{category}', 'QuizzesController@subcategories')->name('quizzes.subcategories');
    Route::get('/quizzes/{category}/{id}', 'QuizzesController@quizzesGet')->name('quizzes.get');
    Route::post('/quizzes/{category}/{id}/new', 'QuizzesController@newQuiz')->name('quizzes.new');
    Route::post('/quizzes/edit/{id}', 'QuizzesController@updateQuiz')->name('quizzes.update');
    Route::get('/quizzes/delete/quiz/{id}', 'QuizzesController@deleteMyQuiz')->name('quizzes.delete');
    // Daily Quizzes Management
    Route::get('/dailyquiz', 'DailyController@dailyQuiz')->name('dailyquiz');
    Route::post('/dailyquiz/add', 'DailyController@addDailyQuiz')->name('dailyquiz.add');
    Route::get('/dailyquiz/delete/{image}', 'DailyController@deleteDailyQuiz')->name('dailyquiz.delete');
    Route::get('/dailyquiz/questions/text/add', 'DailyController@addDailyQuizTextQuestionView')->name('dailyquiz.textquestion.add');
    Route::get('/dailyquiz/questions/image/add', 'DailyController@addDailyQuizImageQuestionView')->name('dailyquiz.imagequestion.add');
    Route::get('/dailyquiz/questions/audio/add', 'DailyController@addDailyQuizAudioQuestionView')->name('dailyquiz.audioquestion.add');
    Route::post('/dailyquiz/textquestion/add', 'DailyController@addDailyQuizTextQuestion')->name('dailyquiz.add.textquestion');
    Route::post('/dailyquiz/imagequestion/add', 'DailyController@addDailyQuizImageQuestion')->name('dailyquiz.add.imagequestion');
    Route::post('/dailyquiz/audioquestion/add', 'DailyController@addDailyQuizAudioQuestion')->name('dailyquiz.add.audioquestion');
    Route::get('/dailyquiz/{quiz}/questions', 'DailyController@dailyQuizQuestions')->name('dailyquiz.questions');
    Route::get('/dailyquiz/questions/delete/{id}/{type}', 'DailyController@deleteDailyQuizQuestions')->name('dailyquiz.questions.delete');
    Route::get('/dailyquiz/questions/edit/{id}/{type}', 'DailyController@showViewDailyQuizQuestions')->name('dailyquiz.questions.edit.view');
    Route::post('/dailyquiz/questions/edit/{id}/text', 'DailyController@updateDailyQuizTextQuestion')->name('dailyquiz.text.question.update');
    Route::post('/dailyquiz/questions/edit/{id}/image', 'DailyController@updateDailyQuizImageQuestion')->name('dailyquiz.image.question.update');
    Route::post('/dailyquiz/questions/edit/{id}/audio', 'DailyController@updateDailyQuizAudioQuestion')->name('dailyquiz.audio.question.update');

    // Withdraws Management
    Route::get('/withdraws', 'WithdrawsController@withdraws')->name('withdraws');
    Route::post('/withdraws/{id}/update', 'WithdrawsController@updateWithdraw')->name('withdraw.update');
    Route::get('/withdraws/{withdraw}/delete', 'WithdrawsController@deleteWithdraw')->name('withdraw.delete');

    // Payment Methods Management
    Route::get('/paymentmethods', 'PaymentMethodsController@paymentmethods')->name('paymentmethods');
    Route::get('/paymentmethods/{paymentmethod}/delete', 'PaymentMethodsController@deletePaymentMethod')->name('paymentmethod.delete');
    Route::post('/paymentmethods/add', 'PaymentMethodsController@addPaymentMethod')->name('paymentmethod.add');

    // Ads Management
    Route::get('/ads', 'AdsController@ads')->name('ads');
    Route::post('/ads/update', 'AdsController@updateAds')->name('ads.update');

    // Settings
    Route::get('/settings', 'SettingsController@settings')->name('settings');
    Route::post('/settings/update', 'SettingsController@updateSettings')->name('settings.update');

    // Text Questions Management
    Route::get('/textquestions', 'TextQuestionsController@categories')->name('textquestions.categories');
    Route::get('/textquestions/{category}', 'TextQuestionsController@subcategories')->name('textquestions.subcategories');
    Route::get('/textquestions/{category}/{subcategory}', 'TextQuestionsController@quizzes')->name('textquestions.quizzes');
    Route::get('/textquestions/{category}/{subcategory}/{quiz}', 'TextQuestionsController@questions')->name('textquestions.questions');
    Route::post('/textquestions/question/add', 'TextQuestionsController@addTextQuestion')->name('textquestions.questions.add');
    Route::post('/textquestions/question/delete', 'TextQuestionsController@deleteTextQuestion')->name('textquestions.question.delete');
    Route::post('/textquestions/question/update', 'TextQuestionsController@updateTextQuestion')->name('textquestions.questions.update');
    Route::post('/textquestions/question/bulk', 'TextQuestionsController@bulkImport')->name('textquestions.questions.bulk');

    // Images Questions Management
    Route::get('/imagequestions', 'ImageQuestionsController@categories')->name('imagequestions.categories');
    Route::get('/imagequestions/{category}', 'ImageQuestionsController@subcategories')->name('imagequestions.subcategories');
    Route::get('/imagequestions/{category}/{subcategory}', 'ImageQuestionsController@quizzes')->name('imagequestions.quizzes');
    Route::get('/imagequestions/{category}/{subcategory}/{quiz}', 'ImageQuestionsController@questions')->name('imagequestions.questions');
    Route::post('/imagequestions/question/add', 'ImageQuestionsController@addImageQuestion')->name('imagequestions.questions.add');
    Route::post('/imagequestions/question/delete', 'ImageQuestionsController@deleteImageQuestion')->name('imagequestions.question.delete');
    Route::post('/imagequestions/question/update', 'ImageQuestionsController@updateImageQuestion')->name('imagequestions.questions.update');

    // Audio Questions Management
    Route::get('/audioquestions', 'AudioQuestionsController@categories')->name('audioquestions.categories');
    Route::get('/audioquestions/{category}', 'AudioQuestionsController@subcategories')->name('audioquestions.subcategories');
    Route::get('/audioquestions/{category}/{subcategory}', 'AudioQuestionsController@quizzes')->name('audioquestions.quizzes');
    Route::get('/audioquestions/{category}/{subcategory}/{quiz}', 'AudioQuestionsController@questions')->name('audioquestions.questions');
     Route::post('/audioquestions/question/add', 'AudioQuestionsController@addAudioQuestion')->name('audioquestions.questions.add');
    Route::post('/audioquestions/question/delete', 'AudioQuestionsController@deleteAudioQuestion')->name('audioquestions.question.delete');
    Route::post('/audioquestions/question/update', 'AudioQuestionsController@updateAudioQuestion')->name('audioquestions.questions.update');
});

require __DIR__.'/auth.php';
