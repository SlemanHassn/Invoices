@extends('layouts.master')
@section('title', 'تعديل صلاحية ')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                تعديل الصلاحية</span>
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
                    <form action="{{ route('roles.update', $role->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">الاسم</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ $role->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="permissions"
                                class="col-md-4 col-form-label text-md-end text-start">الصلاحيات</label>
                            <div class="col-md-6">
                                <select class="form-control @error('permissions') is-invalid @enderror" multiple
                                    aria-label="Permissions" id="permissions" name="permissions[]" style="height: 200px;">
                                    @forelse ($permissions as $permission)
                                        <option
                                            class="mb-2
                                        {{ in_array($permission->id, $rolePermissions ?? []) ? 'text-primary p-1' : '' }}
                                        "
                                            value="{{ $permission->id }}"
                                            {{ in_array($permission->id, $rolePermissions ?? []) ? 'selected' : '' }}>
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
                        <input type="submit" value="تحديث" class="btn btn-success float-left mt-3 mr-2">

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
@endsection
