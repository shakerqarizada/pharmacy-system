@extends('backend.common.master')

@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Sales</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Sales Records</h5>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-dark table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Invoice</th>
                                                    <th>Cashier</th>
                                                    <th>Customer</th>
                                                    <th>Subtotal</th>
                                                    <th>Discount</th>
                                                    <th>Total</th>
                                                    <th>Paid</th>
                                                    <th>Change</th>
                                                    <th>Sold Date</th>
                                                    <th>Created</th>
                                                    <th>Print</th>
                                                    <th>Update</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sales as $sale)
                                                    <tr>
                                                        <th>{{ $sale->id }}</th>
                                                        <td>{{ $sale->invoice_number }}</td>
                                                        <td>{{ optional($sale->cashier)->name ?? $sale->user_id }}</td>
                                                        <td>{{ $sale->customer }}</td>
                                                        <td>{{ number_format($sale->sub_total ?? $sale->subtotal, 2) }}</td>
                                                        <td>{{ number_format($sale->discount, 2) }}</td>
                                                        <td>{{ number_format($sale->total, 2) }}</td>
                                                        <td>{{ number_format($sale->paid, 2) }}</td>
                                                        <td>{{ number_format($sale->change, 2) }}</td>
                                                        <td>{{ $sale->sold_at ? $sale->sold_at->format('Y-m-d') : '' }}</td>
                                                        <td>{{ $sale->created_at ? $sale->created_at->format('Y-m-d') : '' }}
                                                        </td>
                                                        <td><a href="{{ route('sales.print', $sale->id) }}" target="_blank"
                                                                class="btn btn-sm btn-info"> Print</a></td>
                                                        <td><a href="{{ route('sales.edit', $sale->id) }}"
                                                                class="btn btn-sm btn-warning">Update</a></td>
                                                        <td><a href="{{ route('sales.delete', $sale->id) }}"
                                                                class="btn btn-sm btn-danger">Delete</a></td>

                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page-content -->
    @endsection
