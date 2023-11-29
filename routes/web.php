<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\ReaderRegistrationController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ReaderAuthController;


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


//Staff Route
Route::get('/login', function () {
    return view('login'); })->name('staff.login');
Route::post('/login', [AuthController::class, 'loginDispatcher']);
Route::get('stafflogout', [StaffAuthController::class, 'logout'])->name('staff.logout');
Route::get('/staff/register', [StaffController::class, 'showRegistrationForm'])->name('staff.register');
Route::post('/staff/register', [StaffController::class, 'register']);
Route::get('/staff', [StaffController::class, 'listStaff'])->name('staff.index');
Route::post('/staff/changeStatus/{id}', [StaffController::class, 'changeStatus'])->name('staff.changestatus');
Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('admin.dashboard');

// Route::middleware('can:view books,staff')->group(function () {

Route::get('admin/books/index', [BookController::class, 'index'])->name('admin.books.index');
// });

# Book Manage
Route::get('admin/books/create', [BookController::class, 'create'])->name('admin.books.create');
Route::post('admin/books/store', [BookController::class, 'store'])->name('admin.books.store');
Route::post('admin/books/delete', [BookController::class, 'destroy'])->name('admin.books.destroy');

Route::get('admin/books/{id}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
Route::put('admin/books/{id}/update', [BookController::class, 'update'])->name('admin.books.update');

# Book Borrow
Route::get('admin/book/{id}/borrow', [BorrowController::class, 'createBorrowRecord'])->name('admin.books.borrow_book');
Route::post('admin/book/borrow', [BorrowController::class, 'store'])->name('admin.book.borrow');
Route::get('borrows', [BorrowController::class, 'index'])->name('reader.borrows');

# Reader Routes

Route::get('/reader/login', function () {
    return view('readerlogin');
})->name('login');

Route::post('/reader/login', [ReaderAuthController::class, 'login'])->name('reader.login');
Route::get('/reader/register', [ReaderRegistrationController::class, 'showRegistrationForm'])->name('reader.register');
Route::post('/reader/register', [ReaderRegistrationController::class, 'register']);
Route::get('/reader/dashboard', [ReaderController::class, 'dashboard'])->name('reader.dashboard');
