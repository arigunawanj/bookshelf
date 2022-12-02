@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/" class="btn btn-primary mb-3">Kembali</a>
            <div class="card">
                <div class="card-header">{{ $book->judul }}</div>
                <img src="{{ asset('storage/' .$book->cover) }}" class="card-img-top" alt="" srcset="">
                <div class="card-body">
                    <p>{{ $book->isi }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
