@extends('backend.common.master')

@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Sales Recipt</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Sales Details</h5>
                            </div><!-- end card header -->

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-body">
                                <form class="row g-3" action="{{ route('sales.store') }}" method="POST">
                                    @csrf

                                    <div class="col-md-12">
                                        <label for="validationServer01" class="form-label">Invoice Number</label>
                                        <input type="text" name="invoice_number" class="form-control" value=""
                                            required placeholder="Invoice Number">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">User</label>
                                        <div class="input-group has-validation">
                                            <select name="user_id" class="form-control" required>
                                                <option value="" selected disabled>Select User</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Customer</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="customer" class="form-control" value=""
                                                required placeholder="Customer Name">
                                        </div>
                                    </div>

                                    <!-- Sale Items Section -->
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Sale Items</label>
                                        <table class="table table-bordered" id="items-table">
                                            <thead>
                                                <tr>
                                                    <th>Medicine</th>
                                                    <th>Unit Price</th>
                                                    <th>Quantity</th>
                                                    <th>Subtotal</th>
                                                    <th><button type="button" class="btn btn-success btn-sm"
                                                            id="add-item">+</button></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="items[0][medicine_id]"
                                                            class="form-control medicine-select" required>
                                                            <option value="" disabled selected>Select Medicine
                                                            </option>
                                                            @foreach ($medicines as $medicine)
                                                                <option value="{{ $medicine->id }}"
                                                                    data-price="{{ $medicine->selling_price }}">
                                                                    {{ $medicine->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="items[0][unit_price]"
                                                            class="form-control unit-price" step="0.01" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="items[0][quantity]"
                                                            class="form-control quantity" min="1" value="1"
                                                            required>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="items[0][subtotal]"
                                                            class="form-control subtotal" step="0.01" readonly>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm remove-item">-</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <script type="text/template" id="item-row-template">
                                                    <tr>
                                                        <td>
                                                            <select name="items[__INDEX__][medicine_id]" class="form-control medicine-select" required>
                                                                <option value="" disabled selected>Select Medicine</option>
                                                                @foreach ($medicines as $medicine)
                                                                    <option value="{{ $medicine->id }}" data-price="{{ $medicine->selling_price }}">{{ $medicine->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="items[__INDEX__][unit_price]" class="form-control unit-price" step="0.01" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="items[__INDEX__][quantity]" class="form-control quantity" min="1" value="1" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="items[__INDEX__][subtotal]" class="form-control subtotal" step="0.01" readonly>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm remove-item">-</button>
                                                        </td>
                                                    </tr>
                                                </script>

                                        <div class="col-md-6">
                                            <label class="form-label">Subtotal</label>
                                            <div class="input-group has-validation">
                                                <input type="number" step="0.01" name="subtotal" class="form-control"
                                                    required placeholder="Subtotal" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Discount Amount</label>
                                            <div class="input-group has-validation">
                                                <input type="number" step="0.01" name="discount_amount"
                                                    class="form-control" value="0" required
                                                    placeholder="Discount Amount">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Total</label>
                                            <div class="input-group has-validation">
                                                <input type="number" step="0.01" name="total" class="form-control"
                                                    required placeholder="Total" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Paid</label>
                                            <div class="input-group has-validation">
                                                <input type="number" step="0.01" name="paid" class="form-control"
                                                    required placeholder="Paid">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Change</label>
                                            <div class="input-group has-validation">
                                                <input type="number" step="0.01" name="change" class="form-control"
                                                    required placeholder="Change" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="validationServerUsername" class="form-label">Sold Date</label>
                                            <div class="input-group has-validation">
                                                <input type="Date" name="sold_date" class="form-control" required
                                                    placeholder="Sold Date">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-success" type="submit">Add Sales</button>
                                        </div>
                                </form>
                            </div> <!-- end card-body -->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function getNextItemIndex() {
                return $('#items-table tbody tr').length;
            }

            function addItemRow() {
                let index = getNextItemIndex();
                let template = $('#item-row-template').html();
                let rowHtml = template.replace(/__INDEX__/g, index);
                $('#items-table tbody').append(rowHtml);
            }

            function reindexItems() {
                $('#items-table tbody tr').each(function(i) {
                    $(this).find('select, input').each(function() {
                        let name = $(this).attr('name');
                        if (!name) {
                            return;
                        }
                        let newName = name.replace(/items\[\d+\]/, 'items[' + i + ']');
                        $(this).attr('name', newName);
                    });
                });
            }

            function updateRowSubtotal(row) {
                let qty = parseFloat(row.find('.quantity').val()) || 0;
                let price = parseFloat(row.find('.unit-price').val()) || 0;
                let subtotal = qty * price;
                row.find('.subtotal').val(subtotal.toFixed(2));
            }

            function updateTotals() {
                let subtotal = 0;
                $('.subtotal').each(function() {
                    subtotal += parseFloat($(this).val()) || 0;
                });
                $('input[name="subtotal"]').val(subtotal.toFixed(2));

                let discount = parseFloat($('input[name="discount_amount"]').val()) || 0;
                let total = subtotal - discount;
                $('input[name="total"]').val(total.toFixed(2));

                let paid = parseFloat($('input[name="paid"]').val()) || 0;
                let change = paid - total;
                $('input[name="change"]').val(change.toFixed(2));
            }

            $(function() {
                $('#add-item').on('click', function() {
                    addItemRow();
                });

                $(document).on('change', '.medicine-select', function() {
                    let price = $(this).find('option:selected').data('price') || 0;
                    let row = $(this).closest('tr');
                    row.find('.unit-price').val(price);
                    updateRowSubtotal(row);
                    updateTotals();
                });

                $(document).on('input', '.quantity', function() {
                    updateRowSubtotal($(this).closest('tr'));
                    updateTotals();
                });

                $(document).on('click', '.remove-item', function() {
                    if ($('#items-table tbody tr').length <= 1) {
                        return;
                    }
                    $(this).closest('tr').remove();
                    reindexItems();
                    updateTotals();
                });

                $('input[name="discount_amount"], input[name="paid"]').on('input', updateTotals);
                updateTotals();
            });
        </script>
    @endSection
