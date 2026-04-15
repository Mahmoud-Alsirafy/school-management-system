<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}}
        </li>

        <!-- الامتحانات-->
        <li>
            <a href="{{route('student_exams.index')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{trans('main_trans.Exams')}}</span></a>
        </li>


        <!-- Onlinec lasses-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span
                        class="right-nav-text">{{trans('main_trans.Onlineclasses')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('Online.index') }}">{{ trans('main_trans.Onlineclasses') }}</a> </li>
            </ul>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{ route('Setting.index') }}">
                <div class="pull-left"><i class="fas fa-cogs"></i><span
                        class="right-nav-text">{{trans('main_trans.Settings')}}</span></div>
                <div class="clearfix"></div>
            </a>
        </li>

        <!-- Profile-->
        <li>
            <a href="{{ route('profile_stu.index') }}">
                <div class="pull-left"><i class="fas fa-user"></i><span
                        class="right-nav-text">{{trans('main_trans.Profile')}}</span></div>
                <div class="clearfix"></div>
            </a>
        </li>


        <!-- Users-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users-icon">
                <div class="pull-left"><i class="fas fa-users"></i><span
                        class="right-nav-text">{{trans('main_trans.Users')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Users-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('qrcode.index')}}">{{trans('main_trans.QR')}}</a> </li>

            </ul>
        </li>

    </ul>
</div>
