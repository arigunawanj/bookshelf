@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($book as $item)
            <div class="card ms-3" style="width: 25rem;">
                <img src="{{ asset('storage/' . $item->cover) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul }}</h5>
                    <p>Tanggal : <span class="badge bg-warning">{{ $item->tanggal }}</span></p>
                    <h6 class="card-subtitle mb-2 text-muted">Kategori : <span class="badge bg-primary">{{ $item->category->name }}</span></h6>
                    <p class="card-text">{{ $item->isi }}</p>
                    <p>Total Pembaca : <span class="badge bg-danger">{{ $item->total_pembaca }}</span></p>
                    <blockquote class="blockquote mb-2">
                        <footer class="blockquote-footer"><cite title="Source Title">{{ $item->user->name }}</cite>
                        </footer>
                    </blockquote>
                    <a href="detail/{{ $item->id }}" class="btn btn-primary">Detail</a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection
