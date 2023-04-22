<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CommandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Front\CustomerController;
use App\Http\Controllers\Front\WelcomeController;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
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

//home
Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::post('/registration', [WelcomeController::class, 'register']);
Route::post('/entreprise', [WelcomeController::class, 'entreprise']);

Route::get('logout',  function () {
    Auth::logout();

    return redirect('login');
});

Route::get('503', function () {
    return 'Accès non autorisé';
});

Route::get('404', function () {
    return 'Page non trouvée';
});
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/profil');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return redirect('/profil')->with('error', "Vous devez verifier votre email pour accéder à cette page.");
})->middleware('auth')->name('verification.notice');

Route::get('/email/verification-notification', function () {
    $user = User::find(auth()->user()->id);
    $user->sendEmailVerificationNotification();

    return back()->with('success', 'Le lien de vérification a été envoyé. Consultez votre boîte mail (les spams également) pour valider votre email.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::post('/notification/ebilling', [WelcomeController::class, 'notify_ebilling'])->name('notification-ebilling-payment');
Route::get('/callback/ebilling/{entity}', [WelcomeController::class, 'callback_ebilling'])->name('ebilling-payment');

Route::get('/lang', [WelcomeController::class, 'lang'])->name('changeLang');

Route::middleware('auth')->group(function () {

});

/*
| Backend
*/
Route::prefix('admin')->namespace('Admin')->middleware('admin')->group(function () {

    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/', [DashboardController::class, 'dashboard']);
    Route::get('/notifications', [DashboardController::class, 'notifications']);

    //entreprise
    Route::get('/list-registrations', [DashboardController::class, 'index'])->name('admin-list-registrations');
    Route::get('/add-registration', [DashboardController::class, 'add'])->name('admin-add-registration');
    Route::post('/create-registration', [DashboardController::class, 'create'])->name('admin-create-registration');
    Route::post('/registration/{registration}', [DashboardController::class, 'update'])->name('admin-update-registration');
    Route::get('/ajax-registrations', [DashboardController::class, 'ajaxRegistrations'])->name('admin-ajax-registrations');
    Route::post('/ajax-registration', [DashboardController::class, 'getRegistration'])->name('admin-ajax-registration');

    //users
    Route::get('/admin-profil', [UserController::class, 'profil'])->name('admin-profil');
    Route::get('/list-admins', [UserController::class, 'admins']);
    Route::get('/list-superviseurs', [UserController::class, 'superviseurs']);
    Route::get('/add-user', [UserController::class, 'add']);
    Route::post('/create-user', [UserController::class, 'create']);
    Route::post('/update-user/{user}', [UserController::class, 'update']);

    //role
    Route::get('security-role', [SecurityRoleController::class, 'index']);
    Route::get('security-role/delete/{_id}', [SecurityRoleController::class, 'delete']);
    Route::post('security-role', [SecurityRoleController::class, 'save']);
    Route::get('security-role/edit/{_id}', [SecurityRoleController::class, 'edit']);

    Route::get('security-object', [SecurityObjectController::class, 'index']);
    Route::get('security-object/delete/{_id}', [SecurityObjectController::class, 'delete']);
    Route::post('security-object', [SecurityObjectController::class, 'save']);
    Route::get('security-object/edit/{_id}', [SecurityObjectController::class, 'edit']);

    Route::get('security-permission', [SecurityPermissionController::class, 'index']);
    Route::get('security-permission/delete/{_id}', [SecurityPermissionController::class, 'delete']);
    Route::post('security-permission', [SecurityPermissionController::class, 'save']);
    Route::post('security-permission/edit/{_id}', [SecurityRoleController::class, 'permission']);

    //payment
    Route::get('/list-payments', [PaymentController::class, 'index'])->name('admin-list-payments');
    Route::post('/payment/{payment}', [PaymentController::class, 'update'])->name('admin-update-payment');
    Route::get('/ajax-payments', [PaymentController::class, 'ajaxPayments'])->name('admin-ajax-payments');
    Route::post('/ajax-payment', [PaymentController::class, 'getPayment'])->name('admin-ajax-payment');

    //payout
    Route::get('/list-payouts', [PayoutController::class, 'index'])->name('admin-list-payouts');
    Route::post('/payout/{payout}', [PayoutController::class, 'update'])->name('admin-update-payout');
    Route::get('/ajax-payouts', [PayoutController::class, 'ajaxPayouts'])->name('admin-ajax-payouts');
    Route::post('/ajax-payout', [PayoutController::class, 'getPayout'])->name('admin-ajax-payout');

});

