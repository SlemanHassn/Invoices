@extends('layouts.master')
@section('title', 'الفئات')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الإعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الفئات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-style-none">
                @foreach ($errors->all() as $error)
                    <strong>
                        <li>{{ $error }}</li>
                    </strong>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('Add'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تمت الإضافة بنجاح",
                    type: "success"
                })
            }
        </script>
    @endif


    @if (session()->has('edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم التعديل  بنجاح",
                    type: "warning"
                })
            }
        </script>
    @endif

    @if (session()->has('delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم الحذف  بنجاح",
                    type: "error"
                })
            }
        </script>
    @endif
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">



                    <div class="col-sm-6 col-md-3 col-xl-2 mg-t-20">
                        @can('إضافة فئة')
                            <a class="modal-effect btn btn-primary  btn-block" data-effect="effect-rotate-bottom"
                                data-toggle="modal" href="#modaldemo8">إضافة فئة</a>
                        @endcan
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">اسم الفئة</th>
                                    <th class="wd-15p border-bottom-0">اسم الفئة</th>
                                    <th class="wd-15p border-bottom-0">الوصف</th>
                                    <th class="wd-15p border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($categories as $category)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->section->name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            @can('تعديل فئة')
                                                <a class="modal-effect btn btn-success" data-id="{{ $category->id }}"
                                                    data-name="{{ $category->name }}"
                                                    data-description="{{ $category->description }}"
                                                    data-section_id="{{ $category->section_id }}"
                                                    data-effect="effect-rotate-bottom" data-toggle="modal"
                                                    href="#modaldemo7">تعديل</a>
                                            @endcan
                                            @can('حذف فئة')
                                                <a class="modal-effect btn btn-danger " data-effect="effect-rotate-bottom"
                                                    data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                                    data-toggle="modal" href="#modaldemo6">حذف</a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </div>
                </div>
                </table>
            </div>
        </div>
    </div>
    <!-- row closed -->
    {{-- Add --}}
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">إضافة فئة</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('categories.store') }}" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" required id="name" name="name"
                                placeholder="اسم الفئة">
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="section_d" required name="section_id">
                                <option value="" selected>حدد بنك</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="الوصف">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit">إضافة</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Edit --}}
    <div class="modal" id="modaldemo7">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل الفئة</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="form-horizontal" method="POST" action="categories/update" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" required class="form-control" id="name" name="name"
                                placeholder="اسم الفئة">
                            <input type="hidden" id="id" name="id">
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="section_id" required name="section_id">
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="الوصف">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" type="submit">حفظ التغيرات</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo6">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف فئة</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form class="form-horizontal" method="POST" action="categories/destroy" autocomplete="off">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <div class="form-group">
                            <h6>هل أنت متأكد أنك تريد حذف هذه الفئة ؟</h6>
                        </div>
                        <div class="form-group">
                            <input type="text" required readonly class="form-control" id="name" name="name">
                            <input type="hidden" readonly class="form-control" id="id" name="id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-danger" type="submit">حذف</button>
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إلغاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
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
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <script>
        $('#modaldemo7').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var description = button.data('description');
            var section_id = button.data('section_id');
            var modal = $(this);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #section_id').val(section_id);
            modal.find('.modal-body #id').val(id);
        });
        $('#modaldemo6').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var modal = $(this);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #id').val(id);
        });
    </script>
@endsection
