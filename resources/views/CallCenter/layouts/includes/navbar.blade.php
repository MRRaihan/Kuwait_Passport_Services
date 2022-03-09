<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="text-center">
                <img src="{{ asset(Auth::user()->image ?? get_static_option('user')) }}" alt="" class="img-circle">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name ?? '' }}</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('callCenter.profile') }}"> Profile</a></li>
                        <li class="divider"></li>
                        <li><a class="logout-btn" href="javascript:void(0)"> Logout</a></li>
                    </ul>
                </div>

                <p class="text-muted m-0"><i class="fa fa-dot-circle-o text-success"></i> Online</p>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
               <li>
                    <a href="{{ route('callCenter.dashboard') }}" class="waves-effect"><i class="ti-home"></i><span> Dashboard </span></a>
                </li>
                {{-- Passport Options --}}
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i> <span> Passport Options</span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('callCenter.passportOption.delivery')}}">Delivery</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i> <span>All Reports</span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('callCenter.report.index')}}">Remarks Reports</a></li>
                    </ul>
                </li>


            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
