<?php

use App\Http\Controllers\Frontend\BlogCommentController as FrontendCommentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\CatBlogController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\GuestAuthentication;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Auth::routes(['register' => false]);
Auth::routes(['register' => false]);


// frontend
Route::get('/', [FrontendHomeController::class, 'index'])->name('frontend');

// category
Route::get('/category/{slug}', [CatBlogController::class, 'show'])->name('frontend.cat.blog');
Route::get('/category/single/{id}', [CatBlogController::class, 'single'])->name('frontend.blog.single');

// blogs
Route::get('/blogs', [FrontendBlogController::class, 'index'])->name('frontend.blogs');
Route::get('/blog/single/{id}', [FrontendBlogController::class, 'single'])->name('frontend.blog.single');



// GuestAuthentication
Route::get('guest/login', [GuestAuthentication::class, 'login'])->name('guest.login');
Route::post('guest/login', [GuestAuthentication::class, 'login_post'])->name('guest.login');
Route::get('guest/register', [GuestAuthentication::class, 'register'])->name('guest.register');
Route::post('guest/register', [GuestAuthentication::class, 'register_post'])->name('guest.register');




// comment
Route::post('/blog/comment/{id}', [FrontendCommentController::class, 'comment'])->name('frontend.blog.comment');

Route::middleware(['auth','verified'])->group(function(){

// dashboard
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


// request
Route::post('/role/request/{id}', [RequestController::class, 'request_sent'])->name('request.sent');
// request accept
Route::get('/role/request/accept/{id}', [RequestController::class, 'request_accept'])->name('request.accept');
// request cancel
Route::get('/role/request/cancel/{id}', [RequestController::class, 'request_cancel'])->name('request.cancel');
// request show
Route::get('/role/request', [RequestController::class, 'request_show'])->name('request.show');



Route::prefix(env('HOST_NAME'))->middleware(['rolecheck'])->group(function () {
    // management
    Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
    // management user register
    Route::post('/management/user/register', [ManagementController::class, 'store_register'])->name('management.store');
    // management user down
    Route::post('/management/user/manager/down/{id}', [ManagementController::class, 'manager_down'])->name('management.down');


    // manager edit
    Route::get('/management/user/manager/edit/{id}', [ManagementController::class, 'manager_edit'])->name('manager.edit');
    // manager update
    Route::post('/management/user/manager/update/{id}', [ManagementController::class, 'manager_update'])->name('manager.update');
    // manager delete
    Route::get('/management/user/manager/delete/{id}', [ManagementController::class, 'manager_delete'])->name('manager.delete');

    // blogger edit
    Route::get('/management/blogger/edit/{id}', [ManagementController::class, 'blogger_edit'])->name('blogger.edit');
    // blogger update
    Route::post('/management/blogger/update/{id}', [ManagementController::class, 'blogger_update'])->name('blogger.update');
    // blogger delete
    Route::get('/management/blogger/delete/{id}', [ManagementController::class, 'blogger_delete'])->name('blogger.delete');



    // user edit
    Route::get('/management/user/edit/{id}', [ManagementController::class, 'user_edit'])->name('user.edit');
    // user update
    Route::post('/management/user/update/{id}', [ManagementController::class, 'user_update'])->name('user.update');
    // user delete
    Route::get('/management/user/delete/{id}', [ManagementController::class, 'user_delete'])->name('user.delete');




    // role
    Route::get('/management/role', [ManagementController::class, 'role_index'])->name('management.role.index');
    // role assign
    Route::post('/management/role/assign', [ManagementController::class, 'role_assign'])->name('management.role.assign');
    // blogger grade down
    Route::post('/management/role/undo/blogger/{id}', [ManagementController::class, 'blogger_grade_down'])->name('management.role.blogger.down');
    // user grade down
    Route::post('/management/role/undo/user/{id}', [ManagementController::class, 'user_grade_down'])->name('management.role.user.down');

    // user block list
    Route::get('/management/block/list', [ManagementController::class, 'block_list'])->name('management.block.list');
    // delete block user
    Route::get('/management/block/delete/{id}', [ManagementController::class, 'block_delete'])->name('block.delete');
});






// profile
Route::get('/home/profile', [ProfileController::class, 'index'])->name('home.profile');
// name update
Route::post('/home/profile/name/update', [ProfileController::class, 'name_update'])->name('home.profile.name.update');
// email update
Route::post('/home/profile/email/update', [ProfileController::class, 'email_update'])->name('home.profile.email.update');
// password update
Route::post('/home/profile/password/update', [ProfileController::class, 'password_update'])->name('home.profile.password.update');
// image update
Route::post('/home/profile/image/update', [ProfileController::class, 'image_update'])->name('home.profile.image.update');



Route::middleware('excess')->group(function () {

    // category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    // category insert
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    // category edit
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    // category update
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    // category delete
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    // category status
    Route::post('/category/status/{category}', [CategoryController::class, 'status'])->name('category.status');



    // blog
    Route::resource('/blog', BlogController::class);
    // blog status
    Route::post('/blog/status/{blog}', [BlogController::class, "status"])->name('blog.change_status');
    // blog feature
    Route::post('/blog/feature/{blog}', [BlogController::class, "feature"])->name('blog.change_feature');
});

});



// email varifiaction routes

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
