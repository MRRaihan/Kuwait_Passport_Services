@extends('CorporateUserDeshbord.layouts.app')
@push('title')
List of Passports
@endpush

@section('body')
<style>
    .paginate-active{
        z-index: 3;
        color: #fff;
        background-color: #30caf0;
    }
</style>

<div class="col-md-9 p-3">

    <div class="row py-4">
        <div class="col-8">
            <h3 class="px-4">Renew Passport</h3>
        </div>
    </div>
    
    <div class="row">
       
      <table class="payment-table">
        <tr id="payment-table-head">
            <th>#Sl</th>
            <th>Service</th>
            <th>ID</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Process</th>
            <th>Status</th>
        </tr>
       @if (isset($renew[0]))
            @foreach ($renew as $key => $renew_passport)
                <tr class="payment-table-item">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $renew_passport->model_name }}</td>
                    <td>{{ $renew_passport->renew_passport_number }}</td>
                    <td>{{ date('m-d-Y',strtotime($renew_passport->created_at)) }}</td>
                    <td>$ {{ $renew_passport->renew_passport_type_fees_total }}</td>
                    <td>
                        @if ($renew_passport->status == 0)
                        <span class="badge bg-warning">Pending</span>
                            @elseif ($renew_passport->status == 1)
                            <span class="badge bg-info">Processing</span>
                            @else
                            <span class="badge bg-success">Complete</span>
                        @endif
                       
                    </td>
                    <td class="text-danger">Not paid</td>
                </tr>
            @endforeach
       @endif
      


      </table>
            <center class="mt-3"> 

                <?php
                // config
                $link_limit = 9; // maximum number of links (a little bit inaccurate, but will be ok for now)
                ?>
                
                @if ($renew ->lastPage() > 1)
                
                    <ul class="pagination" style="margin-left: 20px;">
                        <li class="{{ ($renew ->currentPage() == 1) ? ' disabled' : '' }}" style="padding: 5px 8px; border: 1px solid #bdbdbd;">
                            <a href="{{ $renew ->url(1) }}" style="text-decoration: none;"> << 1st </a>
                        </li>
                        @for ($i = 1; $i <= $renew ->lastPage(); $i++)
                            <?php
                            $half_total_links = floor($link_limit / 2);
                            $from = $renew ->currentPage() - $half_total_links;
                            $to = $renew ->currentPage() + $half_total_links;
                            if ($renew ->currentPage() < $half_total_links) {
                            $to += $half_total_links - $renew ->currentPage();
                            }
                            if ($renew ->lastPage() - $renew ->currentPage() < $half_total_links) {
                                $from -= $half_total_links - ($renew ->lastPage() - $renew ->currentPage()) - 1;
                            }
                            ?>
                            @if ($from < $i && $i < $to)
                                <li class="{{ ($renew ->currentPage() == $i) ? 'paginate-active' : '' }}" style="padding: 5px 12px; border: 1px solid #bdbdbd;">
                                    <a href="{{ $renew ->url($i) }}" style="text-decoration: none;">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor
                        <li class="{{ ($renew ->currentPage() == $renew ->lastPage()) ? ' disabled' : '' }}" style="padding: 5px 8px; border: 1px solid #bdbdbd;">
                            <a href="{{ $renew ->url($renew ->lastPage()) }}" style="text-decoration: none;"> last >> </a>
                        </li>
                    </ul>
                @endif

            </center>
    </div>




    <div class="row py-4">
        <div class="col-8">
            <h3 class="px-4">Manual Passport</h3>
        </div>
    </div>
    
    <div class="row">
       
      <table class="payment-table">
        <tr id="payment-table-head">
            <th>#Sl</th>
            <th>Service</th>
            <th>ID</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Process</th>
            <th>Status</th>
        </tr>
       @if (isset($manual[0]))
            @foreach ($manual as $key => $manual_passport)
                <tr class="payment-table-item">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $manual_passport->model_name }}</td>
                    <td>{{ $manual_passport->passport_number }}</td>
                    <td>{{ date('m-d-Y',strtotime($manual_passport->created_at)) }}</td>
                    <td>$ {{ $manual_passport->passport_type_fees_total }}</td>
                    <td>
                        @if ($manual_passport->status == 0)
                        <span class="badge bg-warning">Pending</span>
                            @elseif ($manual_passport->status == 1)
                            <span class="badge bg-info">Processing</span>
                            @else
                            <span class="badge bg-success">Complete</span>
                        @endif
                       
                    </td>
                    <td class="text-danger">Not paid</td>
                </tr>
            @endforeach
       @endif
      


      </table>
            <center class="mt-3"> 

                <?php
                // config
                $link_limit = 9; // maximum number of links (a little bit inaccurate, but will be ok for now)
                ?>
                
                @if ($manual ->lastPage() > 1)
                
                    <ul class="pagination" style="margin-left: 20px;">
                        <li class="{{ ($manual ->currentPage() == 1) ? ' disabled' : '' }}" style="padding: 5px 8px; border: 1px solid #bdbdbd;">
                            <a href="{{ $manual ->url(1) }}" style="text-decoration: none;"> << 1st </a>
                        </li>
                        @for ($i = 1; $i <= $manual ->lastPage(); $i++)
                            <?php
                            $half_total_links = floor($link_limit / 2);
                            $from = $manual ->currentPage() - $half_total_links;
                            $to = $manual ->currentPage() + $half_total_links;
                            if ($manual ->currentPage() < $half_total_links) {
                            $to += $half_total_links - $manual ->currentPage();
                            }
                            if ($manual ->lastPage() - $manual ->currentPage() < $half_total_links) {
                                $from -= $half_total_links - ($manual ->lastPage() - $manual ->currentPage()) - 1;
                            }
                            ?>
                            @if ($from < $i && $i < $to)
                                <li class="{{ ($manual ->currentPage() == $i) ? 'paginate-active' : '' }}" style="padding: 5px 12px; border: 1px solid #bdbdbd;">
                                    <a href="{{ $manual ->url($i) }}" style="text-decoration: none;">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor
                        <li class="{{ ($manual ->currentPage() == $manual ->lastPage()) ? ' disabled' : '' }}" style="padding: 5px 8px; border: 1px solid #bdbdbd;">
                            <a href="{{ $manual ->url($manual ->lastPage()) }}" style="text-decoration: none;"> last >> </a>
                        </li>
                    </ul>
                @endif

            </center>
    </div>



    <div class="row py-4">
        <div class="col-8">
            <h3 class="px-4">Lost Passport</h3>
        </div>
    </div>
    
    <div class="row">
       
      <table class="payment-table">
        <tr id="payment-table-head">
            <th>#Sl</th>
            <th>Service</th>
            <th>ID</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Process</th>
            <th>Status</th>
        </tr>
       @if (isset($lost[0]))
            @foreach ($lost as $key => $lost_passport)
                <tr class="payment-table-item">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $lost_passport->model_name }}</td>
                    <td>{{ $lost_passport->passport_number }}</td>
                    <td>{{ date('m-d-Y',strtotime($lost_passport->created_at)) }}</td>
                    <td>$ {{ $lost_passport->passport_type_fees_total }}</td>
                    <td>
                        @if ($lost_passport->status == 0)
                        <span class="badge bg-warning">Pending</span>
                            @elseif ($lost_passport->status == 1)
                            <span class="badge bg-info">Processing</span>
                            @else
                            <span class="badge bg-success">Complete</span>
                        @endif
                       
                    </td>
                    <td class="text-danger">Not paid</td>
                </tr>
            @endforeach
       @endif
      


      </table>
            <center class="mt-3"> 

                <?php
                // config
                $link_limit = 9; // maximum number of links (a little bit inaccurate, but will be ok for now)
                ?>
                
                @if ($lost ->lastPage() > 1)
                
                    <ul class="pagination" style="margin-left: 20px;">
                        <li class="{{ ($lost ->currentPage() == 1) ? ' disabled' : '' }}" style="padding: 5px 8px; border: 1px solid #bdbdbd;">
                            <a href="{{ $lost ->url(1) }}" style="text-decoration: none;"> << 1st </a>
                        </li>
                        @for ($i = 1; $i <= $lost ->lastPage(); $i++)
                            <?php
                            $half_total_links = floor($link_limit / 2);
                            $from = $lost ->currentPage() - $half_total_links;
                            $to = $lost ->currentPage() + $half_total_links;
                            if ($lost ->currentPage() < $half_total_links) {
                            $to += $half_total_links - $lost ->currentPage();
                            }
                            if ($lost ->lastPage() - $lost ->currentPage() < $half_total_links) {
                                $from -= $half_total_links - ($lost ->lastPage() - $lost ->currentPage()) - 1;
                            }
                            ?>
                            @if ($from < $i && $i < $to)
                                <li class="{{ ($lost ->currentPage() == $i) ? 'paginate-active' : '' }}" style="padding: 5px 12px; border: 1px solid #bdbdbd;">
                                    <a href="{{ $lost ->url($i) }}" style="text-decoration: none;">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor
                        <li class="{{ ($lost ->currentPage() == $lost ->lastPage()) ? ' disabled' : '' }}" style="padding: 5px 8px; border: 1px solid #bdbdbd;">
                            <a href="{{ $lost ->url($lost ->lastPage()) }}" style="text-decoration: none;"> last >> </a>
                        </li>
                    </ul>
                @endif

            </center>
    </div>


    <div class="row py-4">
        <div class="col-8">
            <h3 class="px-4">New Baby Passport</h3>
        </div>
    </div>
    
    <div class="row">
       
      <table class="payment-table">
        <tr id="payment-table-head">
            <th>#Sl</th>
            <th>Service</th>
            <th>ID</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Process</th>
            <th>Status</th>
        </tr>
       @if (isset($new_baby[0]))
            @foreach ($new_baby as $key => $new_baby_passport)
                <tr class="payment-table-item">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $new_baby_passport->model_name }}</td>
                    <td>{{ $new_baby_passport->passport_number }}</td>
                    <td>{{ date('m-d-Y',strtotime($new_baby_passport->created_at)) }}</td>
                    <td>$ {{ $new_baby_passport->passport_type_fees_total }}</td>
                    <td>
                        @if ($new_baby_passport->status == 0)
                        <span class="badge bg-warning">Pending</span>
                            @elseif ($new_baby_passport->status == 1)
                            <span class="badge bg-info">Processing</span>
                            @else
                            <span class="badge bg-success">Complete</span>
                        @endif
                       
                    </td>
                    <td class="text-danger">Not paid</td>
                </tr>
            @endforeach
       @endif
      


      </table>
            <center class="mt-3"> 

                <?php
                // config
                $link_limit = 9; // maximum number of links (a little bit inaccurate, but will be ok for now)
                ?>
                
                @if ($new_baby ->lastPage() > 1)
                
                    <ul class="pagination" style="margin-left: 20px;">
                        <li class="{{ ($new_baby ->currentPage() == 1) ? ' disabled' : '' }}" style="padding: 5px 8px; border: 1px solid #bdbdbd;">
                            <a href="{{ $new_baby ->url(1) }}" style="text-decoration: none;"> << 1st </a>
                        </li>
                        @for ($i = 1; $i <= $new_baby ->lastPage(); $i++)
                            <?php
                            $half_total_links = floor($link_limit / 2);
                            $from = $new_baby ->currentPage() - $half_total_links;
                            $to = $new_baby ->currentPage() + $half_total_links;
                            if ($new_baby ->currentPage() < $half_total_links) {
                            $to += $half_total_links - $new_baby ->currentPage();
                            }
                            if ($new_baby ->lastPage() - $new_baby ->currentPage() < $half_total_links) {
                                $from -= $half_total_links - ($new_baby ->lastPage() - $new_baby ->currentPage()) - 1;
                            }
                            ?>
                            @if ($from < $i && $i < $to)
                                <li class="{{ ($new_baby ->currentPage() == $i) ? 'paginate-active' : '' }}" style="padding: 5px 12px; border: 1px solid #bdbdbd;">
                                    <a href="{{ $new_baby ->url($i) }}" style="text-decoration: none;">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor
                        <li class="{{ ($new_baby ->currentPage() == $new_baby ->lastPage()) ? ' disabled' : '' }}" style="padding: 5px 8px; border: 1px solid #bdbdbd;">
                            <a href="{{ $new_baby ->url($new_baby ->lastPage()) }}" style="text-decoration: none;"> last >> </a>
                        </li>
                    </ul>
                @endif

            </center>
    </div>


  </div>
@endsection
