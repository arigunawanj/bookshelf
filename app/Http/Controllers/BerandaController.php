<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Total;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function Beranda()
    {
        $book = Book::where('tampil', 1)->get();
        $category = Category::all();
        $total = Total::all();
        return view('beranda', compact('book', 'category', 'total'));
    }

    public function kategori($id)
    {
        $book = Book::where('tampil', 1)->where('category_id', $id)->get();
        $category = Category::all();
        return view('beranda', compact('book', 'category'));
    }

    public function read($id)
    {
        $book = Book::findOrFail($id);
        if (Total::where('book_id', $id)->where('user_id', Auth::user()->id)->exists()) {
            return view('detail', compact('book'));
        }else {
            Total::create([
                'book_id' => $id,
                'user_id' => Auth::user()->id,
            ]);
            return view('detail', compact('book'));            
        }
    }
}
