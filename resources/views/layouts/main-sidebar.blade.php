<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/logo.png') }}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/logo-white.png') }}" class="main-logo dark-theme"
                alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/favicon.png') }}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . ($page = 'index')) }}"><img
                src="{{ URL::asset('assets/img/brand/favicon-white.png') }}" class="logo-icon dark-theme"
                alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround"
                        src="{{ URL::asset('assets/img/faces/6.jpg') }}"><span
                        class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ auth()->user()->name }}</h4>
                    <span class="mb-0 text-muted">{{ auth()->user()->email }}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">القائمة</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ route('home') }}">
                    <img src="{{ URL::asset('assets/img/svgicons/66.png') }}" class="side-menu__icon" alt="">
                    <span class="side-menu__label">لوحة اتحكم</span></a>
            </li>
            @can('الفواتير')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"> <img
                            src="{{ URL::asset('assets/img/svgicons/invoices.png') }}" class="side-menu__icon"
                            alt="">
                        <span class="side-menu__label">الفواتير</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @can('قائمة الفواتير')
                            <li><a class="slide-item" href="{{ route('invoices.index') }}">قائمة الفواتير</a></li>
                        @endcan
                        @can('الفواتير المدفوعة')
                            <li><a class="slide-item" href="{{ route('paid') }}">الفواتير المدفوعة</a></li>
                        @endcan
                        @can('الفواتير الغير المدفوعة')
                            <li><a class="slide-item" href="{{ route('unpaid') }}">الفواتير الغير مدفوعة</a>
                            </li>
                        @endcan
                        @can('الفواتير المدفوعة جزئيا')
                            <li><a class="slide-item" href="{{ route('somepaid') }}">الفواتير المدفوعة جزئيا</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('التقارير')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><img
                            src="{{ URL::asset('assets/img/svgicons/reports.png') }}" class="side-menu__icon"
                            alt=""><span class="side-menu__label">التقارير</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @can('تقارير الفواتير')
                            <li><a class="slide-item" href="{{ route('Invoices_reports') }}">تقارير الفواتير</a>
                            </li>
                        @endcan
                        @can('تقارير العملاء')
                            <li><a class="slide-item" href="{{ route('customers_report') }}">تقارير العملاء</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('المستخدمين')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><img
                            src="{{ URL::asset('assets/img/svgicons/users.png') }}" class="side-menu__icon"
                            alt=""><span class="side-menu__label">المستخدمين</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @can('قائمة المستخدمين')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'users')) }}">قائمة المستخدمين</a></li>
                        @endcan
                        @can('صلاحيات المستخدم')
                            <li><a class="slide-item" href="{{ url('/' . ($page = 'roles')) }}">صلاحيات المستخدم</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('الاعدادات')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . ($page = '#')) }}"><img
                            src="{{ URL::asset('assets/img/svgicons/setting.png') }}" class="side-menu__icon"
                            alt=""><span class="side-menu__label">الاعدادات</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @can('البنوك')
                            <li><a class="slide-item" href="{{ route('sections.index') }}">البنوك</a></li>
                        @endcan
                        @can('الفئات')
                            <li><a class="slide-item" href="{{ route('categories.index') }}">الفئات</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </div>
</aside>
<!-- main-sidebar -->
