@extends('Others.report')

@section('report_body')
    <div class="float-right ml-2 mr-3 mt-3" style="margin-top: 2px;">
      <button onclick="window.print()" class="btn btn-sm btn-outline-info print-none" id="printPageButton"><i class="fa fa-print"></i> Print</button>


           @if (isset($delivery_to_user) && $delivery_to_user == true)
             <a class="btn btn-sm  btn-outline-success print-none"  href="{{ route('embassy.deliveryToAdminReport.excelExport',$from_date.'&'.$to_date.'&'.$branch_id.'&'.$option.'&'.$delivery_to_user) }}"><i class="fas fa-file-excel"></i> Excel</a>
           @endif




    </div>

      @php
         $branch = App\Models\Branch::find($branch_id);

      @endphp

    <div class="row">
      <div class="col-md-12">
        <center class="normal-text mt-3">
          <p>{{ env('APP_NAME') }}</p>
            <p>Deliveryn To Admin Reports</p>
            <p>{{ $option == -1 ? 'All Passport' : passportOptions()[$option] }} Report</p>



          @if (isset($branch->id))
              <p><b>Branch : {{ $branch->name }}</b></p>
          @endif

          @if ($from_date != '' || $to_date != '')
              <p>From : <b>{{ $from_date }}</b> - To : <b>{{ $to_date }}</b></p>
          @endif
      </center>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
           <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#Sl</th>
                    <th scope="col">Passport Type</th>
                    <th scope="col">Name</th>
                    @if (isset($option) && $option == 1)
                       <th>Category Of Passport Holder </th>
                    @endif
                    <th scope="col">Emirates ID</th>
                    <th scope="col">Passport NO.</th>
                    <th scope="col">Kuwait Phone</th>
                    <th scope="col">BARCODE.</th>
                    <th scope="col">EMS</th>
                    <th scope="col">Versatilo Fee</th>
                    <th scope="col">Embassy Fee</th>
                    <th scope="col">Total Fee</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                      $total_versatilo_fee = 0;
                      $total_embassy_fee = 0;
                      $total_fee = 0;
                  @endphp
                @if (isset($passports[0]))
                    @foreach ($passports as $key => $passport)
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td>
                            {{ $passport->model_name}}
                          </td>
                          <td>{{ $passport->name }}</td>
                          @if (isset($option) && $option == 1)
                            <td>{{ $passport->passport_type_title ?  $passport->passport_type_title.' ( govt. fee: '.$passport->passport_type_versatilo_fee.' | ver. fee: '.$passport->passport_type_government_fee.')' : '' }}</td>
                          @endif
                          <td>{{ $passport->emirates_id }}</td>
                          <td>{{ $passport->passport_number }}</td>
                          <td>{{ $passport->uae_phone }}</td>
                          <td>{{ $passport->ems }}</td>
                          <td>{{ $passport->ems }}</td>
                          <td class="text-right">{{ $passport->passport_type_versatilo_fee }}</td>
                          <td class="text-right">{{ $passport->passport_type_government_fee }}</td>
                          <td class="text-right">{{ $passport->passport_type_fees_total }}</td>

                      </tr>
                      @php

                            $total_versatilo_fee += $passport->passport_type_versatilo_fee;
                            $total_embassy_fee += $passport->passport_type_government_fee;
                            $total_fee  += $passport->passport_type_fees_total;
                        @endphp
                    @endforeach

                @endif
                <tr>
                  <td colspan="{{ $option == 1 ? '9' : '8' }}" class="text-right"> </td>
                  <td class="text-right">
                       Total : {{ $total_versatilo_fee }}
                  </td>
                  <td class="text-right">
                    Total : {{ $total_embassy_fee }}
                  </td>

                  <td class="text-right">
                    Total : {{ $total_fee }}
                  </td>
                </tr>
                </tbody>
              </table>

              <p>Total : &nbsp;{{ $passports->count() }}
                @if ($option == -1)
                ,
                Renew passport : {{ isset($total_renew) ? $total_renew : '' }},
                Manual passport : {{ isset($total_manual) ? $total_manual : '' }},
                Lost passport : {{ isset($total_lost) ? $total_lost : '' }},
                New Born Baby passport : {{ isset($total_new_born_baby) ? $total_new_born_baby : '' }}
              @endif
            </p>

           </div>
       </div>

    @endsection
