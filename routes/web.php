<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;

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
Route::get('/home', function () {
    return view('home');
})->name('home');
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
