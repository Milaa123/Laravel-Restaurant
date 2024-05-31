@extends('layouts.main')
@section('container')

    @if (isset($receipt))
        <form method="POST" action="{{ URL::to('receipt/' . $receipt->id) }}" autocomplete="off">
            @method('put')
        @else
            <form method="POST" action="{{ URL::to('receipt') }}" autocomplete="off">
    @endif
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" id="customer_name" name="customer_name"
                    class="form-control @error('customer_name')is-invalid @enderror"
                    value="{{ isset($receipt) ? $receipt->customer_name : old('customer_name') }}">
                @error('customer_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description"
                    class="form-control  @error('description')is-invalid @enderror"
                    value="{{ isset($receipt) ? $receipt->description : old('description') }}">
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status" id="status">
                    <option value="entry" {{ isset($receipt) ? ($receipt->status === 'entry' ? ' selected' : '') : '' }}>
                        Entry</option>
                    <option value="done"{{ isset($receipt) ? ($receipt->status === 'done' ? ' selected' : '') : '' }}>Done
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>

            <a href="{{ URL::to('receipt') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    </form>
    @if (isset($receipt))
        <div class="mt-5">
            <h2>Receipt Details</h2>
            <hr />

            <table class="table table-bordered table-striped">
                <thead>
                    <div class="row">
                        <div class="col">

                        </div>

                    </div>
                    <tr>
                        <th width="5%">No.</th>
                        <th>Category</th>
                        <th>Menu</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($receipt->receiptDetails as $index => $receiptDetail)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $receiptDetail->menu->category->name }}</td>
                            <td>{{ $receiptDetail->menu->name }}</td>
                            <td>{{ NumberFormat($receiptDetail->amount) }}</td>
                            <td>{{ NumberFormat($receiptDetail->price) }}</td>
                            <td>{{ NumberFormat($receiptDetail->amount * $receiptDetail->price) }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ URL::to('receipt/' . $receiptDetail->id) }}"
                                        class="btn btn-sm btn-info mr-2">Show</a>
                                    <a href="{{ URL::to('receipt/' . $receiptDetail->id) . '/edit' }}"
                                        class="btn btn-sm btn-warning mr-2">Edit</a>

                                    <form action="{{ URL::to('receipt/' . $receiptDetail->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Anda yakin mau menghapus data ini {{ $receiptDetail->name }} ?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
