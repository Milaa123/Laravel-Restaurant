@extends('layouts.main')
@section('container')
    @if (@isset($user))
        <form method="POST" action="{{ URL::to('user/' . $user->id) }}" autocomplete="off">
            @method('put')
        @else
            <form method="POST" action="{{ URL::to('user') }}" autocomplete="off">
    @endif

    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name')is-invalid @enderror"
                    value="{{ isset($user) ? $user->name : old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="username">Username</label>
<input type="text" id="username" name="username"
                    class="form-control @error('username')is-invalid @enderror"
                    value="{{ isset($user) ? $user->username : old('username') }}">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                    class="form-control @error('password')is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control @error('role')is-invalid @enderror" name="role" id="role">
                    <option value="User {{ isset($user) ? ($user->role === 'User' ? 'selected' : '') : '' }}">User</option>
                    <option value="Admin {{ isset($user) ? ($user->role === 'Admin' ? 'selected' : '') : '' }}">Admin
                    </option>
                </select>
            </div>
<button type="submit" class="btn btn-sm btn-primary">Save</button>
            <a href="{{ URL::to('user') }}" class="btn btn-sm btn-secondary">Back</a>
        </div>
    </div>
    </form>
@endsection