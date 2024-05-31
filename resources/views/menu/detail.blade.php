@extends('layouts.main')
@section('container')

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" class="form-control" value="{{ $menu->category->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $menu->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control" value="{{ $menu->description }}" readonly>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ $menu->price }}" readonly>
        </div>
        <div class="form-group">
            <label for="image">Image</label><br>
            @if($menu->image)
                <img src="{{ asset('storage/images/' . $menu->image) }}" alt="Menu Image" style="max-width: 200px;">
            @else
                <span>No Image Available</span>
            @endif
        </div>             
        <a href="{{ URL::to('menu') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
</div>
@endsection