<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $sale->invoice_number }}</title>
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            margin: 20px;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 30px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #29A0b1;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            color: #29A0b1;
        }

        .invoice-number {
            font-size: 18px;
            font-weight: bold;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .invoice-info-section {
            flex: 1;
        }

        .invoice-info-section h3 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #29A0b1;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .invoice-table th {
            background-color: #29A0b1;
            color: white;
            font-weight: bold;
        }

        .invoice-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .invoice-totals {
            float: right;
            width: 300px;
        }

        .invoice-totals-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }

        .invoice-totals-row.total {
            font-weight: bold;
            font-size: 18px;
            background-color: #29A0b1;
            color: white;
            padding: 12px;
            margin-top: 10px;
        }

        .invoice-footer {
            clear: both;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 12px;
            color: #666;
        }

        .print-btn {
            margin: 20px;
            padding: 10px 20px;
            background-color: #29A0b1;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .print-btn:hover {
            background-color: #238a98;
        }
    </style>
</head>

<body>
    <button class="print-btn no-print" onclick="window.print()">
        <i class="fas fa-print"></i> Print Invoice
    </button>

    <div class="invoice-container">
        <div class="invoice-header">
            <div>
                <h1 class="invoice-title">Pharmacy Invoice</h1>
                <p>Quality Healthcare Solutions</p>
            </div>
            <div class="invoice-number">
                Invoice #{{ $sale->invoice_number }}
            </div>
        </div>

        <div class="invoice-info">
            <div class="invoice-info-section">
                <h3>Bill To:</h3>
                <p><strong>{{ $sale->customer }}</strong></p>
                <p>Date: {{ $sale->sold_at ? $sale->sold_at->format('M d, Y') : $sale->created_at->format('M d, Y') }}
                </p>
                <p>Cashier: {{ optional($sale->cashier)->name ?? 'N/A' }}</p>
            </div>
            <div class="invoice-info-section" style="text-align: right;">
                <h3>Pharmacy Details:</h3>
                <p><strong>Pharmacy System</strong></p>
                <p>Phone: +93(0)72929565</p>
                <p>Email: afghanshaker21@gmail1@gmail.com</p>
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Medicine</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->medicine->name ?? 'N/A' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->unit_price, 2) }}</td>
                        <td>${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="invoice-totals">
            <div class="invoice-totals-row">
                <span>Subtotal:</span>
                <span>${{ number_format($sale->sub_total ?? $sale->subtotal, 2) }}</span>
            </div>
            <div class="invoice-totals-row">
                <span>Discount:</span>
                <span>-${{ number_format($sale->discount, 2) }}</span>
            </div>
            <div class="invoice-totals-row total">
                <span>Total:</span>
                <span>${{ number_format($sale->total, 2) }}</span>
            </div>
            <div class="invoice-totals-row">
                <span>Amount Paid:</span>
                <span>${{ number_format($sale->paid, 2) }}</span>
            </div>
            <div class="invoice-totals-row">
                <span>Change:</span>
                <span>${{ number_format($sale->change, 2) }}</span>
            </div>
        </div>

        <div class="invoice-footer">
            <p>Thank you for your purchase!</p>
            <p>For any questions, please contact us at +93(0)72929565</p>
            <p>Generated on: {{ now()->format('M d, Y H:i') }}</p>
        </div>
    </div>
</body>

</html>
