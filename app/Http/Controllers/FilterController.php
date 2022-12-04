<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FilterController extends Controller
{
    //
    public function store(Request $request)
    {
        # code...
        // dd($request);
        $nw = new Filter($request->category_id, Auth::user()->id);
        $dt = [
            'cate' => $nw->sortCategory(),
            'rb' => $nw->sortRead(),
        ];
        $category = Category::all();
        if ($request->uid) {
            if ($nw->sortRead() == 'Buku telah dibaca') {
                # code...
                $book = $nw->sortCategory();
                return view('beranda', compact('book', 'category', 'dt'));
            }
        }else {
            $book = $nw->sortCategory();
            return view('beranda', compact('book', 'category'));
        }
    }
}

class Filter {
    public function __construct($category = '', $user_id)
    {
        $this->cate = $category;
        $this->uid = $user_id;
    }

    public function sortCategory()
    {
    
        $ktgr = Category::all();
        if ($this->cate == '') {
            # code...
            return $book = Book::all();
        }else {
            return $book = Book::where('tampil', 1)->where('category_id', $this->cate)->get();
        }
        // foreach ($ktgr as $k) {
            //     if ($k->id == $this->cate) {
                //         return $this->cate;
                //     }
                // }
                // return $this->cate;
        // $book = Book::where('tampil', 1)->where('category_id', $id)->get();
    }

    public function sortRead()
    {
        if (DB::table('totals')->where('user_id', $this->uid)->exists()) {
            return "Buku telah dibaca";
        }else {
            return "Buku belum dibaca";
        }
    }
}