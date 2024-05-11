@extends('layouts.master')
@section('title', ' عرض الصلاحية ')
@section('css')
    <!-- Internal Data table css -->
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
                    تفاصيل الصلاحية </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header">

                    <a href="{{ route('roles.index') }}" class="btn btn-primary">&larr; رجوع</a>
                </div>
                <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>اسم
                                الصلاحيات:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $role->name }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>الصلاحيات
                                المسموحة:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            @if ($role->name == 'Super Admin')
                                <span class="btn btn-primary py-0">All</span>
                            @else
                                @forelse ($rolePermissions as $permission)
                                    <span class="btn btn-primary py-0">{{ $permission->name }}</span>
                                @empty
                                @endforelse
                            @endif
                        </div>
                    </div>
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
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
