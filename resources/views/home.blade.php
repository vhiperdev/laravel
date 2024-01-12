@extends('layouts.app')

@section('content')

@php
// Extract the years and counts
$years = $subscribersData->pluck('year')->toArray();
$subscribersCount = $subscribersData->pluck('count')->toArray();


// Extract the years and counts
$statusCounts = $subscribersData->pluck('count')->toArray();
$statusLabels = $subscribersData->pluck('active_status')->toArray();

// Encode the data to be used in JavaScript
$statusCounts2 = json_encode($statusCounts);
$statusLabels2 = json_encode($statusLabels);


@endphp



@push("header-includes")

<script src="https://raw.githubusercontent.com/nnnick/Chart.js/master/dist/Chart.bundle.js"></script>
<script>
    var year = <?php echo json_encode($years); ?>;
    var data_click = <?php echo json_encode($subscribersCount); ?>; // Sample click data

    var barChartData = {
        labels: year,
        datasets: [{
            label: 'Subscribers',
            backgroundColor: "rgba(220,220,220,0.5)",
            data: data_click
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("subscribersThisYear").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: 'rgb(0, 255, 0)',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Number of Subscribers this year'
                }
            }
        });


        var label = <?php echo json_encode($statusLabels2); ?>;
        var statusCount = <?php echo json_encode($statusCounts2); ?>; // Sample click data


        var barChartData2 = {
            labels: label,
            datasets: [{
                label: 'Number of subscribers',
                backgroundColor: "rgba(220,220,220,0.5)",
                data: statusCount
            }]
        };

        var ctxB = document.getElementById("customerStatistics").getContext("2d");

        window.myBar = new Chart(ctxB, {
            type: 'pie',
            data: barChartData2,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: 'rgb(0, 255, 0)',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Yearly Website Visitor'
                }
            }
        });
    }
</script>
@endpush



<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{__('messages.dashboard')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{__('messages.dashboard')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$total_products }}</h3>
                            <p>Total Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('products')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$total_plans }}</h3>
                            <p>Total Plan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('plans')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$total_customers}}</h3>
                            <p>Total Customers</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('customers')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Subscriptions</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$active_subscriptions}}</h3>
                            <p>Active Subscriptions</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$inactive_subscriptions }}</h3>
                            <p>Inactive</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('plans')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$expiring_this_week }}</h3>
                            <p>Expiring This week</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('products')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$resellers}}</h3>
                            <p>Number of resellers</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('customers')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <section class="col-lg-7 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Subscribers this year
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="tab-content p-0">
                                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px">
                                    <canvas id="subscribersThisYear" height="280" width="600"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>


                </section>

                <section class="col-lg-5 connectedSortable">

                    <div class="card bg-gradient-info">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-th mr-1"></i>
                                Annual Subscribers Statistics
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas class="chart" id="customerStatistics" style="
                                min-height: 250px;
                                height: 250px;
                                max-height: 250px;
                                max-width: 100%;
                            "></canvas>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
 
@endsection