@extends('layouts.main')
@section('container')
@include('sweetalert::alert')

    {{-- @if (session()->has('successMessage'))
        <div class="alert alert-success">
            {{ session('successMessage') }}
        </div>
    @endif

    @if (session()->has('errorMessage'))
    <div class="alert alert-danger">
        {{ session('errorMessage') }}
    </div>
@endif --}}

    <a href="{{ URL::to('user/create') }}" class="btn btn-sm btn-primary mb-3"><i class="fas fa-plus" aria-hidden="true"></i>
        Add</a>
    <table id="datatable1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
     
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <div class="d-flex ">
                        <a href="{{ URL::to('user/' . $user->id) }}" class="btn btn-sm btn-info mr-2">Show</a>
                        <a href="{{ URL::to('user/' . $user->id. '/edit') }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                        <form action="{{ URL::to('user/' . $user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda Yakin akan Menghapus {{ $user->name }}?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
