<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == "Admin"){
            $book = Book::all();
        } else {
            $book = Book::where('user_id', Auth::user()->id)->get();
        }

        $category = Category::all();

        return view('buku', compact('book', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $file = $request->file('cover')->store('img');

        $data['cover'] = $file;
        $data['user_id'] = Auth::user()->id;

        Book::create($data);

        return redirect('book');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // $data = $request->all();

        // if($request->hasFile('cover')){
        //     $file = $request->file('cover')->store('img');
        //     Storage::delete($book->cover);

        //     $data['cover'] = $file;
        //     $data['user_id'] = Auth::user()->id;
        //     $book->update($data);
        // } else {
        //     $book->update([
        //         'judul' => $request->judul,
        //         'isi'=> $request->isi,
        //         'penulis' => $request->penulis,
        //         'tanggal' => $request->tanggal,
        //         'user_id' => Auth::user()->id,
        //         'category_id' => $request->category_id
        //     ]);
        // }
        // return redirect('book');

        $data = $request->all();
        try {
            
            $file = $request->file('cover')->store('img');
            Storage::delete($book->cover);
            $data['cover'] = $file;
            $data['user_id'] = Auth::user()->id;
            $book->update($data);

        } catch (\Throwable $th) {
            $book->update([
                'judul' => $request->judul,
                'isi'=> $request->isi,
                'penulis' => $request->penulis,
                'tanggal' => $request->tanggal,
                'user_id' => Auth::user()->id,
                'category_id' => $request->category_id
            ]);
        }
        return redirect('book');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        Storage::delete($book->cover);
        $book->delete();
        return redirect('book');
    }

    public function hide(Book $book)
    {
        if($book->tampil == 1){
            $book->update([
                'tampil' => 0
            ]);
        } else {
            $book->update([
                'tampil' => 1
            ]);
        }
        return redirect('book');
    }
}
