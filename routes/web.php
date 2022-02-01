<?php

//*/
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AjaxContactController;
use App\Http\Controllers\AjaxUploadMultipleImageController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\StripePaymentController;

use Illuminate\Http\Request;

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


//ROUTE FOR AUTHENTICATE***********Scaffolding******************
Auth::routes();

//*
Route::get('/dashboard', function() {
    return view('view_admin.dashboard');
})->middleware('auth')->name('dashboard');
//

// END ***************** Rick and Morty API *********************
Route::get('/dashbord', function(){
    return view('view_admin.dashboard');
    })->middleware('auth')->name('view.option');
    
Route::get('/', function(){
    return view('view_admin.dashboard');
    })->middleware('auth')->name('view.option');

Route::get('/crap', [\App\Http\Controllers\AppController::class, 'crapCharacter'])->name('crapCharacter');
Route::get('/character', [\App\Http\Controllers\AppController::class, 'showCharacter'])->name('characters.show');
Route::get('/episode', [\App\Http\Controllers\AppController::class, 'showEpisode'])->name('episodes.show');
Route::get('/location', [\App\Http\Controllers\AppController::class, 'showLocation'])->name('locations.show');
// END ***************** Rick and Morty API *********************
