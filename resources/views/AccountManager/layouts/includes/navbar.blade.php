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
                        <li><a href="{{ route('accountManager.profile') }}"> Profile</a></li>
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
                    <a href="{{ route('accountManager.dashboard') }}" class="waves-effect"><i class="ti-home"></i><span> Dashboard </span></a>
                </li>
                {{-- Reports --}}
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-bar-chart"></i> <span> Reports </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('accountManager.report.index') }}">All Reports</a></li>
                        <li><a href="{{ route('accountManager.allPassportReport') }}">All Passport Report</a></li>

                        <li><a href="{{ route('accountManager.allOtherServicesReport.index') }}">All Others Services Report</a></li>

                        <li><a href="{{ route('accountManager.shiftToEmbassyreport.index') }}">Shift To Embassy
                                Report</a></li>

                        <li><a href="{{ route('accountManager.receiveFromEmbassyreport.index') }}">Receive From Embassay
                                Report</a></li>

                        <li><a href="{{ route('accountManager.deliveryBranchreport.index') }}">Delivery (Branch & Call Center) Report</a></li>

                        <li><a href="{{ route('accountManager.deliveryreport.index') }}">Delivery To User Report</a></li>
                    </ul>
                </li>
                 {{-- <li>
                    <a href="{{ route('accountManager.branchManager.index') }}" class="waves-effect"><i class="fa fa-briefcase"></i><span>Branch Manger </span></a>
                </li> --}}

                {{-- category --}}
                {{-- <li>
                    <a href="{{ route('accountManager.category.index') }}" class="waves-effect {{\Illuminate\Support\Facades\Request::is('admin/category/*') ? 'active': ''}}"><i class="ti-home"></i><span> Category </span></a>
                </li> --}}



            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
