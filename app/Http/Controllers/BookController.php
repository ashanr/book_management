<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class BookController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::guard('staff')->user();

        if (!$user instanceof User || !$user->hasPermissionTo('view books')) {
            // if (!$user->canViewBooks()) {
            return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to view this page.');
        } else {
            $books = Book::all();
            return view('admin.books.index', compact('books'))->with('success', 'Operation completed successfully.');
            ;
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::guard('staff')->user();
        if (!$user instanceof User || !$user->hasPermissionTo('edit books')) {
            return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to view this page.');
        } else {
            $books = Book::all();
            return view('admin.books.create', compact('books'))->with('success', 'Operation completed successfully.');
            ;
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|min:10|max:255',
            'isbn' => 'required|numeric',
            'status' => 'required',
        ]);

        Book::create($validatedData);

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $book = Book::find($id);
        $user = Auth::guard('staff')->user();

        if (!$user instanceof User || !$user->hasPermissionTo('edit books')) {
            return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to view this page.');
        } else {
            $books = Book::all();
            return view('admin.books.edit', compact('book'));
            ;
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            // Add validation rules for other fields as needed
        ]);

        $book = Book::find($id);

        if (!$book) {
            return back()->with('error', 'Book not found'); // Handle the case where the book is not found
        }

        $book->update($request->all());

        return redirect()->route('admin.books.edit', ['id' => $id])->with('success', 'Book updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Check if the authenticated user is an admin
        $user = Auth::guard('staff')->user();
        if ($user->hasPermissionTo('view books')) {
            $book = Book::find($id);
            if ($book) {
                $book->delete();
                return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully');
            } else {
                return redirect()->route('admin.books.index')->with('error', 'Book not found');
            }
        } else {
            // If not an admin, redirect with an error message
            return redirect()->route('admin.books.index')->with('error', 'You do not have permission to perform this action');
        }
    }
}
