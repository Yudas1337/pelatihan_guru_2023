@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="row">
            <h3>Ubah Tasks</h3>
        </div>

        <div class="row mt-3">
            <form method="POST" action="{{ route('tasks.update', $task->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Nama Kegiatan</td>
                            <td>
                                <input autocomplete="off" value="{{ $task->name }}" class="form-control" type="text"
                                    name="name">
                            </td>
                        </tr>
                        <tr>
                            <td>Deskripsi Kegiatan</td>
                            <td>
                                <textarea class="form-control" name="description">{{ $task->description }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Kategori Kegiatan</td>
                            <td>
                                <select name="category_id" class="form-control">
                                    <option value="">--Pilih--</option>
                                    @foreach ($categories as $category)
                                        <option {{ $category->id == $task->category_id ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Foto</td>
                            <td>
                                <input class="form-control" type="file" name="photo">
                                <br>
                                <img width="100" height="100" src="{{ asset('storage/' . $task->photo) }}">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button class="btn btn-success" type="submit">Update Data</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
@endsection
