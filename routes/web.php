<?php

Auth::routes();

use App\Http\Controllers\Home;
use App\Http\Controllers\Posts;
use App\Http\Controllers\Contact;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\Home as AdminHome;
use App\Http\Controllers\Admin\Users as AdminUsers;

Route::get('/', [Home::class, 'index'])->name('home');

Route::get('/editions/{number}', [Home::class, 'editions'])->name('editions');

Route::get('/posts', [Home::class, 'post'])->name('post');

Route::get('/posts/{year}/{month}/{number}/{slug}', [Posts::class, 'show'])->name('posts.show');

Route::get('/contact', [Contact::class, 'index'])->name('contact.index');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'administrators']], function () {
    Route::get('/', [AdminHome::class, 'index'])->name('admin.home.index');

    Route::get('/administrator/add/{username}', [AdminUsers::class, 'addAdmin'])->name(
        'admin.addAdmin'
    );

    Route::get('/administrator/remove/{username}', [AdminUsers::class, 'removeAdmin'])->name(
        'admin.addAdmin'
    );

    Route::get('/users/list', [AdminUsers::class, 'index'])->name('admin.users');

    Route::get('/backup', [AdminUsers::class, 'backup'])->name('admin.backups');
});

Route::get('/not-an-administrator', [AdminUsers::class, 'notAnAdministrator'])->name(
    'not.an.administrator'
);
