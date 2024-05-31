@extends('layouts.main')
@section('container')

@if(isset($menu))
    <form method="POST" action="{{ URL::to('menu/' . $menu->id) }}" 
    autocomplete="off" enctype="multipart/form-data">
        @method('put')
@else
    <form method="POST" action="{{ URL::to('menu') }}" autocomplete="off" enctype="multipart/form-data">
@endif
        @csrf
        <div class="row">
            <div class="col-6">
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control
                @error('category_id')is-invalid @enderror">
                @foreach ($categories as $category )
                    <option value="{{ $category->id}}" {{ isset($menu)? 
                        ($menu->category_id === $category->id? " selected" : "") : ""}}>
                        {{ $category->name }}</option>
                    @endforeach
                </select>
                
                @error('category_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" class="form-control @error('image')is-invalid @enderror" 
                    value="{{ isset($menu)? $menu->image : old('image') }}">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    @if ( isset($menu))
                    <img src="{{ URL::to('storage' . $menu->image)}}" 
                    alt="image" width="20%">
                    
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control @error('name')is-invalid @enderror" 
                    value="{{ isset($menu)? $menu->name : old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" class="form-control  @error('description')is-invalid @enderror" 
                    value="{{ isset($menu)? $menu->description : old('description') }}">
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" class="form-control @error('price')is-invalid @enderror" 
                    value="{{ isset($menu)? $menu->price : old('price') }}">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>

                <a href="{{ URL::to('menu') }}" class="btn btn-secondary">Back</a>
            </div>

        </div>
    </form>
@endsection