@extends('layouts.admin.app')

@section('content')

<section class="content">
<main>

    <div class="row">

        <!-- Users -->
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>{{ __('Users') }}</h4>
                    <p><b>{{ $usersCount }}</b></p>
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon">
                <i class="icon fa fa-cubes fa-3x"></i>
                <div class="info">
                    <h4>{{ __('Products') }}</h4>
                    <p><b>{{ $productsCount }}</b></p>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon">
                <i class="icon fa fa-tags fa-3x"></i>
                <div class="info">
                    <h4>{{ __('Categories') }}</h4>
                    <p><b>{{ $categorysCount }}</b></p>
                </div>
            </div>
        </div>

        <!-- Orders -->
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
                <i class="icon fa fa-shopping-cart fa-3x"></i>
                <div class="info">
                    <h4>{{ __('Orders') }}</h4>
                    <p><b>{{ $ordersCount }}</b></p>
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon">
                <i class="icon fa fa-money fa-3x"></i>
                <div class="info">
                    <h4>{{ __('Revenue') }}</h4>
                    <p><b>${{ $totalRevenue }}</b></p>
                </div>
            </div>
        </div>

    </div>

    <!-- LINE CHART: Orders + Revenue -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">{{ __('Monthly Orders & Revenue') }}</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="lineChartOrdersRevenue"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- BAR CHART: Top 20 Products -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">{{ __('Top 20 Selling Products') }}</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="barChartTopProducts"></canvas>
                </div>
            </div>
        </div>
    </div>

</main>
</section>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
$(document).ready(function () {

    const monthNames = ["{{ __('Jan') }}","{{ __('Feb') }}","{{ __('Mar') }}","{{ __('Apr') }}","{{ __('May') }}","{{ __('Jun') }}","{{ __('Jul') }}","{{ __('Aug') }}","{{ __('Sep') }}","{{ __('Oct') }}","{{ __('Nov') }}","{{ __('Dec') }}"];

    // -------------------------
    // LINE CHART: Orders + Revenue
    // -------------------------
    const monthlyOrders = @json($monthlyOrders ?? []);
    const monthlyRevenue = @json($monthlyRevenue ?? []);

    const labels = Object.keys(monthlyOrders).map(m => monthNames[m-1]);
    const orderValues = Object.values(monthlyOrders);
    const revenueValues = Object.values(monthlyRevenue);

    const ctxLine = document.getElementById('lineChartOrdersRevenue');
    if(ctxLine){
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: '{{ __("Number of Orders") }}',
                        data: orderValues,
                        borderWidth: 2,
                        tension: 0.4,
                        backgroundColor: 'rgba(54,162,235,0.2)',
                        borderColor: 'rgba(54,162,235,1)',
                        fill: true,
                        yAxisID: 'yOrders'
                    },
                    {
                        label: '{{ __("Revenue (EGP)") }}',
                        data: revenueValues,
                        borderWidth: 2,
                        tension: 0.4,
                        backgroundColor: 'rgba(255,159,64,0.2)',
                        borderColor: 'rgba(255,159,64,1)',
                        fill: true,
                        yAxisID: 'yRevenue'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    yOrders: {
                        type: 'linear',
                        position: 'left',
                        beginAtZero: true,
                        title: { display: true, text: '{{ __("Orders") }}' }
                    },
                    yRevenue: {
                        type: 'linear',
                        position: 'right',
                        beginAtZero: true,
                        title: { display: true, text: '{{ __("Revenue (EGP)") }}' },
                        grid: { drawOnChartArea: false }
                    }
                }
            }
        });
    }

    // -------------------------
    // BAR CHART: Top 20 Products
    // -------------------------
    const topProducts = @json($topProducts ?? []);
    const productLabels = topProducts.map(p => p.name);
    const productValues = topProducts.map(p => p.quantity);

    const ctxBar = document.getElementById('barChartTopProducts');
    if(ctxBar){
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: productLabels,
                datasets: [{
                    label: '{{ __("Quantity Sold") }}',
                    data: productValues,
                    backgroundColor: 'rgba(75,192,192,0.6)',
                    borderColor: 'rgba(75,192,192,1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });
    }

});
</script>

@endpush