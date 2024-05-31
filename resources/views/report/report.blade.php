<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Report</title>
</head>
<body>
    <h2 class="text-center">Receipt Report {{ DateFormat($startDate, "Y-MM-DD") }} - {{ DateFormat($endDate, "Y-MM-DD") }}</h2>
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
</body>
</html>