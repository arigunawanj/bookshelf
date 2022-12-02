@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <a class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahdata">Tambah
                    Data</a>
                <div class="card">
                    <div class="card-header">Data Kategori</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Isi</th>
                                    <th>Tanggal</th>
                                    <th>Penulis</th>
                                    <th>Total Pembaca</th>
                                    <th>Kategori</th>
                                    <th>Cover</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($book as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->isi }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->penulis }}</td>
                                        <td>{{ DB::table('totals')->where('book_id', $item->id)->count() }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td><img src="{{ asset('storage/' . $item->cover ) }}" width="100px" alt="" srcset=""></td>
                                        <td>
                                            @if (Auth::user()->role == "Admin")
                                                <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editdata{{ $item->id }}">Edit</a>
                                                <a href="/book/{{ $item->id }}" class="btn btn-danger">Hapus</a>
                                            @endif
                                            @if ($item->tampil == 1)
                                                <a href="/tampil/{{ $item->id }}" class="btn btn-warning">Hide</a>
                                            @else
                                                <a href="/tampil/{{ $item->id }}" class="btn btn-primary">Show</a>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Modal Edit --}}
                                    <!-- Modal -->
                                    <div class="modal fade" id="editdata{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Buku
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('book.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="">Judul</label>
                                                            <input type="text" name="judul" value="{{ $item->judul }}" class="form-control" id="">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Isi</label>
                                                            <textarea name="isi" class="form-control" id="" cols="30" rows="10">{{ $item->isi }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Penulis</label>
                                                            <input type="text" name="penulis" value="{{ $item->penulis }}" class="form-control" id="">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Tanggal</label>
                                                            <input type="date" name="tanggal" value="{{ $item->tanggal }}" class="form-control" id="">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Kategori</label>
                                                            <select name="category_id" class="form-select" id="">
                                                                @foreach ($category as $data)
                                                                    <option value="{{ $data->id }}" @selected($data->id == $item->category_id)>{{ $data->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Foto</label>
                                                            <input type="file" name="cover" class="form-control" id="">
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <!-- Modal -->
    <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="">Judul</label>
                            <input type="text" name="judul" class="form-control" id="">
                        </div>
                        <div class="mb-3">
                            <label for="">Isi</label>
                            <textarea name="isi" class="form-control" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Penulis</label>
                            <input type="text" name="penulis" class="form-control" id="">
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" id="">
                        </div>
                        <div class="mb-3">
                            <label for="">Kategori</label>
                            <select name="category_id" class="form-select" id="">
                                @foreach ($category as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Foto</label>
                            <input type="file" name="cover" class="form-control" id="">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
