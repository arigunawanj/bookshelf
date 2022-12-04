@extends('layouts.app')

@section('content')
    <div class="container">
        @guest
            @if (Route::has('login'))
            <form action="{{ url('beranda') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Kategori</label>
                    <select name="category_id" class="form-select" id="">
                        <option selected value="">Semua Kategori</option>
                        @foreach ($category as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-secondary mb-4">Submit</button>
            </form>
            @endif
        @else
            <form action="{{ url('beranda') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Kategori</label>
                    <select name="category_id" class="form-select" id="">
                        <option selected value="">Semua Kategori</option>
                        @foreach ($category as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <div class="d-flex">
                        <input class="form-check-input m-1" name="uid" type="checkbox" value="{{ Auth::user()->id }}">
                        <p>Tampilkan buku yang sudah saya baca</p>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary mb-4">Submit</button>
            </form>
        @endguest

        {{-- filter tanpa class --}}
        <div class="dropdown mb-3">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Kategori
            </a>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/">Semua Kategori</a></li>
                @foreach ($category as $data)
                    <li><a class="dropdown-item" href="/{{ $data->id }}">{{ $data->name }}</a></li>
                @endforeach
            </ul>
        </div>
        
        <div class="row justify-content-center">
            @foreach ($book as $item)
                @if (isset($dt))
                    @if (DB::table('totals')->where('book_id', $item->id)->where('user_id', Auth::user()->id)->exists())
                        <div class="card ms-3" style="width: 25rem;">
                            <img src="{{ asset('storage/' . $item->cover) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->judul }}</h5>
                                <p>Tanggal : <span class="badge bg-warning">{{ $item->tanggal }}</span></p>
                                <h6 class="card-subtitle mb-2 text-muted">Kategori : <span
                                        class="badge bg-primary">{{ $item->category->name }}</span></h6>
                                <p class="card-text">{{ $item->isi }}</p>
                                <p>Total Pembaca : <span
                                        class="badge bg-danger">{{ DB::table('totals')->where('book_id', $item->id)->count() }}</span>
                                </p>
                                <p>Editor : <span class="badge bg-dark">{{ $item->user->name }}</span></p>
                                <blockquote class="blockquote mb-2">
                                    <footer class="blockquote-footer">
                                        <cite title="Source Title">{{ $item->penulis }}</cite>
                                    </footer>
                                </blockquote>
                                @guest
                                    <a href="read/{{ $item->id }}" class="btn btn-primary">Baca Buku Ini</a>
                                @else
                                    @if (DB::table('totals')->where('book_id', $item->id)->where('user_id', Auth::user()->id)->exists())
                                        <a class="btn btn-warning" href="read/{{ $item->id }}">Buku Sudah Dibaca</a>
                                    @else
                                        <a href="read/{{ $item->id }}" class="btn btn-primary">Baca Buku Ini</a>
                                    @endif
                                @endguest
                            </div>
                        </div>
                    @endif
                    {{-- @endforeach --}}
                @else
                    {{-- @foreach ($book as $item) --}}

                    <div class="card ms-3" style="width: 25rem;">
                        <img src="{{ asset('storage/' . $item->cover) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            <p>Tanggal : <span class="badge bg-warning">{{ $item->tanggal }}</span></p>
                            <h6 class="card-subtitle mb-2 text-muted">Kategori : <span
                                    class="badge bg-primary">{{ $item->category->name }}</span></h6>
                            <p class="card-text">{{ $item->isi }}</p>
                            <p>Total Pembaca : <span
                                    class="badge bg-danger">{{ DB::table('totals')->where('book_id', $item->id)->count() }}</span>
                            </p>
                            <p>Editor : <span class="badge bg-dark">{{ $item->user->name }}</span></p>
                            <blockquote class="blockquote mb-2">
                                <footer class="blockquote-footer">
                                    <cite title="Source Title">{{ $item->penulis }}</cite>
                                </footer>
                            </blockquote>
                            @guest
                                <a href="read/{{ $item->id }}" class="btn btn-primary">Baca Buku Ini</a>
                            @else
                                @if (DB::table('totals')->where('book_id', $item->id)->where('user_id', Auth::user()->id)->exists())
                                    <a class="btn btn-warning" href="read/{{ $item->id }}">Buku Sudah Dibaca</a>
                                @else
                                    <a href="read/{{ $item->id }}" class="btn btn-primary">Baca Buku Ini</a>
                                @endif
                            @endguest
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    </div>
@endsection
