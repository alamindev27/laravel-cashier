<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\CheckSubscriptionController;
use App\Http\Controllers\CustomerSubscriptionController;
use App\Http\Controllers\SubscriptionController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::get('/plan/{plan}', [PlanController::class , 'show'])->name('plans.show');
    Route::post('/subscription', [SubscriptionController::class, 'create'])->name('subscription.create');

    //Routes for create Plan
    Route::get('create/plan', [SubscriptionController::class, 'createPlan'])->name('create.plan');
    Route::post('store/plan', [SubscriptionController::class, 'storePlan'])->name('store.plan');


    Route::get('show', [CheckSubscriptionController::class, 'shwoData'])->name('show');
    Route::get('resume', [CheckSubscriptionController::class, 'resume'])->name('resume');



    Route::get('customer/subscription', [CheckSubscriptionController::class, 'subscription'])->middleware('EnsureUserIsSubscribed');



    Route::get('/plans/edit/{slug}', [PlanController::class , 'edit'])->name('plans.edit');
    Route::post('/plans/update/{id}', [PlanController::class , 'update'])->name('store.update');







    Route::get('billing', function(){
        return 'this user is no subscriped';
    });


});
