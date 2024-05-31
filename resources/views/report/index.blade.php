@extends('layouts.main')
@section('container')
    @include('sweetalert::alert')

    <form action="{{ URL::to('report') }}" method="get">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label for="startDate">Start Date</label>
                    <input type="date" id="startDate" name="startDate" class="form-control"
                        value="{{DateFormat($startDate, 'Y-MM-DD') }}">
                </div>
                <div class="form-group">
                    <label for="endDate">End Date</label>
                    <input type="date" id="endDate" name="endDate" class="form-control"
                        value="{{DateFormat($endDate, 'Y-MM-DD') }}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ URL::to('report?startDate=' .DateFormat ($startDate, 'Y-MM-DD') . '&endDate=' .DateFormat($endDate, 'Y-MM-DD') . '&print=true') }}"
            class="btn btn-info">Print</a>
    </form>


    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th>Receipt Date</th>
                <th>Name</th>
                <th>Description</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($receipts as $index => $receipt)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ DateFormat($receipt->receipt_date) }}</td>
                    <td>{{ $receipt->customer_name }}</td>
                    <td>{{ $receipt->description }}</td>
                    <td>{{ $receipt->user->name }}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th>Category</th>
                                    <th>Menu</th>
                                    <th>Amount</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                ?>
                                @foreach ($receipt->receiptDetails as $index => $receiptDetail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $receiptDetail->menu->category->name }}</td>
                                        <td>{{ $receiptDetail->menu->name }}</td>
                                        <td>{{ NumberFormat($receiptDetail->amount) }}</td>
                                        <td>{{ NumberFormat($receiptDetail->price) }}</td>
                                        <td class="text-right">
                                            {{ NumberFormat($receiptDetail->amount * $receiptDetail->price) }}</td>
                                        <?php
                                        $total += $receiptDetail->amount * $receiptDetail->price;
                                        ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right">{{ NumberFormat($total) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
