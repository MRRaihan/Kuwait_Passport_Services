@extends('NormalUserDeshbord.layouts.app')
@push('title')
List of Passports
@endpush
@section('body')

<div class="col-md-9 p-3">
    <div class="row py-4">
        <div class="col-8">
            <h3 class="px-4">Passport</h3>
        </div>
        <div class="col-4">
            <div class="col-md-6 add_button">
                <a href="{{ route('service',$type) }}" class="btn btn-info text-white btn-md"><i class="fa fa-plus"></i>Add New</a>
            </div>
        </div>
    </div>
    
    <div class="row">
       
      <table class="payment-table">
        <tr id="payment-table-head">
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
                    <td>{{ $passport->model_name }}</td>
                    <td>{{ $passport->passport_number }}</td>
                    <td>{{ date('m-d-Y',strtotime($passport->created_at)) }}</td>
                    <td>$ {{ $passport->passport_type_fees_total }}</td>
                    <td>
                        @if ($passport->status == 0)
                            Pending
                            @elseif ($passport->status == 1)
                            Processing
                            @else
                            Complete
                        @endif
                       
                    </td>
                    <td class="text-danger">Not paid</td>
                    <td><a href="{{ route('service.status',$type.'&'.$passport->id.'&edit') }}"><span class=" bg-warning p-1 text-white rounded"><i class="fa fa-edit"></i>Edit</span> </a></td>
                </tr>
            @endforeach
       @endif
      


      </table>
    </div>
  </div>
@endsection
