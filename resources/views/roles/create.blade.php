@extends('layouts.master')
@section('title', 'إضافة صلاحية ')
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
                    اضافة صلاحية</span>
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
                    <a href="{{ route('roles.index') }}" class="btn btn-primary ">&larr; رجوع</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf

                        <div class="mb-3 row">
                            <label for="name" class="col-md-2 col-form-label text-md-end text-start">اسم
                                الصلاحية</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="permissions"
                                class="col-md-2 col-form-label text-md-end text-start">الصلاحيات</label>
                            <div class="col-md-6">
                                <select class="form-control mb-3 @error('permissions') is-invalid @enderror" multiple
                                    aria-label="Permissions" id="permissions" name="permissions[]" style="height: 200px;">
                                    @forelse ($permissions as $permission)
                                        <option class="mb-2" value="{{ $permission->id }}"
                                            {{ in_array($permission->id, old('permissions') ?? []) ? 'selected' : '' }}>
                                            {{ $permission->name }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                                @if ($errors->has('permissions'))
                                    <span class="text-danger">{{ $errors->first('permissions') }}</span>
                                @endif
                            </div>
                        </div>

                        <input type="submit" value="إضافة" class="btn btn-success px-5 float-left mt-3 mr-2">

                        </input>
                    </form>
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
