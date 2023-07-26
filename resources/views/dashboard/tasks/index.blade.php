@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <strong>Sukses!</strong> {{ session('success') }}
                    </div>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        <strong>Terjadi Kesalahan!</strong> {{ session('error') }}
                    </div>
                </div>
            @endif

        </div>
        <div class="row">
            <h3>Ini Halaman Tasks</h3>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">Tambah Tasks</a>
            </div>

        </div>

        <div class="row mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td> {{ $loop->iteration }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->category->name }}</td>
                            <td>
                                <img height="100" width="100" src="{{ asset('storage/' . $data->photo) }}">
                            </td>
                            <td>
                                <form method="POST" action="{{ route('tasks.destroy', $data->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-success" href="{{ route('tasks.edit', $data->id) }}">Edit</a>
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apa anda yakin ingin menghapus data?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
