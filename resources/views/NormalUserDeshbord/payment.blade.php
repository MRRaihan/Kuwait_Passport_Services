@extends('NormalUserDeshbord.layouts.app')
@push('title')
Payemnt
@endpush
@section('body')

<div class="col-md-9 p-3">
    <h3 class="p-4">Payment</h3>
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
        <tr class="payment-table-item">
          <td>Lost Passport</td>
          <td>9878 578 456</td>
          <td>12-08-22</td>
          <td>50$</td>
          <td>Pending</td>
          <td class="text-danger">Not paid</td>
          <td><span class=" bg-dark p-1 text-white rounded">Make Payment</span> </td>
        </tr>
        <tr class="payment-table-item">
          <td>Lost Passport</td>
          <td>9878 578 456</td>
          <td>12-08-22</td>
          <td>50$</td>
          <td>Pending</td>
          <td class="text-danger">Not paid</td>
          <td><span class=" bg-success p-1 text-white rounded">Make Payment</span> </td>
        </tr>


      </table>
    </div>
  </div>
@endsection
