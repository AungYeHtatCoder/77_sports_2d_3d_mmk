@include('user_layout.header')
@yield('style')

<body>
 <div class="main-body" style="min-height: 100vh;">
  <!-- navbar section start -->

  <!-- navbar section end -->
  @yield('content')

  <!-- footer section start  -->

  <!-- footer section end -->
 </div>


 @include('user_layout.js')
 @yield('script')