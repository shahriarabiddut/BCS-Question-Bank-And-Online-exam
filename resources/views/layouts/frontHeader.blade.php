<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

</head>

<body>
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="{{ route('root') }}" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>@isset($SiteOption)
          {{ $SiteOption[0]->value }}
      @endisset
      <span>.</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{ route('root') }}">Home</a></li>
          <li class="dropdown"><a href="#"><span>Panels</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
            @if (Route::has('login'))
            @auth
            <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
            @else
            <li><a href="{{ route('login') }}">Login</a></li>
              @if (Route::has('register'))
              <li><a href="{{ route('register') }}">Register</a></li>
              @endif
            @endauth
            @endif
            @auth('admin')
            <li> <a href="{{ route('admin.dashboard') }}"> Admin Dashboard</a>
            @else
            <li><a href="{{ route('admin.login') }}"> Admin Log in</a>
            @endauth
            @auth('staff')
            <li><a href="{{ route('staff.dashboard') }}"> Staff Dashboard</a>
            @else
            <li><a href="{{ route('staff.login') }}"> Staff Log in</a></li>
            @endauth
            </ul>
          </li>
          <li><a href="{{ route('marks') }}">Top List</a></li>
        </ul>
      </nav><!-- .navbar -->

            @auth
            <a class="btn-book-a-table" href="{{ route('logout') }}">Logout</a>
            @else
            <a class="btn-book-a-table" href="{{ route('login') }}">Login</a>
            @endauth
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header>