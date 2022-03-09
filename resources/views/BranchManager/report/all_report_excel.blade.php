<table>
    <tr>
        <th><b>#Sl</b></th>
        <th><b>Passport Type</b></th>
        <th><b>Name</b></th>
        @if (isset($option) && $option == 1)
           <th><b>Category Of Passport Holder </b></th>
        @endif
        <th><b>Emirates ID</b></th>
        <th><b>Passport NO.</b></th>
        <th><b>Kuwait Phone</b></th>
        <th><b>BARCODE.</b></th>
        <th><b>EMS</b></th>
        <th><b>Versatilo Fee</b></th>
        <th><b>Embassy Fee</b></th>
        <th><b>Total Fee</b></th>
    </tr>
        @php
        $total_versatilo_fee = 0;
        $total_embassy_fee = 0;
        $total_fee = 0;
    @endphp
  @if (isset($passports[0]))
      @foreach ($passports as $key => $passport)
          <tr>
            <th>{{ $loop->iteration }}</th>
            <td style="width: 150px;">
              {{ $passport->model_name}}
            </td>
            <td style="width: 150px;">{{ $passport->name }}</td>
            @if (isset($option) && $option == 1)
              <td style="width: 150px;">{{ $passport->passport_type_title ?  $passport->passport_type_title.' ( govt. fee: '.$passport->passport_type_versatilo_fee.' | ver. fee: '.$passport->passport_type_government_fee.')' : '' }}</td>
            @endif
            <td style="width: 150px;">{{ $passport->emirates_id }}</td>
            <td style="width: 150px;">{{ $passport->passport_number }}</td>
            <td style="width: 150px;">{{ $passport->uae_phone }}</td>
            <td style="width: 150px;">{{ $passport->ems }}</td>
            <td style="width: 150px;">{{ $passport->ems }}</td>
            <td style="width: 150px;">{{ $passport->passport_type_versatilo_fee }}</td>
            <td style="width: 150px;">{{ $passport->passport_type_government_fee }}</td>
            <td style="width: 150px;">{{ $passport->passport_type_fees_total }}</td>

        </tr>
          @php
              $total_versatilo_fee += $passport->passport_type_versatilo_fee;
              $total_embassy_fee += $passport->passport_type_government_fee;
              $total_fee  += $passport->passport_type_fees_total;
          @endphp
      @endforeach

  @endif
  <tr>
    <td colspan="{{ $option == 1 ? '9' : '8' }}"></td>
    <td style="width: 150px;">
        Total: {{ $total_versatilo_fee }}
    </td>
    <td style="width: 150px;">
        Total: {{ $total_embassy_fee }}
    </td>

    <td style="width: 150px;">
        Total: {{ $total_fee }}
    </td>
    <td style="width: 150px;"></td>
  </tr>

  </table>
