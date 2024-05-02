    <!-- Modernizer JS -->
    <script src="{{ asset("js/vendor/modernizr.min.js")}}"></script>
    <!-- jQuery JS -->
    <script src="{{ asset("js/vendor/jquery.js")}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset("js/vendor/bootstrap.min.js")}}"></script>
    <!-- sal.js -->
    <script src="{{ asset("js/vendor/sal.js")}}"></script>
    <script src="{{ asset("js/vendor/swiper.js")}}"></script>
    <script src="{{ asset("js/vendor/magnify.min.js")}}"></script>
    <script src="{{ asset("js/vendor/jquery-appear.js")}}"></script>
    <script src="{{ asset("js/vendor/odometer.js")}}"></script>
    <script src="{{ asset("js/vendor/backtotop.js")}}"></script>
    <script src="{{ asset("js/vendor/isotop.js")}}"></script>
    <script src="{{ asset("js/vendor/imageloaded.js")}}"></script>

    <script src="{{ asset("js/vendor/wow.js")}}"></script>
    <script src="{{ asset("js/vendor/waypoint.min.js")}}"></script>
    <script src="{{ asset("js/vendor/easypie.js")}}"></script>
    <script src="{{ asset("js/vendor/text-type.js")}}"></script>
    <script src="{{ asset("js/vendor/jquery-one-page-nav.js")}}"></script>
    <script src="{{ asset("js/vendor/bootstrap-select.min.js")}}"></script>
    <script src="{{ asset("js/vendor/jquery-ui.js")}}"></script>
    <script src="{{ asset("js/vendor/magnify-popup.min.js")}}"></script>
    <script src="{{ asset("js/vendor/paralax-scroll.js")}}"></script>
    <script src="{{ asset("js/vendor/paralax.min.js")}}"></script>
    <script src="{{ asset("js/vendor/countdown.js")}}"></script>
    <script src="{{ asset("js/vendor/plyr.js")}}"></script>
    <!-- Main JS -->
    <script src="{{ asset("js/main.js")}}"></script>

    <script>
        function handleCheckboxChange() {
          const checkedCheckbox = document.querySelector('input[name="payment_method"]:checked');
          if (checkedCheckbox) {
            const otherCheckboxes = document.querySelectorAll('input[name="payment_method"]');
            otherCheckboxes.forEach(checkbox => {
              if (checkbox !== checkedCheckbox) {
                checkbox.disabled = true;
              }
            });
          } else {
            document.querySelectorAll('input[name="payment_method"]').forEach(checkbox => checkbox.disabled = false);
          }
        }
      </script>
    