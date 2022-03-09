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
            <h3 class="px-4">Passport</h3>
        </div>
        <div class="col-4">
            <div class="col-md-6 add_button">
                <a onclick="Show('Add New {{ passportOptionsUsers()[$type] }}','{{ route('corporateUser.service.create',$type) }}')" class="btn btn-info text-white btn-md"><i class="fa fa-plus"></i>Add New</a>
            </div>
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
            <th>Action</th>
        </tr>
       @if (isset($passports[0]))
            @foreach ($passports as $key => $passport)
                <tr class="payment-table-item">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $passport->model_name }}</td>
                    <td>{{ $passport->passport_number }}</td>
                    <td>{{ date('m-d-Y',strtotime($passport->created_at)) }}</td>
                    <td>$ {{ $passport->passport_type_fees_total }}</td>
                    <td>
                        @if ($passport->status == 0)
                        <span class="badge bg-warning">Pending</span>
                            @elseif ($passport->status == 1)
                            <span class="badge bg-info">Processing</span>
                            @else
                            <span class="badge bg-success">Complete</span>
                        @endif
                       
                    </td>
                    <td class="text-danger">Not paid</td>
                    <td>
                        <a href="{{ route('corporateUser.service.edit',$type.'&'.$passport->id.'&edit') }}"><span class=" bg-warning p-1 text-white rounded"><i class="fa fa-edit"></i>&nbsp;Edit</span> </a>

                        <a href="{{ route('corporateUser.service.status',$type.'&'.$passport->id) }}"><span class=" bg-info p-1 text-white rounded"><i class="fa fa-eye"></i>&nbsp;Status</span> </a>
                    </td>
                </tr>
            @endforeach
       @endif
      


      </table>
     <center class="mt-3"> 

        <?php
        // config
        $link_limit = 9; // maximum number of links (a little bit inaccurate, but will be ok for now)
        ?>
        
        @if ($passports ->lastPage() > 1)
        
            <ul class="pagination" style="margin-left: 20px;">
                <li class="{{ ($passports ->currentPage() == 1) ? ' disabled' : '' }}" style="padding: 5px 8px; border: 1px solid #bdbdbd;">
                    <a href="{{ $passports ->url(1) }}" style="text-decoration: none;"> << 1st </a>
                </li>
                @for ($i = 1; $i <= $passports ->lastPage(); $i++)
                    <?php
                    $half_total_links = floor($link_limit / 2);
                    $from = $passports ->currentPage() - $half_total_links;
                    $to = $passports ->currentPage() + $half_total_links;
                    if ($passports ->currentPage() < $half_total_links) {
                    $to += $half_total_links - $passports ->currentPage();
                    }
                    if ($passports ->lastPage() - $passports ->currentPage() < $half_total_links) {
                        $from -= $half_total_links - ($passports ->lastPage() - $passports ->currentPage()) - 1;
                    }
                    ?>
                    @if ($from < $i && $i < $to)
                        <li class="{{ ($passports ->currentPage() == $i) ? 'paginate-active' : '' }}" style="padding: 5px 12px; border: 1px solid #bdbdbd;">
                            <a href="{{ $passports ->url($i) }}" style="text-decoration: none;">{{ $i }}</a>
                        </li>
                    @endif
                @endfor
                <li class="{{ ($passports ->currentPage() == $passports ->lastPage()) ? ' disabled' : '' }}" style="padding: 5px 8px; border: 1px solid #bdbdbd;">
                    <a href="{{ $passports ->url($passports ->lastPage()) }}" style="text-decoration: none;"> last >> </a>
                </li>
            </ul>
        @endif

     </center>
    </div>
  <!-- Button trigger modal -->
  <div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg" id="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modal-title"></h4>
            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="modal-body">

        </div>
        <div class="modal-footer">
            <button type="button" id="modalClose" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div> 

  </div>




  <script>
        function Show(title,link,style = '') {

        // alert();
        $('#modal').modal('show');
        $('#modal-title').html(title);
        $('#modal-body').html('<h1 class="text-center"><strong>Please Wait...</strong></h1>');
        $('#modal-dialog').attr('style',style);
        $.ajax({
            url: link,
            type: 'GET',
            data: {},
        })
        .done(function(response) {
            $('#modal-body').html(response);
        });
        }

     
    </script>
@endsection
