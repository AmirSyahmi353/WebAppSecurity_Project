<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DemographicController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\FoodDiaryController;

use App\Http\Controllers\Admin\DietitianController as AdminDietitianController;

Route::view('/', 'welcome')->name('welcome');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/home', 'home')->name('home');
Route::view('/myscat', 'home');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register routes
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// demographic routes
Route::middleware('auth')->group(function () {
    // First-time entry
    Route::get('/demographics/create', [DemographicController::class, 'create'])->name('demographics.create');
    Route::post('/demographics', [DemographicController::class, 'store'])->name('demographics.store');

    // Update existing profile
    Route::get('/demographics/edit', [DemographicController::class, 'edit'])->name('demographics.edit');
    Route::put('/demographics/{id}', [DemographicController::class, 'update'])
    ->name('demographics.update');

    // Profile page
    Route::get('/demographics/show', [DemographicController::class, 'show'])->name('demographics.show');
});

// MySCAT Questionnaire Flow
Route::get('/questionnaire/intro', [QuestionnaireController::class, 'intro'])->name('questionnaire.intro');
Route::post('/questionnaire/start', [QuestionnaireController::class, 'start'])->name('questionnaire.start');
Route::get('/questionnaire/page/{page}', [QuestionnaireController::class, 'page'])->name('questionnaire.page');
Route::post('/questionnaire/save/{page}', [QuestionnaireController::class, 'savePage'])->name('questionnaire.savePage');
Route::get('/questionnaire/submit', [QuestionnaireController::class, 'submit'])->name('questionnaire.submit');
// Route::get('/result', [ResultController::class, 'show'])->name('result.show');

Route::middleware('auth')->group(function () {
    // Food diary info/introduction page
    Route::get('/food-diary/info', [FoodDiaryController::class, 'info'])->name('food-diary.info');

    // Main diary page (3-day accordion)
    Route::get('/food-diary/day', [FoodDiaryController::class, 'day'])->name('food-diary.day');

    // Add meal (AJAX)
    Route::post('/food-diary/day/{day}/add-item', [FoodDiaryController::class, 'addItem'])
        ->where('day', '[1-3]')
        ->name('food-diary.day.addItem');

    // Delete meal (AJAX)
    Route::delete('/food-diary/day/{day}/{index}/delete', [FoodDiaryController::class, 'deleteItem'])
        ->where(['day' => '[1-3]', 'index' => '[0-9]+'])
        ->name('food-diary.day.delete');

    // Final submit
    Route::post('/food-diary/submit-final', [FoodDiaryController::class, 'submitFinal'])
        ->name('food-diary.submitFinal');

    Route::get('/food-diary/view', [FoodDiaryController::class, 'view'])
    ->name('food-diary.index');

    Route::get('/result', [QuestionnaireController::class, 'showResult'])
     ->name('result.show');

    Route::get('/food-diary/view', [FoodDiaryController::class, 'view'])
     ->name('food-diary.view');


});

// terms-policy page
Route::get('/terms-policy', function () {
    return view('terms-policy'); // the blade file you’ll create
})->name('terms-policy');

// Contact Us page
Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

// Home page placeholder (after login if demographic exists)
Route::get('/home', function() {
    return view('home'); 
})->middleware('auth')->name('home');

// ---------------- ADMIN AUTH ----------------
use App\Http\Controllers\Admin\AdminAuthController;

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');


// ---------------- ADMIN PROTECTED PAGES ----------------
Route::middleware(['auth','admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('dietitians', AdminDietitianController::class);
    });








