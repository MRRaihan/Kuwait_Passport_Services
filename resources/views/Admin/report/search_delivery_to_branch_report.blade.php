<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Report</title>
  </head>
  <body>
    <style>
      @media print {
        #printPageButton {
          display: none;
        }
      }
      .normal-text{
        line-height:15px;
      }
      .normal-text p{
        font-size: 20px;
      }
    </style>
    <div class="pull-right ml-2" style="margin-top: 2px;">
      <button onclick="window.print()" class="btn btn-primary" id="printPageButton"> Print</button>
    </div>

      @php
         $branch = App\Models\Branch::find($branch_id);

      @endphp
    <center class="normal-text">
        <p>{{ env('APP_NAME') }}</p>
        @if (isset($shift_to_embassy) && $shift_to_embassy == true)
          <p>Shift To Embassy Reports</p>
          @elseif (isset($receive_to_embassy) && $receive_to_embassy == true)
          <p>Receive From Embassy Reports</p>
          @elseif (isset($delivery) && $delivery == true)
          <p>Delivery Reports</p>
          @else
          <p>{{ $option == -1 ? 'All Passport' : passportOptions()[$option] }} Report</p>
        @endif


        @if (isset($branch->id))
            <p><b>Branch : {{ $branch->name }}</b></p>
        @endif

        @if ($from_date != '' || $to_date != '')
            <p>From : <b>{{ $from_date }}</b> - To : <b>{{ $to_date }}</b></p>
        @endif


    </center>

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
                    <th scope="col">View</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                      $total_versatilo_fee = 0;
                      $total_embassy_fee = 0;
                      $total_fee = 0;
                      $total_other_fee = 0;
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
                          <td class="text-right">
                            @if ($passport->model_name == 'Other Passport')
                              {{ $passport->fee }}
                              @else
                              {{ $passport->passport_type_fees_total }}
                            @endif
                          </td>
                          @if ($passport->model_name == 'Renew Passport')
                          <td><a href="{{ route('admin.renewPassport.show', $passport->id) }}" target="_blank">view</a></td>
                          @endif
                          @if ($passport->model_name == 'Manual Passport')
                            <td><a href="{{ route('admin.manualPassport.show', $passport->id) }}" target="_blank">view</a></td>
                          @endif
                          @if ($passport->model_name == 'Lost Passport')
                            <td><a href="{{ route('admin.lostPassport.show', $passport->id) }}" target="_blank">view</a></td>
                          @endif
                          @if ($passport->model_name == 'Other Passport')
                            <td><a href="{{ route('admin.lostPassport.show', $passport->id) }}" target="_blank">view</a></td>
                          @endif
                          @if ($passport->model_name == 'New Born Baby Passport')
                            <td><a href="{{ route('admin.newBornBabyPassport.show', $passport->id) }}" target="_blank">view</a></td>
                          @endif

                      </tr>
                      @php
                          if ($passport->model_name == 'Other Passport') {
                              $total_other_fee  += $passport->fee;
                          }else {
                            $total_versatilo_fee += $passport->passport_type_versatilo_fee;
                            $total_embassy_fee += $passport->passport_type_government_fee;
                            $total_fee  += $passport->passport_type_fees_total;
                          }
                        @endphp
                    @endforeach

                @endif
                <tr>
                  <td colspan="{{ $option == 1 ? '9' : '8' }}" class="text-right">Total = </td>
                  <td class="text-right">
                       {{ $total_versatilo_fee }}
                  </td>
                  <td class="text-right">
                      {{ $total_embassy_fee }}
                  </td>

                  <td class="text-right">
                    {{ $total_fee+$total_other_fee }}
                  </td>
                  <td></td>
                </tr>
                </tbody>
              </table>

              <p>Total : &nbsp;{{ $passports->count() }}
                @if ($option == -1)
                ,
                Renew passport : {{ isset($total_renew) ? $total_renew : '' }},
                Manual passport : {{ isset($total_manual) ? $total_manual : '' }},
                Lost passport : {{ isset($total_lost) ? $total_lost : '' }},
                Other passport : {{ isset($total_other) ? $total_other : '' }}
                New Born Baby passport : {{ isset($total_new_born_baby) ? $total_new_born_baby : '' }}
              @endif
            </p>

           </div>
       </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  </body>
</html>
