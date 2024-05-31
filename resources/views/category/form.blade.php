@extends('layouts.main')
@section('container')

@if(isset($category))
    <form method="POST" action="{{ URL::to('category/' . $category->id) }}" autocomplete="off">
        @method('put')
@else
    <form method="POST" action="{{ URL::to('category') }}" autocomplete="off">
@endif
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control @error('name')is-invalid @enderror" 
                    value="{{ isset($category)? $category->name : old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" class="form-control  @error('description')is-invalid @enderror" 
                    value="{{ isset($category)? $category->description : old('description') }}">
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>

                <a href="{{ URL::to('category') }}" class="btn btn-secondary">Back</a>
            </div>

        </div>
    </form>
@endsection