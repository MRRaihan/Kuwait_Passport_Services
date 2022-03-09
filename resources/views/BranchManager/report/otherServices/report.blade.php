<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Report</title>
  </head>
  <body>
    <style>
      @media print {
        .print-none {
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
    <div class="float-right ml-2" style="margin-top: 2px;">
      <button onclick="window.print()" class="btn btn-sm btn-outline-info print-none" id="printPageButton"><i class="fa fa-print"></i> Print</button>

      @if (isset($excel_export) && $excel_export == true)
          <a class="btn btn-sm  btn-outline-success print-none"  href="{{ route('branchManager.otherServicesReport.excelExport',$from_date.'&'.$to_date.'&'.$option.'&'.$excel_export) }}"><i class="fas fa-file-excel"></i>Excel</a>
      @endif



    </div>

      @php
         $branch = App\Models\Branch::find($branch_id);

      @endphp
    <center class="normal-text mt-3">
        <p>{{ env('APP_NAME') }}</p>
        <p>{{ $option == -1 ? 'All Services' : otherServiesOptions()[$option] }} Report</p>


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
                    <th scope="col">Service Type</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Taken Services</th>
                    <th scope="col">Total Cost</th>
                    <th scope="col">Date</th>
                    {{-- <th scope="col">View</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @php
                      $total_fee = 0;
                  @endphp
                @if (isset($services[0]))
                    @foreach ($services as $key => $service)
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td>
                            {{ $service->model_name}}
                          </td>
                          <td>{{ $service->name }}</td>
                          <td>{{ $service->kuwait_phone }}</td>
                          <td>
                              @if (isset(json_decode($service->service_taken)[0]))
                                @foreach (json_decode($service->service_taken) as $item)
                                    <span class="badge badge-primary">{{ get_other_service_fee_name_by_id($item) }}</span>
                                @endforeach
                              @endif

                          </td>
                          @if ($service->model_name == 'Other Service')
                             <td class="text-right">{{ $service->fee }}</td>
                              @else
                              <td class="text-right">{{ $service->total_fee }}</td>
                          @endif


                          <td>{{ date('d-m-Y',strtotime($service->created_at)) }}</td>
                      </tr>
                        @if ($service->model_name == 'Other Service')
                            @php
                                $total_fee  += $service->total_fee+$service->fee;
                            @endphp
                        @else
                            @php
                                $total_fee  += $service->total_fee;
                            @endphp
                        @endif
                    @endforeach

                @endif
                <tr>
                  <td colspan="5" class="text-right"></td>
                  <td class="text-right">
                      Total : {{ $total_fee }}
                  </td>
                  <td></td>
                </tr>
                </tbody>
              </table>

              <p>Total : &nbsp;{{ $services->count() }}
                @if ($option == -1)
                ,
                Premier Service : {{ isset($total_primier) ? $total_primier : '' }},
                Express Service : {{ isset($total_express) ? $total_express : '' }},
                Legal & Complaints Service : {{ isset($total_legal) ? $total_legal : '' }},
                Immigration Service : {{ isset($total_immigration) ? $total_immigration : '' }}
                Other : {{ isset($total_other) ? $total_other : '' }}
              @endif
            </p>

           </div>
       </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  </body>
</html>
