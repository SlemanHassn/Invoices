@extends('layouts.master')
@section('title', 'تعديل بيانات مستخدم')
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
                تعديل ابيانات المستخدمين</span>
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
                    <a href="{{ route('users.index') }}" class="btn btn-primary">&larr; رجوع</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ $user->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email
                                Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ $user->email }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password_confirmation"
                                class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Roles</label>
                            <div class="col-md-6">
                                <select class="form-control @error('roles') is-invalid @enderror" multiple
                                    aria-label="Roles" id="roles" name="roles[]">
                                    @forelse ($roles as $role)
                                        @if ($role != 'Super Admin')
                                            <option value="{{ $role }}"
                                                class="mb-2
                                        {{ in_array($role, $userRoles ?? []) ? 'text-primary p-1' : '' }}
                                        "
                                                {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @else
                                            @if (Auth::user()->hasRole('Super Admin'))
                                                <option value="{{ $role }}"
                                                    class="mb-2
                                        {{ in_array($role, $userRoles ?? []) ? 'text-primary p-1' : '' }}
                                        "
                                                    {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>
                                                    {{ $role }}
                                                </option>
                                            @endif
                                        @endif

                                    @empty
                                    @endforelse
                                </select>
                                @if ($errors->has('roles'))
                                    <span class="text-danger">{{ $errors->first('roles') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="roles" class="col-md-4 col-form-label text-md-end text-start">حالة
                                المستخدم</label>
                            <div class="col-md-6">
                                <select class="form-control " id="activate" name="activate">
                                    <option value="">...</option>
                                    <option value="مفعل" {{ $user->activate == 'مفعل' ? 'selected' : '' }}>مفعل
                                    </option>
                                    <option value="غير مفعل" {{ $user->activate == 'غير مفعل' ? 'selected' : '' }}>
                                        غير
                                        مفعل</option>
                                </select>

                            </div>
                        </div>

                        <input type="submit" value="تحديث" class="btn btn-success px-5 float-left mt-3 mr-2">


                    </form>
                </div>
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
@endsection
