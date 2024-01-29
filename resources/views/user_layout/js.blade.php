<!-- jquery -->
<script src="{{ asset('user_app/assets/js/jquery.js') }}"></script>
<!-- fontawesome link -->
<script src="https://kit.fontawesome.com/b829c5162c.js" crossorigin="anonymous"></script>
<!-- bootstrap link -->
<script src="{{ asset('user_app/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('user_app/assets/js/popper.js') }}"></script>
<!-- custom js -->
<script src="{{ asset('user_app/assets/js/script.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@if (Session::has('error'))
  <script>
      Toastify({
          text:"{{Session::get('error')}}",
          className:"text-white",
          style: {
              background: "#ff0000",
          },
          position:'center'
      }).showToast();
  </script>
@endif
@if (Session::has('success'))
  <script>
      Toastify({
          text:"{{Session::get('success')}}",
          className:"text-white",
          style: {
              background: "#38d100",
          },
          position:'center'
      }).showToast();
  </script>
@endif
<script>
    $(document).ready(function () {
      $('#bht').click(function(){
        $(".mmk").addClass('d-none');
        $('.bht').removeClass('d-none');
        $('#bht').addClass('currency-active');
        $('#mmk').removeClass('currency-active');
      });
  
      $('#mmk').click(function(){
        $(".bht").addClass('d-none');
        $('.mmk').removeClass('d-none');
        $('#mmk').addClass('currency-active');
        $('#bht').removeClass('currency-active');
      });
    });
</script>
</body>

</html>