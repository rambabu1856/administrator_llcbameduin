<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'LINGARAJ LAW COLLEGE') }}</title>
  <link rel="shortcut icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">
  <link rel='stylesheet' type='text/css'
    href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900'>
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/fontawesome-6/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_assets/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('style_newX.css') }}">
</head>

<body class="hold-transition responsive text-sm" style="background-image:url({{ url('images/paisley.webp') }});">
  {{-- height: 100%;   background-position: center; background-repeat: no-repeat; background-size: cover; background-image:url({{ url('images/bg1.jpeg') }}); --}}

  <!-- <div id="overlay" class="text-warning">
        <img src="{{ asset('web_images/loading.gif') }}" class="img-fluid rounded-circle" alt="Responsive image" width="50px">
    </div> -->
  <div class="col-md-4 col-lg-4 offset-md-4">
    <div class="login-logo">
      <img src="{{ asset('storage/media/web_images/logo.jpg') }}" class="img-fluid img-circle no-border"
        alt="Responsive image" width="120px">
      <br>
      {{-- <a href="javascript:;" class="h5 m-0 p-0"><b>LLC-BAM</b></a> --}}
    </div>

    <div class="card card-pink card-outline">
      <div class="card-header bg-cyan">
        <div class="card-title mt-1 text-center"><b>ADMINISTRATOR</b></div>
        <a href="{{ url('/') }}" type="button" class="btn btn-sm btn-outline-light text-danger float-right"><i
            class="fa-solid fa-house"></i>
        </a>
      </div>
      {{-- @if (Session::get('error'))
        <div class="alert alert-danger text-center">{{ Session::get('error') }}</div>
      @endif --}}
      <form method="POST" action="{{ route('admin.check') }}" autocomplete="off">
        <div class="card-body">
          @csrf
          <div class="form-group">
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
              name="email" value="{{ old('email') }}" required autocomplete="email">
            <span class="text-fuchsia">
              @error('email')
                {{ $message }}
              @enderror
            </span>
          </div>
          <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
              name="password" required autocomplete="current-password">
            <span class="text-fuchsia">
              @error('password')
                {{ $message }}
              @enderror
            </span>
          </div>

          {{-- <div class="form-group">

            <div class="container">
              <img src="images/captcha-bg.png" alt="Captcha" style="width:60%; height:40px">
              <div class="centered captcha_image">{!! captcha_img('flat') !!}
                <span><button class="btn btn-dark ml-1" type="button" id="btn_refresh_captcha" name="btn_refresh_captcha"><i
                      class="fa-solid fa-rotate-right"></i></button></span>
              </div>
            </div>
          </div> --}}

          <div class="form-row mb-3">
            <div class="col-9">
              <div class="captcha btn-block" style="min-width:50%"><span class="flex">{!! captcha_img('flat') !!}</span>
              </div>
            </div>
            <div class="col-3">
              <button class="btn btn-dark ml-1" type="button" id="btn_refresh_captcha" name="btn_refresh_captcha"><i
                  class="fa-solid fa-rotate-right"></i></button>
            </div>
          </div>

          <div class="form-group">
            <label>Enter the code shown above</label>
            <input class="form-control" type="text" id="captcha" name="captcha">
            <span class="text-fuchsia">
              @error('captcha')
                {{ $message }}
              @enderror
            </span>
          </div>
        </div>

        <div class="card-footer bg-cyan">
          <button type="submit" class="btn elevation-5 bg-pink float-right"><i
              class="fa-solid fa-arrow-right-to-bracket mr-2"></i>
            {{ __('Login') }}
          </button>
        </div>
      </form>
    </div>
  </div>

  <script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin_assets/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('admin_assets/dist/js/adminlte.min.js') }}"></script>

  <script>
    $('#btn_refresh_captcha').click(function(e) {
      e.preventDefault();
      $.ajax({
        type: "GET",
        url: "reload-captcha",
        success: function(response) {
          $('.captcha span').html(response.captcha);
        }
      });
    });

    document.addEventListener('contextmenu', event => {
      event.preventDefault();
    });

    document.onkeypress = function(event) {
      event = (event || window.event);
      if (event.keyCode == 123) {
        return false;
      }
    }
    document.onmousedown = function(event) {
      event = (event || window.event);
      if (event.keyCode == 123) {
        return false;
      }
    }
    document.onkeydown = function(event) {
      event = (event || window.event);
      if (event.keyCode == 123) {
        return false;
      }
    }
  </script>

  @if (Session::has('success'))
    <script>
      toastr.success("{{ Session::get('success') }}");
    </script>
  @elseif(Session::has('error'))
    <script>
      toastr.error("{{ Session::get('error') }}");
    </script>
  @elseif(Session::has('info'))
    <script>
      toastr.info("{{ Session::get('info') }}");
    </script>
  @endif

</body>

</html>
