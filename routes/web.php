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
// Route::get('/home', function () {
//     return view('home');
// })->name('home');
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
// Route::get('/search', function () {
//     return view('search');
// });

Route::group(['prefix' => 'searchBar', 'as' => 'searchBar.'], function () {
    Route::get(
        '/',
        [SearchController::class, 'index']
    )->name('index');

    Route::get(
        'search',
        [SearchController::class, 'search']
    )->name('search');

    Route::get(
        'show',
        [SearchController::class, 'show']
    )->name('show');
});
// Route::get('/datatest', [Events::class, 'testData']);

Route::get('page/{id}', [SearchController::class, 'pages'])->name('pages');

Route::get("/contact", [ContactController::class, 'showContactPage']);
Route::post("/contact", [ContactController::class, 'contact']);
Route::post('/contact', [ContactController::class, 'addFeedback'])->name('contact.submit');


//Events
Route::get('/events', [EventController::class, 'index'])->name('events.index'); // List all events
Route::get('/events/create', [EventController::class, 'create'])->name('events.create'); // Show create form
Route::post('/events', [EventController::class, 'store'])->name('events.store'); // Store new event
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show'); // Show single event
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit'); // Show edit form
Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update'); // Update event
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy'); // Delete event

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
    Route::get('/organiser/dashboard', [OrganiserController::class, 'index'])->name('organiser.dashboard');
});

// Requester Dashboard Route
Route::middleware(['auth', 'role:requester'])->group(function () {
    Route::get('/requester/dashboard', [RequesterController::class, 'index'])->name('requester.dashboard');
});

Route::get('/organiser/event/create', [EventController::class, 'create'])
    ->name('organiser.event.create');

Route::post('/organiser/event', [EventController::class, 'store'])
    ->name('organiser.event.store');

Route::get('/organiser/event/approval', [EventController::class, 'approvalPage'])
    ->name('organiser.event.approval');

Route::post('/organiser/event/{id}/approve', [EventController::class, 'approve'])
    ->name('organiser.event.approve');

Route::post('/organiser/event/{id}/reject', [EventController::class, 'reject'])
    ->name('organiser.event.reject');

Route::get('/organiser/event/{id}', [EventController::class, 'show'])
    ->name('organiser.event.show');

Route::get('/organiser/dashboard', [EventController::class, 'dashboard'])
    ->name('organiser.dashboard');