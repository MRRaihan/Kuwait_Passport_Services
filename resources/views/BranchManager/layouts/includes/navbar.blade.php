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
                        <li><a href="{{ route('branchManager.profile') }}"> Profile</a></li>
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
                    <a href="{{ route('branchManager.dashboard') }}" class="waves-effect"><i
                            class="ti-home"></i><span> Dashboard </span></a>
                </li>

                <li>
                    <a href="{{ route('branchManager.dataEnterer.index') }}" class="waves-effect"><i
                            class="fa fa-briefcase"></i><span>Data Enterer</span></a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i> <span> Passport
                            Generate
                        </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('branchManager.renewPassport.create') }}">Renew Passports</a></li>
                        <li><a href="{{ route('branchManager.manualPassport.create') }}">Manual Passports</a></li>
                        <li><a href="{{ route('branchManager.lostPassport.create') }}">Lost Passports</a></li>
                        <li><a href="{{ route('branchManager.newBornBabyPassport.create') }}">New born baby Passports</a>
                        </li>
                    </ul>
                </li>

                {{-- Passport --}}
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i> <span> Passports
                        </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('branchManager.renewPassport.index') }}">Renew Passports</a></li>
                        <li><a href="{{ route('branchManager.manualPassport.index') }}">Manual Passports</a></li>
                        <li><a href="{{ route('branchManager.lostPassport.index') }}">Lost Passports</a></li>
                        <li>
                            <a href="{{ route('branchManager.newBornBabyPassport.index') }}">New Born Baby Passports</a>
                        </li>
                    </ul>
                </li>


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i> <span> User Passports
                        </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('branchManager.userRenewPassport.index') }}">Renew Passports</a></li>
                        <li><a href="{{ route('branchManager.userManualPassport.index') }}">Manual Passports</a></li>
                        <li><a href="{{ route('branchManager.userLostPassport.index') }}">Lost Passports</a></li>
                        <li>
                            <a href="{{ route('branchManager.userNewBornBabyPassport.index') }}">New Born Baby Passports</a>
                        </li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-files"></i> <span> Others
                            Servics
                        </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('branchManager.PremierService.index') }}">Premier Service</a></li>
                        <li><a href="{{ route('branchManager.expressService.index') }}">Express Service</a></li>
                        <li><a href="{{ route('branchManager.legalComplaintsService.index') }}">Legal and
                                Complaints</a></li>
                        <li><a href="{{ route('branchManager.immigrationGovementService.index') }}">Immigration</a>
                        </li>
                        <li><a href="{{ route('branchManager.otherService.index') }}">Others</a></li>
                    </ul>
                </li>

                {{-- Passport Options --}}
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i> <span> Passport
                            Processing</span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('branchManager.passportOption.shiftToAdmin') }}">Shift To Admin</a>
                        </li>
                        <li><a href="{{ route('branchManager.passportOption.receiveFromAdmin') }}">Receive From
                                Admin</a></li>
                        <li><a href="{{ route('branchManager.passportOption.delivery') }}">Delivery</a></li>

                    </ul>
                </li>
                {{-- Passport Delivery --}}
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i> <span> Passport Options</span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('branchManager.passportDelivery.delivery')}}">Delivery</a></li>
                    </ul>
                </li>
                {{-- Reports --}}
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-bar-chart"></i> <span> Reports
                        </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('branchManager.report.index') }}">All Reports</a></li>

                        <li><a href="{{ route('branchManager.allPassportReport.index') }}">All Passport Reports</a></li>

                        <li><a href="{{ route('branchManager.allOtherServicesReport.index') }}">All Other Services Reports</a></li>

                        <li><a href="{{ route('branchManager.shiftToAdminReport.index') }}">Shift To Admin
                                Report</a></li>
                        <li><a href="{{ route('branchManager.receiveFromAdminReport.index') }}">Receive From Admin
                                Report</a></li>
                        <li><a href="{{ route('branchManager.deliveryreport.index') }}">Delivery Report</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
