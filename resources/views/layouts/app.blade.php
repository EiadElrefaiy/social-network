<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

      <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}" />
      <link rel="stylesheet" href="{{ URL::asset('assets/css/libs.min.css') }}">
      <link rel="stylesheet" href="{{URL::asset('assets/css/socialv.css?v=4.0.0')}}">
      <link rel="stylesheet" href="{{URL::asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}">
      <link rel="stylesheet" href="{{URL::asset('assets/vendor/remixicon/fonts/remixicon.css')}}">
      <link rel="stylesheet" href="{{URL::asset('assets/vendor/vanillajs-datepicker/dist/css/datepicker.min.css')}}">
      <link rel="stylesheet" href="{{URL::asset('assets/vendor/font-awesome-line-awesome/css/all.min.css')}}">
      <link rel="stylesheet" href="{{URL::asset('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css')}}">

</head>
<body class=" color-light ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
      
    @auth
    <x-topbar />
    @endauth
    

    <div id="content-page" class="content-page">
      <div class="container-fluid">
         <div class="row">
            @yield('content')
          </div>
         </div>
      </div>
      </div>
    </div>

    @auth
    <x-footer />
    @endauth




    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
      <script>
          // Initialize Pusher with your credentials
          const pusher = new Pusher('e908c5fe2a067ce056f6', {
              cluster: 'eu'
          });

          // Subscribe to the 'friend-requests' channel
          const channel = pusher.subscribe('friend-requests');

          // Bind to the 'FriendRequestReceived' event
          channel.bind('FriendRequestReceived', function(data) {
              // Create a new notification element
              const notificationElement = `
                  <a href="#" class="iq-sub-card">
                      <div class="d-flex align-items-center">
                          <div class="">
                              <img class="avatar-40 rounded" src="${data.avatar}" alt="">
                          </div>
                          <div class="ms-3 w-100">
                              <h6 class="mb-0">${data.name} sent you a friend request</h6>
                              <div class="d-flex justify-content-between align-items-center">
                                  <p class="mb-0">${data.date}</p>
                                  <small class="float-right font-size-12">Just Now</small>
                              </div>
                          </div>
                      </div>
                  </a>
              `;

              document.getElementById('notification-list').innerHTML += notificationElement;
          });
      </script>

    <!-- Wrapper End-->
    <!-- Backend Bundle JavaScript -->

     <!-- Backend Bundle JavaScript -->
     <script src="{{URL::asset('assets/js/libs.min.js')}}"></script>
    <!-- slider JavaScript -->
    <script src="{{URL::asset('assets/js/slider.js')}}"></script>
    <!-- masonry JavaScript --> 
    <script src="{{URL::asset('assets/js/masonry.pkgd.min.js')}}"></script>
    <!-- SweetAlert JavaScript -->
    <script src="{{URL::asset('assets/js/enchanter.js')}}"></script>
    <!-- SweetAlert JavaScript -->
    <script src="{{URL::asset('assets/js/sweetalert.js')}}"></script>
    <!-- app JavaScript -->
    <script src="{{URL::asset('assets/js/charts/weather-chart.js')}}"></script>
    <script src="{{URL::asset('assets/js/app.js')}}"></script>
    <script src="{{URL::asset('vendor/vanillajs-datepicker/dist/js/datepicker.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/lottie.js')}}"></script>
</body>
</html>
