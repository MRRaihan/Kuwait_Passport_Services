<div class="pendingContainer mb-3">
    <section>
      <div class="stepper-wrapper">
        <div class="stepper-item completed">
          <div class="step-counter fontIconColor">
            <i class="fas fa-laptop-code"></i>
          </div>
          <small class="step-name iconTextColor">Step 1</small>
          <div class="iconTextColor">Registration</div>
        </div>
        
        <div class="stepper-item {{ isset($active) && $active == true ? 'completed' : 'active' }} {{ isset($status) && $status == 'completed' ? 'completed' : '' }}">
          <div class="step-counter fontIconColor">
            <i class="fab fa-buffer"></i>
          </div>
          <small class="step-name iconTextColor">Step 2</small>
          <div class="iconTextColor">Pending</div>
        </div>

        <div class="stepper-item {{ isset($active) && $active == true ? 'active' : '' }} {{ isset($status) && $status == 'completed' ? 'completed' : '' }} ">
          <div class="step-counter {{ isset($active) && $active == true ? 'fontIconColor' : '' }} {{ isset($status) && $status == 'completed' ? 'fontIconColor' : '' }}">
            <i class="fas fa-building"></i>
          </div>
          <small class="step-name {{ isset($active) && $active == true ? 'iconTextColor' : '' }} {{ isset($status) && $status == 'completed' ? 'iconTextColor' : '' }}">Step 3</small>
          <div class="{{ isset($active) && $active == true ? 'iconTextColor' : '' }} {{ isset($status) && $status == 'completed' ? 'iconTextColor' : '' }}">Review</div>
        </div>

        <div class="stepper-item {{ isset($status) && $status == 'completed' ? 'completed' : '' }}">
          <div class="step-counter {{ isset($status) && $status == 'completed' ? 'fontIconColor' : '' }}">
            <i class="fas fa-file-invoice-dollar"></i>
          </div>
          <small class="step-name {{ isset($status) && $status == 'completed' ? 'iconTextColor' : '' }}">Step 4</small>
          <div class="{{ isset($status) && $status == 'completed' ? 'iconTextColor' : '' }}">Payment</div>
        </div>

        <div class="stepper-item {{ isset($status) && $status == 'completed' ? 'completed' : '' }}">
          <div class="step-counter {{ isset($status) && $status == 'completed' ? 'fontIconColor' : '' }}">
            <i class="fas fa-file-invoice-dollar"></i>
          </div>
          <small class="step-name {{ isset($status) && $status == 'completed' ? 'iconTextColor' : '' }}">Step 5</small>
          <div class="{{ isset($status) && $status == 'completed' ? 'iconTextColor' : '' }}">Delivered</div>
        </div>
        
      </div>
    </section>
    <section>
      <div class="accordion" id="accordionExample{{ $model_name }}">
          <div class="accordion-item">
           <div class="col-md-12">
               <div class="row">
                  <div class="col-md-6">
                      <h1>{{ $model_name }} Passport</h1>
                  </div>
                  <div class="col-md-6">
                     <h2 class="accordion-header bg-success" id="heading{{ $model_name }}">
                         <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $model_name }}" aria-expanded="true" aria-controls="collapse{{ $model_name }}">
                           Details
                           <br>
                           {{ $passports->count() }} Applications
                         </button>
                       </h2>
                  </div>
               </div>
           </div>
            <div id="collapse{{ $model_name }}" class="accordion-collapse collapse " aria-labelledby="heading{{ $model_name }}" data-bs-parent="#accordionExample{{ $model_name }}">
              <div class="accordion-body">
                                      
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
                              </tr>
                          @endforeach
                  @endif

                  </table>
              </div>
            </div>
          </div>
        </div>
    </section>
  </div>