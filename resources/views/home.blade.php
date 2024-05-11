@extends('layouts.master')
@section('title', 'لوحة التحكم ')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">برنامج ادراة الفواتير</h2>

            </div>
        </div>

    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">إجمالي الفواتير</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    $<span
                                        class="counter mb-0 text-white">{{ number_format(App\Models\invoice::sum('Total'), 2) }}</span>
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">العدد :
                                    {{ App\Models\invoice::count() }}
                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <span class="text-white op-7"> 100%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">إجمالي الفواتير الغير مدفوعة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    $<span
                                        class="counter mb-0 text-white">{{ number_format(App\Models\invoice::where('Value_Status', 2)->sum('Total'), 2) }}</span>
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">العدد :
                                    {{ App\Models\invoice::where('Value_Status', 2)->count() }}</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <span class="text-white op-7">
                                    {{ round(App\Models\invoice::where('Value_Status', 2)->count() / App\Models\invoice::count(), 4) * 100 }}%
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">إجمالي الفواتير المدفوعة </h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    $<span
                                        class="counter mb-0 text-white">{{ number_format(App\Models\invoice::where('Value_Status', 1)->sum('Total'), 2) }}</span>
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">العدد :
                                    {{ App\Models\invoice::where('Value_Status', 1)->count() }}</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <span class="text-white op-7">

                                    {{ round(App\Models\invoice::where('Value_Status', 1)->count() / App\Models\invoice::count(), 4) * 100 }}%
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">الفواتير المدفوعة جزئيا</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    $<span
                                        class="counter mb-0 text-white">{{ number_format(App\Models\invoice::where('Value_Status', 3)->sum('Total'), 2) }}</span>
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">العدد :
                                    {{ App\Models\invoice::where('Value_Status', 3)->count() }}</p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <span class="text-white op-7">
                                    {{ round(App\Models\invoice::where('Value_Status', 3)->count() / App\Models\invoice::count(), 4) * 100 }}%

                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>

            </div>
        </div>
    </div>

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-lg-12 col-xl-5">
            <div class="card card-dashboard-map-one">
                <label class="main-content-label">نسب الفوتير</label>
                <div class="">
                    {!! $chartjs2->render() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-7">
            <div class="card card-dashboard-map-one">
                <div class="">
                    {!! $chartjs1->render() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card mg-b-20" id="map">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        Vector Map: World
                    </div>
                    <p class="mg-b-20">It is Very Easy to Customize and it uses in your website apllication.</p>
                    <div class="ht-300" id="vmap"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ URL::asset('assets/js/vector-map.js') }}"></script>
    <!-- Internal Vector-sampledata js -->
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>


    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Counters -->
    <script src="{{ URL::asset('assets/plugins/counters/waypoints.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/counters/counterup.min.js') }}"></script>
    <!--Internal Time Counter -->
    <script src="{{ URL::asset('assets/plugins/counters/jquery.missofis-countdown.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/counters/counter.js') }}"></script>
@endsection
