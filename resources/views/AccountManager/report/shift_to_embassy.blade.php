@extends('AccountManager.layouts.master')

@push('title')
Account Manager
@endpush

@section('content')
<div class="content">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header-title">
                    <h4 class="pull-left page-title">Reports</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('accountManager.dashboard') }}">Account Manager Panel</a></li>
                        <li class="active">Reports</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row text-left">
            <div class="panel bg-info">
                <h4 class="pull-left page-title">&nbsp;&nbsp;Date Wise Shift To Embassy Report</h4>
                <div class="clearfix"></div>
            </div>

            <div class="col-sm-12">

                <div class="col-md-3">
                    <label for="from_date">From</label>
                    <input type="date" name="from_date" id="from_date"  class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="to_date">To</label>
                    <input type="date" name="to_date" id="to_date"  class="form-control">
                </div>

                <div class="col-md-3">
                    <label for="branch">branch</label>
                    <select class="form-control" name="branch_id" id="branch_id">
                        <option value="0">&nbsp;&nbsp;&nbsp;&nbsp;All Branch</option>
                        @if(isset($branches[0]))
                        @foreach ($branches as $key => $branch)
                            <option value="{{$branch->id}}"   {{ $branch->id == $branch_id ? 'selected' : '' }}   >&nbsp;&nbsp;&nbsp;&nbsp;{{$branch->name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="date">Passport Type</label>
                    <select class="form-control" name="option_id" id="option_id">
                        <option value="-1">&nbsp;&nbsp;&nbsp;&nbsp;All Passport</option>
                        @if(passportOptions()[0])
                        @foreach (passportOptions() as $key => $passort)
                            <option value="{{$key}}" >&nbsp;&nbsp;&nbsp;&nbsp;{{$passort}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="col-md-2" style="margin-top: 25px;">
                    <a class="btn btn-primary btn-md btn-block text-white" onclick="searchOptions()"><i class="fa fa-search"></i>&nbsp;View Report</a>
                </div>
            </div>
        </div>


       
            
        </div>
    </div> <!-- container -->
</div> <!-- content -->

<script>
    function openLink(link,type='_parent'){
      window.open(link,type);
    }

    function searchOptions() {
          window.open("{{ url('account-manager/shift-to-embassy-report') }}/"+$('#from_date').val()+"&"+$('#to_date').val()+"&"+$('#branch_id').val()+"&"+$('#option_id').val(),"_blank");
    }
</script>


@endsection

@push('script')
{{-- <script src="{{ asset('assets/account-manager/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script> --}}
<script src="{{ asset('assets/account-manager/pages/dashborad.js') }}"></script>
@endpush
