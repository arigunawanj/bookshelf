@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Data Pengguna</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        @if ($item->role == "Admin")
                                            <td><span class="badge bg-secondary">{{ $item->role }}</span></td>
                                        @elseif ($item->role == "Editor")
                                            <td><span class="badge bg-info">{{ $item->role }}</span></td>
                                        @else
                                            <td><span class="badge bg-warning">{{ $item->role }}</span></td>
                                        @endif
                                        @if ($item->status == "Aktif")
                                            <td><span class="badge bg-primary">{{ $item->status }}</span></td>
                                        @else
                                            <td><span class="badge bg-danger">{{ $item->status }}</span></td>
                                        @endif
                                        <td>
                                            <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editdata{{ $item->id }}">Edit</a>
                                        </td>
                                    </tr>

                                    {{-- Modal Edit --}}
                                    <!-- Modal -->
                                    <div class="modal fade" id="editdata{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Kategori
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/ubah/{{ $item->id }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="">Role</label>
                                                            <select name="role" id="" class="form-select">
                                                                <option value="Admin" @if ($item->role == "Admin") @selected("Admin" == $item->role)@endif>Admin</option>
                                                                <option value="Editor" @if ($item->role == "Editor") @selected("Editor" == $item->role)@endif>Editor</option>
                                                                <option value="User" @if ($item->role == "User") @selected("User" == $item->role)@endif>User</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">Status</label>
                                                            <select name="status" id="" class="form-select">
                                                                <option value="Aktif" @if ($item->status == "Aktif") @selected("Aktif" == $item->status)@endif>Aktif</option>
                                                                <option value="Non Aktif" @if ($item->status == "Non Aktif") @selected("Non Aktif" == $item->status)@endif>Non Aktif</option>
                                                            </select>
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

@endsection
