@extends('backend.common.master')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Pharmacy Dashboard</h4>
                        <div class="text-muted fs-13 mt-1">Sales, stock, expiry, and cashier activity at a glance.</div>
                    </div>
                    <div class="text-muted fs-13 mt-2 mt-sm-0">
                        {{ now()->format('M d, Y') }}
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6 col-xl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="fs-14 text-muted">Today's Sales</span>
                                    <span class="avatar-sm bg-primary-subtle text-primary rounded d-inline-flex align-items-center justify-content-center">
                                        <i data-feather="shopping-cart" style="height: 18px; width: 18px"></i>
                                    </span>
                                </div>
                                <h3 class="mb-1 fw-semibold">{{ number_format($todaySales, 2) }}</h3>
                                <div class="text-muted fs-13">{{ $todaySaleCount }} invoice{{ $todaySaleCount === 1 ? '' : 's' }} today</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="fs-14 text-muted">This Month</span>
                                    <span class="avatar-sm bg-success-subtle text-success rounded d-inline-flex align-items-center justify-content-center">
                                        <i data-feather="bar-chart-2" style="height: 18px; width: 18px"></i>
                                    </span>
                                </div>
                                <h3 class="mb-1 fw-semibold">{{ number_format($monthSales, 2) }}</h3>
                                <div class="text-muted fs-13">{{ $monthSaleCount }} sale{{ $monthSaleCount === 1 ? '' : 's' }} this month</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="fs-14 text-muted">Estimated Profit</span>
                                    <span class="avatar-sm bg-info-subtle text-info rounded d-inline-flex align-items-center justify-content-center">
                                        <i data-feather="trending-up" style="height: 18px; width: 18px"></i>
                                    </span>
                                </div>
                                <h3 class="mb-1 fw-semibold">{{ number_format($monthProfit, 2) }}</h3>
                                <div class="text-muted fs-13">{{ number_format($todayProfit, 2) }} today</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="fs-14 text-muted">Inventory Value</span>
                                    <span class="avatar-sm bg-warning-subtle text-warning rounded d-inline-flex align-items-center justify-content-center">
                                        <i data-feather="package" style="height: 18px; width: 18px"></i>
                                    </span>
                                </div>
                                <h3 class="mb-1 fw-semibold">{{ number_format($inventoryValue, 2) }}</h3>
                                <div class="text-muted fs-13">{{ $activeMedicines }} active of {{ $totalMedicines }} medicines</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6 col-xl-3">
                        <div class="card border-warning h-100">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="text-muted fs-14">Low Stock Alerts</div>
                                    <h3 class="fw-semibold mb-0">{{ $lowStockCount }}</h3>
                                </div>
                                <i data-feather="alert-triangle" class="text-warning" style="height: 32px; width: 32px"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card border-danger h-100">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="text-muted fs-14">Expiring in 30 Days</div>
                                    <h3 class="fw-semibold mb-0">{{ $expiringSoonCount }}</h3>
                                </div>
                                <i data-feather="calendar" class="text-danger" style="height: 32px; width: 32px"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card h-100">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="text-muted fs-14">Average Sale</div>
                                    <h3 class="fw-semibold mb-0">{{ number_format($monthSaleCount > 0 ? $monthSales / $monthSaleCount : 0, 2) }}</h3>
                                </div>
                                <i data-feather="credit-card" class="text-primary" style="height: 32px; width: 32px"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="card h-100">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="text-muted fs-14">Profit Margin</div>
                                    <h3 class="fw-semibold mb-0">{{ number_format($monthSales > 0 ? ($monthProfit / $monthSales) * 100 : 0, 1) }}%</h3>
                                </div>
                                <i data-feather="percent" class="text-success" style="height: 32px; width: 32px"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Temperature Monitoring Section -->
                <div class="row g-3 mt-1">
                    <div class="col-xl-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                            <i data-feather="thermometer" class="widgets-icons"></i>
                                        </div>
                                        <h5 class="card-title mb-0">Temperature Monitoring</h5>
                                    </div>
                                    @if($latestTemperature && $latestTemperature->alarm)
                                        <span class="badge bg-danger">ALARM</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                @if($latestTemperature)
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="text-center p-3 rounded {{ $latestTemperature->alarm ? 'bg-danger-subtle' : 'bg-success-subtle' }}">
                                                <div class="text-muted fs-14">Temperature</div>
                                                <h2 class="fw-semibold mb-0 {{ $latestTemperature->alarm ? 'text-danger' : 'text-success' }}">
                                                    {{ number_format($latestTemperature->temperature, 1) }}°C
                                                </h2>
                                                <div class="fs-13 {{ $latestTemperature->alarm ? 'text-danger' : 'text-success' }}">
                                                    {{ $latestTemperature->status }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center p-3 rounded bg-info-subtle">
                                                <div class="text-muted fs-14">Humidity</div>
                                                <h2 class="fw-semibold mb-0 text-info">
                                                    {{ number_format($latestTemperature->humidity, 1) }}%
                                                </h2>
                                                <div class="fs-13 text-muted">
                                                    Normal
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 text-muted fs-13">
                                        <i data-feather="clock" style="height: 14px; width: 14px"></i>
                                        Last updated: {{ $latestTemperature->created_at->format('M d, Y H:i') }}
                                    </div>
                                @else
                                    <div class="text-center py-4 text-muted">
                                        <i data-feather="thermometer" style="height: 48px; width: 48px"></i>
                                        <p class="mt-2 mb-0">No temperature data available</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="plus-circle" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Log Temperature</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('temperature.store') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Temperature (°C)</label>
                                            <input type="number" step="0.1" name="temperature" class="form-control" required min="-50" max="100" placeholder="e.g., 22.5">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Humidity (%)</label>
                                            <input type="number" step="0.1" name="humidity" class="form-control" required min="0" max="100" placeholder="e.g., 45">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i data-feather="save" style="height: 16px; width: 16px"></i>
                                                Log Temperature
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @if($temperatureAlarmCount > 0)
                                    <div class="alert alert-danger mt-3 mb-0">
                                        <i data-feather="alert-triangle" style="height: 16px; width: 16px"></i>
                                        {{ $temperatureAlarmCount }} temperature alarm{{ $temperatureAlarmCount === 1 ? '' : 's' }} today
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Temperature Logs -->
                <div class="row g-3 mt-1">
                    <div class="col-xl-12">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="list" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Recent Temperature Logs</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                @if($recentTemperatureLogs->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-nowrap align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Date & Time</th>
                                                    <th>Temperature</th>
                                                    <th>Humidity</th>
                                                    <th>Status</th>
                                                    <th>Alarm</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($recentTemperatureLogs as $log)
                                                    <tr>
                                                        <td>{{ $log->created_at->format('M d, Y H:i') }}</td>
                                                        <td>{{ number_format($log->temperature, 1) }}°C</td>
                                                        <td>{{ number_format($log->humidity, 1) }}%</td>
                                                        <td>
                                                            <span class="badge {{ $log->status === 'Normal' ? 'bg-success' : ($log->status === 'Warning' ? 'bg-warning' : 'bg-danger') }}">
                                                                {{ $log->status }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @if($log->alarm)
                                                                <span class="badge bg-danger">
                                                                    <i data-feather="alert-triangle" style="height: 14px; width: 14px"></i>
                                                                    Yes
                                                                </span>
                                                            @else
                                                                <span class="badge bg-success">No</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-4 text-muted">
                                        <p class="mb-0">No temperature logs available</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-xl-8">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="bar-chart" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Monthly Sales</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="monthly-sales-chart" class="apex-charts" style="min-height: 320px"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="award" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Top Selling Medicines</h5>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Medicine</th>
                                                <th class="text-end">Qty</th>
                                                <th class="text-end">Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($topSellingMedicines as $item)
                                                <tr>
                                                    <td>{{ $item->medicine->name ?? 'Deleted medicine' }}</td>
                                                    <td class="text-end">{{ number_format($item->total_quantity) }}</td>
                                                    <td class="text-end">{{ number_format($item->total_revenue, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted py-4">No sales recorded yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-xl-6">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0">Low Stock Medicines</h5>
                                <a href="{{ route('view-medicines') }}" class="btn btn-sm btn-light">View all</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Medicine</th>
                                                <th>Category</th>
                                                <th class="text-end">Stock</th>
                                                <th class="text-end">Threshold</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($lowStockMedicines as $medicine)
                                                <tr>
                                                    <td>
                                                        <div class="fw-medium">{{ $medicine->name }}</div>
                                                        <div class="text-muted fs-13">{{ $medicine->supplier->name ?? 'No supplier' }}</div>
                                                    </td>
                                                    <td>{{ $medicine->category->name ?? '-' }}</td>
                                                    <td class="text-end">
                                                        <span class="badge bg-warning-subtle text-warning">{{ number_format($medicine->stock, 2) }}</span>
                                                    </td>
                                                    <td class="text-end">{{ number_format($medicine->low_stock_threshold) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted py-4">All medicines are above their thresholds.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Expiring Soon</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Medicine</th>
                                                <th>Supplier</th>
                                                <th class="text-end">Expiry Date</th>
                                                <th class="text-end">Days</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($expiringMedicines as $medicine)
                                                @php
                                                    $daysLeft = now()->startOfDay()->diffInDays($medicine->expiry_date, false);
                                                @endphp
                                                <tr>
                                                    <td>{{ $medicine->name }}</td>
                                                    <td>{{ $medicine->supplier->name ?? 'No supplier' }}</td>
                                                    <td class="text-end">{{ optional($medicine->expiry_date)->format('M d, Y') }}</td>
                                                    <td class="text-end">
                                                        <span class="badge {{ $daysLeft <= 7 ? 'bg-danger-subtle text-danger' : 'bg-warning-subtle text-warning' }}">
                                                            {{ $daysLeft }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted py-4">No medicines expire in the next 30 days.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-1 mb-3">
                    <div class="col-xl-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Cashier Performance This Month</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Cashier</th>
                                                <th class="text-end">Sales</th>
                                                <th class="text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($cashierPerformance as $cashier)
                                                <tr>
                                                    <td>{{ $cashier->cashier->name ?? 'Unknown user' }}</td>
                                                    <td class="text-end">{{ number_format($cashier->sales_count) }}</td>
                                                    <td class="text-end">{{ number_format($cashier->sales_total, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted py-4">No cashier activity this month.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0">Recent Sales</h5>
                                <a href="{{ route('view-sales') }}" class="btn btn-sm btn-light">View all</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Invoice</th>
                                                <th>Cashier</th>
                                                <th class="text-end">Items</th>
                                                <th class="text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($recentSales as $sale)
                                                <tr>
                                                    <td>
                                                        <div class="fw-medium">{{ $sale->invoice_number }}</div>
                                                        <div class="text-muted fs-13">{{ $sale->sold_at->format('M d, h:i A') }}</div>
                                                    </td>
                                                    <td>{{ $sale->cashier->name ?? 'Unknown user' }}</td>
                                                    <td class="text-end">{{ $sale->items->sum('quantity') }}</td>
                                                    <td class="text-end">{{ number_format($sale->total, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted py-4">No recent sales found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col fs-13 text-muted text-center">
                        &copy; <script>document.write(new Date().getFullYear());</script> Pharmacy System
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (!window.ApexCharts) {
                return;
            }

            new ApexCharts(document.querySelector('#monthly-sales-chart'), {
                chart: {
                    type: 'bar',
                    height: 320,
                    toolbar: { show: false }
                },
                series: [{
                    name: 'Sales',
                    data: @json($monthlySalesData)
                }],
                colors: ['#537AEF'],
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        borderRadius: 4,
                        borderRadiusApplication: 'end'
                    }
                },
                dataLabels: { enabled: false },
                xaxis: {
                    categories: @json($monthlySalesLabels)
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            return Number(value).toLocaleString();
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (value) {
                            return Number(value).toLocaleString(undefined, {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                        }
                    }
                },
                grid: {
                    strokeDashArray: 4
                }
            }).render();
        });
    </script>
@endpush
