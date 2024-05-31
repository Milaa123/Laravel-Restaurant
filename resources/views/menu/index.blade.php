@extends('layouts.main')
@section('container')
@include('sweetalert::alert')

<!-- @if(session()->has("successMessage"))
            <div class="alert alert-success">
                {{ session("successMessage") }}
            </div>
@endif    

@if(session()->has("errorMessage"))
            <div class="alert alert-danger">
                {{ session("errorMessage") }}
            </div>
@endif  -->

<a href="{{ URL::to('menu/create') }}" class="btn btn btn-primary mb-3">
<i class="fas fa-plus" aria-hidden="true"></i> Add</a>
<table id="datatable1" class="table table-bordered table-striped">
    <thead>
    <tr>
        <th width="5%">No</th>
        <th width="5%">Image</th>
        <th>Name</th>
        <th>Description</th>
        <th>Category</th>
        <th>Price</th>
        <th>User</th>
        <th width="10%">Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($menus as $index => $menu )
         <tr>
            <td>{{ $index + 1 }}</td>
            <td>
            <a onclick="showDetailImageModal('{{ URL::to('storage/' . $menu->image)  }}')" data-toggle="modal" data-target="#detailImageModal">
                <img src="{{ URL::to('storage/' . $menu->image)  }}"
                class="rounded" style="width: 100px"></a></td>
            <td>{{ $menu->name }}</td>
            <td>{{ $menu->description }}</td>
            <td>{{ $menu->category->name }}</td>
            <td>{{ NumberFormat($menu->price) }}</td>
            <td>{{ $menu->user->name }}</td>
            <td>
                <div class="d-flex">
                <a href="{{ URL::to('menu/' . $menu->id) }}" class="btn btn-sm btn-info mr-2">
                Show</a>
                <a href="{{ URL::to('menu/' . $menu->id. '/edit') }}" class="btn btn-sm btn-warning mr-2">
                Edit</a>
                <form action="{{ URL::to('menu/' . $menu->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm('Anda yakin ingin menghapus data ini {{ $menu->name }}?')">Delete</button>
                </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="detailImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailImageModal">Detail Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <img id="modalDetailImage" src="" width="50%"
                alt="Detail Image">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection