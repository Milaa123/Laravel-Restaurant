@extends('layouts.main')
@section('container')
    @include('sweetalert::alert')

    {{-- @if (session()->has('successMessage'))
    <div class="alert alert-success">
        {{ session("successMessage") }}
    </div>
@endif

@if (session()->has('errorMessage'))
    <div class="alert alert-danger">
        {{ session("errorMessage") }}
    </div>
@endif --}}

    <a href="{{ URL::to('receipt/create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus" aria-hidden="true"></i> Add</a>
    <table id="datatable1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Receipt Date</th>
                <th>Customer Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>User</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receipts as $index => $receipt)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ DateFormat($receipt->receipt_date) }}</td>
                    <td>{{ $receipt->customer_name }}</td>
                    <td>{{ $receipt->description }}</td>
                    <td>{{ $receipt->status }}</td>
                    <td>{{ $receipt->user->name }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ URL::to('receipt/' . $receipt->id) }}" class="btn btn-sm btn-info mr-2">Show</a>
                            <a href="{{ URL::to('receipt/' . $receipt->id) . '/edit' }}"
                                class="btn btn-sm btn-warning mr-2">Edit</a>

                            <form action="{{ URL::to('receipt/' . $receipt->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Anda yakin mau menghapus data ini {{ $receipt->name }} ?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection