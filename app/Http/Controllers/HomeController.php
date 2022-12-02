<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Total;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $book = Book::where('tampil', 1)->get();
        $category = Category::all();
        $total = Total::all();
        return view('beranda', compact('book', 'category', 'total'));
    }
}
