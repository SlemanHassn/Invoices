    @extends('layouts.master')
    @section('title', 'قائمة المستخدمين')
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
                    <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                        قائمة المستخدمين</span>
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
                        msg: 'تمت اضافة المستخدم بنجاح',
                        type: "success"
                    })
                }
            </script>
        @endif
        @if (session()->has('edit'))
            <script>
                window.onload = function() {
                    notif({
                        msg: 'تمت تعديل بيانات المستخدم بنجاح',
                        type: "warning"
                    })
                }
            </script>
            @endif @if (session()->has('delete'))
                <script>
                    window.onload = function() {
                        notif({
                            msg: 'تمت حذف المستخدم بنجاح',
                            type: "error"
                        })
                    }
                </script>
            @endif
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mg-b-20">
                        <div class="card-header">
                            @can('create-user')
                                <a href="{{ route('users.create') }}" class="modal-effect btn  btn-primary"> إضافة مستخدم
                                    جديد</a>
                            @endcan
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="example1" class="table table-primary  key-buttons text-md-nowrap"
                                        data-page-length='10'style="text-align: center">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">الاسم</th>
                                                <th class="border-bottom-0">الايميل</th>
                                                <th class="border-bottom-0">الصلاحيات</th>
                                                <th class="border-bottom-0">حالة المستخدم</th>
                                                <th class="border-bottom-0">العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $user)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @forelse ($user->getRoleNames() as $role)
                                                            <span class="btn btn-primary py-0">{{ $role }}</span>
                                                        @empty
                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        @if ($user->activate == 'مفعل')
                                                            <span class="label text-success d-flex">
                                                                <div class="dot-label bg-success ml-1"></div>
                                                                {{ $user->activate }}
                                                            </span>
                                                        @else
                                                            <span class="label text-danger d-flex">
                                                                <div class="dot-label bg-danger ml-1"></div>
                                                                {{ $user->activate }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('users.destroy', $user->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <a href="{{ route('users.show', $user->id) }}"
                                                                class="btn btn-primary btn-sm"><i class="bi bi-eye"></i>
                                                                عرض</a>

                                                            @if (in_array('Super Admin', $user->getRoleNames()->toArray() ?? []))
                                                                @if (Auth::user()->hasRole('Super Admin'))
                                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                                        class="btn btn-success btn-sm"> تعديل</a>
                                                                @endif
                                                            @else
                                                                @can('edit-user')
                                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                                        class="btn btn-success btn-sm"><i
                                                                            class="bi bi-pencil-square"></i>
                                                                        تعديل</a>
                                                                @endcan

                                                                @can('delete-user')
                                                                    @if (Auth::user()->id != $user->id)
                                                                        <a href="#" data-target="#delete_user"
                                                                            data-toggle="modal" class="btn btn-danger btn-sm">
                                                                            حذف</a>
                                                                        <div class="modal fade" id="delete_user" tabindex="-1"
                                                                            role="dialog" aria-labelledby="exampleModalLabel"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="exampleModalLabel">حذف
                                                                                        </h5>
                                                                                        <button type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span
                                                                                                aria-hidden="true">&times;</span>
                                                                                        </button>

                                                                                    </div>

                                                                                    <form
                                                                                        action="{{ route('users.destroy', $user->id) }}"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <div class="modal-body text-right">
                                                                                            هل انت متاكد من الحذف ؟
                                                                                            <input type="hidden" name="id"
                                                                                                id="id"
                                                                                                value="{{ $user->id }}">
                                                                                            <input type="text"
                                                                                                class="form-control" readonly
                                                                                                value="{{ $user->name }}">
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            @can('delete-role')
                                                                                                <button type="submit"
                                                                                                    class="btn btn-danger">تاكيد</button>
                                                                                                <button type="button"
                                                                                                    class="btn btn-secondary"
                                                                                                    data-dismiss="modal">الغاء</button>
                                                                                            @endcan
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                    @endif
                                                                @endcan
                                                            @endif

                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <td colspan="5">
                                                    <span class="text-danger">
                                                        <strong>No User Found!</strong>
                                                    </span>
                                                </td>
                                            @endforelse
                                        </tbody>
                                    </table>


                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- row closed -->
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
            <!--Internal  Notify js -->
            <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
            <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
        @endsection
