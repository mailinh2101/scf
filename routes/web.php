<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/gioi-thieu', function () {
    return view('about');
});

Route::get('/san-pham', [ProductController::class, 'index']);

Route::get('/tin-tuc', [PostController::class, 'index']);

Route::get('/tin-tuc/{slug}', [PostController::class, 'show']);

Route::get('/lien-he', function () {
    return view('contact');
});

// Contact form submission
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

// Job application form submission
Route::post('/job-application/submit', [JobApplicationController::class, 'submit'])->name('job.application.submit');

Route::get('/tuyen-dung', [JobController::class, 'index'])->name('jobs.index');
Route::get('/tuyen-dung/{slug}', [JobController::class, 'show'])->name('jobs.show');

// support legacy /recruitment link in header by redirecting to /tuyen-dung
Route::get('/recruitment', function () {
    return redirect('/tuyen-dung');
});

// Sitemap
Route::get('/sitemap.xml', function () {
    return response()->view('sitemap', [], 200)->header('Content-Type', 'application/xml');
});
