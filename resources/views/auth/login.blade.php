<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
     <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('user_app/assets/css/style.css') }}">
    <!-- material icon -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/material-icons@1.13.11/iconfont/material-icons.min.css"
    />
    <!-- fontawesoome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Diamond 2D | 3D</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mx-auto" style="position: relative;">
          <div class="card login-card">
            <h5 class="mx-auto">Diamond 2D | 3D</h5>
            <!-- <h5 class="mx-auto">Login</h5> -->
            <form action="{{route('login')}}" method="post">
              @csrf
             <div class="form-group mt-3">
              <label for="" class="form-label">Email</label>
              <input type="email" name="email" name="email" placeholder="youremail@gmail.com" class="form-control">
            </div>
            <div class="form-group mt-2">
              <label for="" class="form-label">Password</label>
              <input type="password" name="password" placeholder="password" class="form-control">
            </div>
            <p>Don't you have account? <a href="{{ route('register')}}" style="text-decoration: none;color: #1aacac;">Register</a> Here!</p>
            <div class="mx-auto">              
              {{-- <a href="index.html" class="btn login-btn">Login</a> --}}
              <button type="submit" class="btn login-btn">Login</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  </body>
</html>