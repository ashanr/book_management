<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\User;
use App\Models\Reader;
use Illuminate\Support\Facades\Mail;
use App\Mail\BorrowedBookMail;
use Illuminate\Support\Facades\Auth;


class BorrowController extends Controller
{

    public function index()
    {
        $borrows = Borrow::all();
        return view('reader.borrows', ['borrows' => $borrows]);
    }

    public function create()
    {
        $borrows = Borrow::all();
        return view('reader.borrows', ['borrows' => $borrows]);
    }

    public function createBorrowRecord()
    {
        $books = Book::all();
        $users = Reader::all(); // Assuming you have a User model
        return view('admin.books.borrow_book', ['books' => $books, 'users' => $users]);
    }

    public function store(Request $request)
    {
        $borrow = new Borrow([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'borrowed_at' => now(),
            'return_by' => $request->return_by,
        ]);

        $borrow->save();

        $borrowed_book = Borrow::with(['book', 'user']) // 'book' and 'user' are the relationship methods in your Borrow model
               ->find($borrow->id); // Replace $borrowId with the actual ID of the borrow record


        // Send Email to the Reader
        Mail::to(Reader::find($request->user_id)->email)->send(new BorrowedBookMail($borrowed_book));

        return redirect()->back();
    }
}
