<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function Beranda()
    {
        $book = Book::where('tampil', 1)->get();
        return view('beranda', compact('book'));
    }
}
