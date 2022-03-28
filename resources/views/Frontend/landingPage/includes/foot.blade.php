  <!------------------------------- javascript files ------------------------------------------>
  <script type="text/javascript" src="{{ asset('frontend_assets/js/bootstrap.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('frontend_assets/js/popper.min.js') }}"></script>

  <!-- latest jquery file -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

  <script type="text/javascript">
      (function($) {
          "use strict";
          $(".owl-carousel").owlCarousel({
              loop: true,
              margin: 20,
              nav: false,
              dots: true,
              responsive: {
                  0: {
                      items: 1,
                  },
                  600: {
                      items: 3,
                  },
                  1000: {
                      items: 3,
                  },
              },
          });
      })(jQuery);
  </script>
  <script type="text/javascript" src="{{ asset('frontend_assets/js/main.js') }}"></script>

  <script>
      $('#checkPassportStatus').click(function(e) {
            e.preventDefault();
            var civil_id = $('#civil_id').val();
            var kuwait_phone = $('#kuwait_phone').val();
            var passport_type = $('#passport_type').val();
            // alert();

            var link = '{{ url('check-passport-status') }}';
            console.log(civil_id, kuwait_phone);
            $('#modal').modal('show');
            $('#modal-title').html('Passport Status');
            $('#modal-body').html('<h1 class="text-center"><strong>Please Wait...</strong></h1>');
            // $('#modal-dialog').attr('style', style);
            $.ajax({
                url: link + '/' + civil_id + '&' + kuwait_phone + '&' + passport_type,
                type: 'GET',
                data: {},
            })
            .done(function(response) {
                $('#modal-body').html(response);
            });
      });
  </script>
