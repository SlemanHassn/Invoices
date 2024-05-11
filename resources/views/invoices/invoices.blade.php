@extends('layouts.master')
@section('title', 'قائمة الفواتير')


@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    الفواتير</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('Add'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم إضافة الفاتورة بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif


    @if (session()->has('edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تعديل الفاتورة بنجاح",
                    type: "warning"
                })
            }
        </script>
    @endif

    @if (session()->has('delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف الفاتورة بنجاح",
                    type: "error"
                })
            }
        </script>
    @endif


    @if (session()->has('Status_Update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث حالة الدفع بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif

    @if (session()->has('restore_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم استعادة الفاتورة بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif
    @if (session()->has('arrchif'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم نقل الفاتورة الى الارشيف",
                    type: "warning"
                })
            }
        </script>
    @endif



    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    @can('إضافة فاتورة')
                        <a href="{{ route('invoices.create') }}" class="modal-effect btn  btn-primary" style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; اضافة فاتورة</a>
                    @endcan
                    @can('الارشيف')
                        <a href="{{ route('trached') }}"class=" btn  btn-success   " style="color:white"><i
                                class="fas fa-archive"></i>&nbsp; الارشيف </a>
                    @endcan
                    @can('تصدير اكسيل')
                        <a href="{{ route('exportInvoices') }}"class=" btn  btn-info   " style="color:white"><i
                                class="lar la-file-excel"></i>&nbsp; EXCEL </a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-primary  key-buttons text-md-nowrap"
                            data-page-length='10'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                    <th class="border-bottom-0">تاريخ القاتورة</th>
                                    <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                    <th class="border-bottom-0">البنك</th>
                                    <th class="border-bottom-0">المنتج</th>
                                    <th class="border-bottom-0">الخصم</th>
                                    <th class="border-bottom-0">نسبة الضريبة</th>
                                    <th class="border-bottom-0">قيمة الضريبة</th>
                                    <th class="border-bottom-0">الاجمالي</th>
                                    <th class="border-bottom-0">الحالة</th>
                                    <th class="border-bottom-0">ملاحظات</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($invoices as $invoice)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $invoice->invoice_num }}</td>
                                        <td>{{ $invoice->invoice_Date }}</td>
                                        <td>{{ $invoice->due_Date }}</td>
                                        <td>{{ $invoice->section->name }}</td>
                                        <td>{{ $invoice->category }}</td>
                                        <td>{{ $invoice->Discount }}</td>
                                        <td>{{ $invoice->Rate_VAT }} </td>
                                        <td>{{ $invoice->Value_VAT }}</td>
                                        <td>{{ $invoice->Total }} </td>
                                        <td>
                                            @if ($invoice->Value_Status == 2)
                                                <i class="bg-danger rounded  p-1 text-white">غير مدفوعة
                                                </i>
                                            @elseif($invoice->Value_Status == 1)
                                                <i class="bg-success rounded p-1 text-white"> مدفوعة
                                                </i>
                                            @else
                                                <i class="bg-warning rounded p-1 text-white">مدفوعة جزئيا
                                                </i>
                                            @endif
                                        </td>
                                        <td>{{ $invoice->note }}</td>

                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button"><i class="si si-options"></i></button>
                                                <div class="dropdown-menu tx-13">

                                                    @can('عرض فاتورة')
                                                        <a class="dropdown-item "
                                                            href="{{ route('details', [$invoice->id]) }}">
                                                            <i class="text-info  fe fe-alert-triangle"></i>
                                                            تفاصيل الفاتورة</a>
                                                    @endcan
                                                    @can('تعديل فاتورة')
                                                        <a class="dropdown-item"
                                                            href="{{ route('invoices.edit', [$invoice->id]) }}">
                                                            <i class="text-success las la-edit"></i>&nbsp;&nbsp;
                                                            تعديل الفاتورة</a>
                                                    @endcan
                                                    @can('حالة الدفع')
                                                        <a class="dropdown-item" href="{{ route('status', [$invoice->id]) }}">
                                                            <i class="text-success fas fa-money-check-alt"></i>&nbsp;&nbsp;

                                                            حالة الدفع</a>
                                                    @endcan
                                                    @can('نقل الى الارشيف')
                                                        <a class="dropdown-item href="#" data-invoice_id="{{ $invoice->id }}"
                                                            data-toggle="modal" data-target="#delete_invoice"><i
                                                                class="text-danger fas fa-archive"></i>&nbsp;&nbsp;
                                                            نقل الى الارشيف</a>
                                                    @endcan
                                                    @can('طباعة الفاتورة')
                                                        <a class="dropdown-item" href="{{ route('print', [$invoice->id]) }}"><i
                                                                class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                            الفاتورة
                                                        </a>
                                                    @endcan
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>

    <!-- حذف الفاتورة -->
    <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">نقل إلى الأرشيف</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    هل انت متاكد من النقل الى الارشيف ؟
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>

    <script>
        $('#Transfer_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>







@endsection
