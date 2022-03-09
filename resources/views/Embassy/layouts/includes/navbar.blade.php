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
                        <li><a href="{{ route('embassy.profile') }}"> Profile</a></li>
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
                    <a href="{{ route('embassy.dashboard') }}" class="waves-effect"><i class="ti-home"></i><span> Dashboard </span></a>
                </li>

               
                {{-- Reports --}}
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-bar-chart"></i> <span> Passport Processing </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">

                        <li>
                            <a href="{{ route('embassy.passportOption.receiveToEmbassy') }}" class="waves-effect"><i class="ti-new-window"></i><span> Received From Admin</span></a>
                        </li>
        
                        <li>
                            <a href="{{ route('embassy.passportOption.delivery') }}" class="waves-effect"><i class="ti-check-box"></i><span> Delivary To Admin</span></a>
                        </li>
        
                        <li>
                            <a href="{{ route('embassy.passportOption.allDelivery') }}" class="waves-effect"><i class="ti-check-box"></i><span> All Delivery</span></a>
                        </li>
                        
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-bar-chart"></i> <span>Reports</span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('embassy.deliveryreport.index')}}">All Delivery Report</a></li>
                    </ul>
                </li>


            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
