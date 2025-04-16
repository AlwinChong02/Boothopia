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

Route::group(['prefix' => 'searchBar', 'as' => 'searchBar.'], function ()
{
    Route::get('/',
        [SearchController::class, 'index']
    )->name('index');

    Route::get('search',
        [SearchController::class, 'search']
    )->name('search');

    Route::get('show',
        [SearchController::class, 'show']
    )->name('show');
});
// Route::get('/datatest', [Events::class, 'testData']);

Route::get('page/{id}', [SearchController::class, 'pages'])->name('pages');

Route::get("/contact", [ContactController::class, 'showContactPage']);
Route::post("/contact", [ContactController::class, 'contact']);
Route::post('/contact', [ContactController::class, 'addFeedback'])->name('contact.submit');


//Booths
use App\Http\Controllers\BoothController;
Route::get('/booths', [BoothController::class, 'index']); // Fetch all booths from the database
Route::get('/booths/{id}', [BoothController::class, 'show'])->name('booths.boothbooking');
Route::post('/booths', [BoothController::class, 'store']); // Create a new booth


Route::post('/booths/{id}/book', [BoothController::class, 'book'])->name('booths.book');


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


