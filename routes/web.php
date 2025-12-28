<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PatientController;

// ---------------- AUTH CONTROLLERS ----------------
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// ---------------- USER CONTROLLERS ----------------
use App\Http\Controllers\DemographicController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\FoodDiaryController;

// ---------------- ADMIN CONTROLLERS ----------------
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DietitianController as AdminDietitianController;

use App\Http\Controllers\Dietitian\DashboardController;
use App\Http\Controllers\Dietitian\DietitianAuthController;
use App\Http\Controllers\Dietitian\ResultController as DietitianResultController;
/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('welcome');

// Terms & Contact pages
Route::view('/terms-policy', 'terms-policy')->name('terms-policy');
Route::view('/contact-us', 'contact')->name('contact');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION (LOGIN/REGISTER)
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


/*
|--------------------------------------------------------------------------
| USER HOME (AFTER LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/home', function () {
    return view('home');
})->name('home');


/*
|--------------------------------------------------------------------------
| DEMOGRAPHICS (PATIENT ONBOARDING)
|--------------------------------------------------------------------------
*/

Route::middleware([])->group(function () {

    // Create demographic (first-time)
    Route::get('/demographics/create', [DemographicController::class, 'create'])
        ->name('demographics.create');

    Route::post('/demographics', [DemographicController::class, 'store'])
        ->name('demographics.store');

    Route::get('/demographics/edit/{id?}', [DemographicController::class, 'edit'])
        ->name('demographics.edit');

    Route::put('/demographics/{id}', [DemographicController::class, 'update'])
        ->name('demographics.update');

    Route::get('/demographics/show/{id?}', [DemographicController::class, 'show'])
        ->name('demographics.show');
});


/*
|--------------------------------------------------------------------------
| MySCAT QUESTIONNAIRE
|--------------------------------------------------------------------------
*/

Route::prefix('questionnaire')->name('questionnaire.')->group(function () {
    Route::get('/intro', [QuestionnaireController::class, 'intro'])->name('intro');
    Route::post('/start', [QuestionnaireController::class, 'start'])->name('start');

    Route::get('/page/{page}', [QuestionnaireController::class, 'page'])
        ->whereNumber('page')
        ->name('page');

    Route::post('/save/{page}', [QuestionnaireController::class, 'savePage'])
        ->whereNumber('page')
        ->name('savePage');

    Route::get('/submit', [QuestionnaireController::class, 'submit'])->name('submit');
});

// Results
Route::get('/result/{id?}', [QuestionnaireController::class, 'showResult'])
    ->name('result.show');


/*
|--------------------------------------------------------------------------
| FOOD DIARY
|--------------------------------------------------------------------------
*/

Route::prefix('food-diary')->name('food-diary.')->group(function () {

    // Food diary info page
    Route::get('/info', [FoodDiaryController::class, 'info'])
        ->name('info');

    // Main 3-day diary page
    Route::get('/day', [FoodDiaryController::class, 'day'])
        ->name('day');

    // Add meal item
    Route::post('/day/{day}/add-item', [FoodDiaryController::class, 'addItem'])
        ->where('day', '[1-3]')
        ->name('day.addItem');

    // Delete meal item
    Route::delete('/day/{day}/{index}/delete', [FoodDiaryController::class, 'deleteItem'])
        ->where(['day' => '[1-3]', 'index' => '[0-9]+'])
        ->name('day.delete');

    // Final submit of diary
    Route::post('/submit-final', [FoodDiaryController::class, 'submitFinal'])
        ->name('submitFinal');

    // View final diary summary
    Route::get('/view', [FoodDiaryController::class, 'view'])
        ->name('view');

    // Alias: allow index to behave same as view
    Route::get('/', [FoodDiaryController::class, 'view'])
        ->name('index');

});



// Route::prefix('admin')->name('admin.')->group(function () {

//     // Admin login views & processing
//     Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
//     Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

//     // Admin logout
//     Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
// });


/*
|--------------------------------------------------------------------------
| ADMIN PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware([])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/', function () {
            return redirect()->route('admin.dietitianindex');  // List of User page
        })->name('dashboard');


        // Patients
        Route::get('/patients', [PatientController::class, 'index'])->name('patientindex');
        Route::get('/patients/{id}', [PatientController::class, 'show'])->name('patientshow');
        Route::get('/patient/{id}/profile', [PatientController::class, 'showProfile'])->name('patientprofile');

        /*
        |--------------------------------------------------------------------------
        | Dietitians CRUD (Only 1 index route name!)
        |--------------------------------------------------------------------------
        */

        // INDEX (LIST PAGE)
        Route::get('/dietitians', [AdminDietitianController::class, 'index'])
            ->name('dietitianindex');

        // CREATE FORM
        Route::get('/dietitians/create', [AdminDietitianController::class, 'create'])
            ->name('dietitians.create');

        // STORE ACTION
        Route::post('/dietitians', [AdminDietitianController::class, 'store'])
            ->name('dietitians.store');

        // EDIT FORM
        Route::get('/dietitians/{id}/edit', [AdminDietitianController::class, 'edit'])
            ->name('dietitians.edit');

        // UPDATE ACTION
        Route::put('/dietitians/{id}', [AdminDietitianController::class, 'update'])
            ->name('dietitians.update');

        // DELETE
        Route::delete('/dietitians/{id}', [AdminDietitianController::class, 'destroy'])
            ->name('dietitians.destroy');

        Route::get('/admin/patients/{id}/questionnaire', [AdminDietitianController::class, 'questionnaire'])
            ->name('patientquestionnaire');

        Route::get('/food-diary/{id}', [AdminDietitianController::class, 'fooddiary'])
            ->name('patientfooddiary');



    });


/*
|--------------------------------------------------------------------------
| DIETITIAN AUTH (LOGIN/LOGOUT)
|--------------------------------------------------------------------------
*/

// Route::prefix('dietitian')->name('dietitian.')->group(function () {

//     // Dietitian login
//     Route::get('/login', [DietitianAuthController::class, 'showLogin'])->name('login');
//     Route::post('/login', [DietitianAuthController::class, 'login'])->name('login.submit');

//     // Dietitian logout
//     Route::get('/logout', [DietitianAuthController::class, 'logout'])->name('logout');
// });



/*
|--------------------------------------------------------------------------
| DIETITIAN PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware([])
    ->prefix('dietitian')
    ->name('dietitian.')
    ->group(function () {

        // Dietitian dashboard (should NOT use admin dashboard)
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Add more dietitian-only features here later
        // Example:
        // Route::get('/patients', [DietitianPatientController::class, 'index'])->name('patients');

         Route::get('/results', [DietitianResultController::class, 'index'])
            ->name('results.index');

        Route::get('/results/{id}', [DietitianResultController::class, 'show'])
            ->name('results.show');
    });
