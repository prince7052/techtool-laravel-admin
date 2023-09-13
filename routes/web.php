<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\DataimpexpController;
use App\Http\Controllers\Social_site\whatsapp;
use App\Http\Controllers\Social_site\gmail;
use App\Http\Controllers\PostGuzzleController;
use App\Http\Controllers\User\User_singleController;


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
    return redirect()->route('login');
});

Auth::routes(['register' => false]); 


Route::group(['middleware' => ['auth']], function() {
Route::get('/check',[DashboardsController::class, 'index'])->middleware(['auth'])->name('check'); 
Route::get('/home',[DashboardsController::class, 'index'])->middleware(['auth'])->name('home'); 
});

Route::group(['middleware' => ['guest']], function() {

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::get('/', [LoginController::class, 'index']);
Route::post('/check', [LoginController::class, 'check'])->name('check');
});

// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::get('/detail-admin', [HomeController::class, 'getProfile_admin'])->name('detail-admin');
    Route::get('/detail-user', [HomeController::class, 'getProfile_user'])->name('detail-user');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});



// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);

// Users 
Route::middleware('auth')->prefix('users')->name('users.')->group(function(){
    Route::get('/import_list', [DataimpexpController::class, 'index'])->name('import_list');
    Route::get('/', [UserController::class, 'index'])->name('index'); 
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::get('/remark-list', [UserController::class, 'remark_list'])->name('remark-list');
    Route::get('/dropdown-manage', [UserController::class, 'dropdown_manage'])->name('dropdown-manage');
    Route::post('/option-store', [UserController::class, 'option_store'])->name('option-store');
    Route::post('/posts-users', [UserController::class, 'posts_users'])->name('posts-users');
    Route::post('/update-token', [UserController::class, 'update_token'])->name('update-token');
    Route::get('/user_remark_list/{dist}', [UserController::class, 'user_remark_list'])->name('user_remark_list');
    Route::get('/pending_remark_list/{dist}', [UserController::class, 'pending_remark_list'])->name('pending_remark_list');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('destroy');
    Route::get('/delete-option/{id}', [UserController::class, 'delete_option'])->name('delete-option'); 
    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');
    Route::get('/whatsapp-token', [UserController::class, 'whatsapp_token'])->name('whatsapp-token');



    
    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [DataimpexpController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [UserController::class, 'export'])->name('export');

});

Route::middleware('auth')->prefix('media')->name('media.')->group(function(){
    Route::get('/whatsapp', [whatsapp::class, 'index'])->name('whatsapp');
    Route::get('/mail', [gmail::class, 'index'])->name('mail');
    Route::post('/posts',[whatsapp::class,'store']); 
    Route::post('/store',[gmail::class,'store']); 
});

Route::middleware('auth')->prefix('user')->name('user.')->group(function(){
    Route::get('/list', [User_singleController::class, 'user_list'])->name('list');
    Route::post('/called', [User_singleController::class, 'one_data_update'])->name('called');
    Route::get('/call', [User_singleController::class, 'one_data_lst'])->name('call');
    Route::get('/complete-remark-list', [User_singleController::class, 'complete_remark_list'])->name('complete-remark-list');
    Route::get('/pending-remark-list', [User_singleController::class, 'pending_remark_list'])->name('pending-remark-list');
    Route::post('/send-msg',[whatsapp::class,'send_msg']); 
});


