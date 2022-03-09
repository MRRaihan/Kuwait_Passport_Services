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
                        <li><a href="{{ route('admin.profile') }}"> Profile</a></li>
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
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect"><i
                            class="ti-home"></i><span> Dashboard </span></a>
                </li>

                <li>
                    <a href="{{ route('admin.branch.index') }}" class="waves-effect"><i
                            class="fa fa-users"></i><span>Branch</span></a>
                </li>

                <li>
                    <a href="{{ route('admin.delivery.index') }}" class="waves-effect"><i
                            class="fa fa-users"></i><span>Delivery</span></a>
                </li>

                <li>
                    <a href="{{ route('admin.branchManager.index') }}" class="waves-effect"><i
                            class="fa fa-briefcase"></i><span>Branch Manager </span></a>
                </li>

                <li>
                    <a href="{{ route('admin.dataEnterer.index') }}" class="waves-effect"><i
                            class="fa fa-briefcase"></i><span>Data Enterer</span></a>
                </li>

                <li>
                    <a href="{{ route('admin.callCenter.index') }}" class="waves-effect"><i
                            class="fa fa-volume-control-phone"></i><span> Call Center </span></a>
                </li>
                <li>
                    <a href="{{ route('admin.accountManager.index') }}" class="waves-effect"><i
                            class="fa fa-dollar (alias)"></i><span> Accounts Manager </span></a>
                </li>

                <li>
                    <a href="{{ route('admin.embassy.index') }}" class="waves-effect"><i
                            class="fa fa-flag (alias)"></i><span> Embassy </span></a>
                </li>

                <li>
                    <a href="{{ route('admin.profession.index') }}" class="waves-effect"><i
                            class="fa fa-id-card"></i><span> Profession </span></a>
                </li>

                <li>
                    <a href="{{ route('admin.passportFee.index') }}" class="waves-effect"><i
                            class="fa fa-money"></i><span> Passports Fee </span></a>
                </li>

                {{-- <li>
                    <a href="{{ route('admin.salary.index') }}" class="waves-effect"><i
                            class="fa fa-money"></i><span> Salary </span></a>
                </li> --}}

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i> <span> Passports
                            Generate
                        </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('admin.renewPassport.create') }}">Renew Passports</a></li>
                        <li><a href="{{ route('admin.manualPassport.create') }}">Manual Passports</a></li>
                        <li><a href="{{ route('admin.lostPassport.create') }}">Lost Passports</a></li>
                        <li><a href="{{ route('admin.newBornBabyPassport.create') }}">New Born Baby
                                Passports</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i> <span> Passports
                        </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('admin.renewPassport.index') }}">List Of Renew Passports</a></li>
                        <li><a href="{{ route('admin.manualPassport.index') }}">List Of Manual Passports</a>
                        <li><a href="{{ route('admin.lostPassport.index') }}">List Of Lost Passports</a></li>
                        <li><a href="{{ route('admin.newBornBabyPassport.index') }}">List Of New Born Baby Passports</a></li>
                    </ul>
                </li>

                {{-- Recycle bin --}}
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-trash"></i> <span> Recycle bin
                        </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('admin.recycleBin.renewList') }}">List Of Renew Passports</a></li>
                        <li><a href="{{ route('admin.recycleBin.manualList') }}">List Of Manual Passports</a>
                        <li><a href="{{ route('admin.recycleBin.lostList') }}">List Of Lost Passports</a></li>
                        <li><a href="{{ route('admin.recycleBin.newBornBabyList') }}">List Of New Born Baby Passports</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-filter"></i> <span> Passport
                            Processing</span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('admin.passportOption.shiftToEmbassy') }}">Shift To Embassy</a>
                        </li>
                        <li><a href="{{ route('admin.passportOption.receiveFromEmbassy') }}">Receive From
                                Embassy</a></li>
                        <li><a href="{{ route('admin.passportOption.callCenterStatus') }}">Call Center Status</a>
                        </li>
                        <li><a href="{{ route('admin.passportOption.allDeliveryFromBranch') }}">All Deliveries From
                                Branch</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.otherServiceFee.index') }}" class="waves-effect"><i
                            class="ion-android-note"></i><span>Other Services Fee</span></a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-files"></i> <span> Others
                            Services
                        </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('admin.PremierService.index') }}">Premier Services</a></li>
                        <li><a href="{{ route('admin.expressService.index') }}">Express Services</a></li>
                        <li><a href="{{ route('admin.legalComplaintsService.index') }}">Legal and
                                Complaints</a></li>
                        <li><a href="{{ route('admin.immigrationGovementService.index') }}">Immigration</a></li>
                        <li><a href="{{ route('admin.otherService.index') }}">Others</a></li>
                    </ul>
                </li>


                {{-- reports dropdown --}}

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="ti-files"></i> <span> Reports</span> <span class="pull-right"><i
                                class="mdi mdi-plus"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('admin.report.index') }}">All Reports</a></li>

                        <li><a href="{{ route('admin.allPassportReport') }}">All Passport Report</a></li>

                        <li><a href="{{ route('admin.allOtherServicesReport.index') }}">All Others Services Report</a></li>

                        <li><a href="{{ route('admin.shiftToEmbassyreport.index') }}">Shift To Embassy
                                Report</a></li>

                        <li><a href="{{ route('admin.receiveFromEmbassyreport.index') }}">Receive From Embassay
                                Report</a></li>

                        <li><a href="{{ route('admin.deliveryBranchreport.index') }}">Delivery (Branch & Call Center) Report</a></li>

                        <li><a href="{{ route('admin.deliveryreport.index') }}">Delivery To User Report</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ion-gear-a"></i> <span>Landing Settings
                        </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('admin.bannerEdit') }}">Banner Footer Setting</a></li>
                        <li><a href="{{ route('admin.pricingPlan.index') }}">Pricing plan</a></li>
                        <li><a href="{{ route('admin.pageServices.index') }}">Services</a></li>
                        {{-- <li><a href="{{ route('admin.salary.index') }}">Salary</a></li> --}}
                    </ul>
                </li>
                <li class="">
                    <a href="{{ route('admin.importExport') }}" class="waves-effect"><i class="ion-android-storage"></i> <span> Export And Import</a>
                </li>
                </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
