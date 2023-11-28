<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffRegistrationController;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\ReaderRegistrationController;
use App\Http\Controllers\ReaderAuthController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;


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
    return view('welcome');
});

Route::get('/login', function () { return view('login');})->name('login');

Route::post('/login', [AuthController::class, 'loginDispatcher']);
Route::get('stafflogout', [StaffAuthController::class, 'logout'])->name('staff.logout');

// Use array-based syntax for StaffRegistrationController
Route::get('/staff/register', [StaffRegistrationController::class, 'showRegistrationForm'])->name('staff.register');
Route::post('/staff/register', [StaffRegistrationController::class, 'register']);
Route::get('/staff', [StaffRegistrationController::class, 'listStaff'])->name('staff.index');
Route::post('/staff/changeStatus/{id}', [StaffRegistrationController::class, 'changeStatus'])->name('staff.changestatus');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

# Book Manage
Route::get('admin/books/create', [BookController::class, 'create'])->name('admin.books.create');
Route::post('admin/books/store', [BookController::class, 'store'])->name('admin.books.store');
Route::post('admin/books/delete', [BookController::class, 'destroy'])->name('admin.books.destroy');

Route::get('admin/books/index', [BookController::class, 'index'])->name('admin.books.index');
Route::get('admin/books/{id}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
Route::put('admin/books/{id}/update', [BookController::class, 'update'])->name('admin.books.update');

# Book Borrow
Route::get('admin/book/{id}/borrow', [BorrowController::class , 'createBorrowRecord'])->name('admin.books.borrow_book');
Route::post('admin/book/borrow', [BorrowController::class , 'store'])->name('admin.book.borrow');
Route::get('borrows', [BorrowController::class, 'index'])->name('reader.borrows');

# Reader Routers
Route::get('/reader/register', [ReaderRegistrationController::class, 'showRegistrationForm'])->name('reader.register');
Route::post('/reader/register', [ReaderRegistrationController::class, 'register']);
Route::get('/reader/dashboard', [ReaderController::class, 'dashboard'])->name('reader.dashboard');
