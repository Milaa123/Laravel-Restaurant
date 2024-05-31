@extends('layouts.main')
@section('container')

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $receipt->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control" value="{{ $receipt->description }}" readonly>
        </div>
        <a href="{{ URL::to('receipt') }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
</div>
@endsection