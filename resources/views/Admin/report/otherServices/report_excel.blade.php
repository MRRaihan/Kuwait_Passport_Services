<table>
    <tr>
        <th><b>#Sl</b></th>
        <th><b>Service Type</b></th>
        <th><b>Name</b></th>
        <th><b>Phone</b></th>
        <th><b>Taken Services</b></th>
        <th><b>Total Cost</b></th>
        <th><b>Date</b></th>
    </tr>
        @php
            $total_fee = 0;
        @endphp
  @if (isset($services[0]))
      @foreach ($services as $key => $service)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td style="width: 150px;">
              {{ $service->model_name}}
            </td>
            <td style="width: 150px;">{{ $service->name }}</td>
            <td style="width: 150px;">{{ $service->kuwait_phone }}</td>
            <td style="width: 150px;">
                @if (isset(json_decode($service->service_taken)[0]))
                    @foreach (json_decode($service->service_taken) as $item)
                        <span>{{ get_other_service_fee_name_by_id($item).',' }}</span>
                    @endforeach
                @endif
            </td>
            @if ($service->model_name == 'Other Service')
                <td style="width: 150px;">{{ $service->fee }}</td>
                @else
                <td style="width: 150px;">{{ $service->total_fee }}</td>
            @endif
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
    <td colspan="5"></td>
    <td style="width: 150px;">
        Total: {{ $total_fee }}
    </td>
    <td style="width: 150px;"></td>
  </tr>

  </table>
