<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="text-center">
                <img src="{{ asset(Auth::user()->image ?? get_static_option('user')) }}" alt="" class="img-circle">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">{{ Auth::user()->name ?? '' }}</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('dataEnterer.profile') }}"> Profile</a></li>
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
                    <a href="{{ route('dataEnterer.dashboard') }}" class="waves-effect"><i
                            class="ti-home"></i><span> Dashboard </span>
                    </a>
                </li>
                {{-- Passport --}}
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i> <span> Passport
                            Generate
                        </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('dataEnterer.renewPassport.create') }}">Renew Passports</a></li>
                        <li><a href="{{ route('dataEnterer.manualPassport.create') }}">Manual Passports</a></li>
                        <li><a href="{{ route('dataEnterer.lostPassport.create') }}">Lost Passports</a></li>
                        <li><a href="{{ route('dataEnterer.newBornBabyPassport.create') }}">New born baby Passports</a></li>

                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i> <span> Passports
                        </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">

                        <li><a href="{{ route('dataEnterer.renewPassport.index') }}">List Of Renew Passports</a></li>
                        <li><a href="{{ route('dataEnterer.manualPassport.index') }}">List Of Manual Passports</a></li>
                        <li><a href="{{ route('dataEnterer.lostPassport.index') }}">List Of Lost Passports</a></li>
                        <li><a href="{{ route('dataEnterer.newBornBabyPassport.index') }}">List Of New Born Baby Passport</a></li>

                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-files"></i> <span> Others
                            Servics
                        </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('dataEnterer.PremierService.index') }}">Premier Service</a></li>
                        <li><a href="{{ route('dataEnterer.expressService.index') }}">Express Service</a></li>
                        <li><a href="{{ route('dataEnterer.legalComplaintsService.index') }}">Legal and
                                Complaints</a></li>
                        <li><a href="{{ route('dataEnterer.immigrationGovementService.index') }}">Immigration</a>
                        </li>
                        <li><a href="{{ route('dataEnterer.otherService.index') }}">Others</a></li>
                    </ul>
                </li>
                {{-- Others --}}
                {{-- <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-files"></i> <span> Other
                            Services </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('dataEnterer.otherPassport.index') }}">All</a></li>
                        <li><a href="{{ route('dataEnterer.otherPassport.create') }}">Add New</a></li>
                    </ul>
                </li> --}}
                {{-- Reports --}}
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-bar-chart"></i> <span> Reports
                        </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('dataEnterer.report.index') }}">All Reports</a></li>
                        {{-- <li><a href="{{ route('dataEnterer.shiftToEmbassyreport.index') }}">Shift To Embassy Report</a></li> --}}
                        {{-- <li><a href="{{ route('dataEnterer.receiveToEmbassyreport.index') }}">Receive To Embassay Report</a></li> --}}
                        {{-- <li><a href="{{ route('dataEnterer.deliveryreport.index') }}">Delivery Report</a></li> --}}
                    </ul>
                </li>


            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
