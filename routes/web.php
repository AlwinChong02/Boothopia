<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganiserController;
use App\Http\Controllers\RequesterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoothController;
use App\Http\Controllers\BoothBookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ApprovalController;


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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/navigationbar', function () {
    return view('navigationbar');
});
Route::get('/footer', function () {
    return view('footer');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/about', function () {
    return view('about');
});

Route::group(['prefix' => 'searchBar', 'as' => 'searchBar.'], function () {

    Route::get(
        'search',
        [SearchController::class, 'search']
    )->name('search');

    Route::get(
        'show',
        [SearchController::class, 'show']
    )->name('show');
});

Route::get("/contact", [ContactController::class, 'showContactPage']);
Route::post('/contact', [ContactController::class, 'addFeedback'])->name('contact.submit');


//Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])
    ->whereNumber('id')
    ->name('events.show');

Route::middleware(['auth','role:organiser'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])
        ->name('organiser.events.create');
    Route::post('/events', [EventController::class, 'store'])
        ->name('events.store');
    Route::post('/events/{event}/cancel',[EventController::class, 'cancel'])->name('events.cancel');
});

Route::middleware(['auth','role:admin|organiser'])->group(function () {
    Route::put('/events/{id}', [EventController::class, 'update'])
        ->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])
        ->name('events.destroy');
});

// Event booth booking routes
Route::get('/events/{event}/booking', [BoothBookingController::class, 'showBooking'])->name('events.booking');
Route::post('/events/{event}/booking', [BoothBookingController::class, 'processBooking'])->name('events.booking.process');
Route::get('/booking/payment', [BoothBookingController::class, 'showPayment'])->name('booking.payment');

// Payment approval image upload
Route::post('/payment/approval', [PaymentController::class, 'uploadApproval'])->name('payment.approval');

//login part
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->withoutMiddleware('auth');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/profile', [UserController::class, 'show'])->name('profile');
Route::get('/user/update/{id}', [UserController::class, 'showUpdateUserForm'])->name('user.updateForm');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');

// Admin Dashboard Route
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/user/userList', [UserController::class, 'index'])->name('userList');
    Route::get('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
});

// Organiser Dashboard Route
Route::middleware(['auth', 'role:organiser'])->group(function () {
    Route::get('/organiser/dashboard', [OrganiserController::class, 'dashboard'])->name('organiser.dashboard');
    Route::get('/organiser/events/upcoming', [OrganiserController::class, 'upcoming'])->name('organiser.events.upcoming');
    Route::get('/organiser/events/ongoing', [OrganiserController::class, 'ongoing'])->name('organiser.events.ongoing');
    Route::get('/organiser/events/canceled', [OrganiserController::class, 'canceled'])->name('organiser.events.canceled');
    Route::get('/organiser/events/all', [OrganiserController::class, 'all'])->name('organiser.events.all');
});

// Requester Dashboard Route
Route::middleware(['auth', 'role:requester'])->group(function () {
    Route::get('/requester/dashboard', [RequesterController::class, 'index'])->name('requester.dashboard');
});

Route::get('/events/create', [EventController::class, 'create'])
    ->name('organiser.event.create');

Route::post('/events', [EventController::class, 'store'])
    ->name('organiser.event.store');

Route::middleware(['auth', 'role:organiser'])->group(function () {
    Route::get('/organiser/approval', [ApprovalController::class, 'index'])->name('organiser.approval');
    Route::post('/organiser/approval/{id}/approve', [ApprovalController::class, 'approve'])->name('organiser.approval.approve');
    Route::post('/organiser/approval/{id}/reject', [ApprovalController::class, 'reject'])->name('organiser.approval.reject');
});
