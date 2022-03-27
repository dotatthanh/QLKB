<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">

    @yield('css')
    @stack('css')

    <!-- Toastr Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('libs\toastr\build\toastr.min.css') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap4.0.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">
    
    <link href="{{ asset('scss/reset.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('scss/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('slick/slick.css') }}" rel="stylesheet" type="text/css">

    <style type="text/css">
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
      }

      /* Firefox */
      input[type=number] {
          -moz-appearance: textfield;
      }
  </style>
</head>
<body>
    <div class="container">
        <div class="row bg-header">
            <div class="col-3">
                <span class="font-weight-bold">Cấp cứu:</span> <a href="tel:0901 793 122" class="text-danger">0901 793 122</a>
            </div>
            <div class="col-3">
                <span class="font-weight-bold">Tổng đài:</span> <a href="tel:0901 793 122" class="text-danger">0901 793 122</a>
            </div>
            <div class="col-3">
                <span class="font-weight-bold">Trực sản (24/24):</span> <a href="tel:0901 793 122" class="text-danger">0901 793 122</a>
            </div>
            <div class="col-3 text-right">
                @if (auth()->guard('web')->user())
                
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ auth()->guard('web')->user()->name }}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('web.profile') }}">Thông tin cá nhân</a>
                        <a class="dropdown-item" href="{{ route('web.change-password') }}">Đổi mật khẩu</a>
                        <a class="dropdown-item" href="{{ route('web.info-booking') }}">Thông tin đặt lịch</a>
                        <a class="dropdown-item" href="{{ route('web.medical-record') }}">Hồ sơ bệnh án</a>
                        <a class="dropdown-item" href="{{ route('web.prescription') }}">Danh sách đơn thuốc</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('web.logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">Đăng xuất</button>
                        </form>
                    </div>
                </div>
                @else
                <a href="{{ route('web.login') }}" class="btn btn-success">Đăng nhập</a>
                <a href="{{ route('web.register') }}" class="btn btn-primary">Đăng ký</a>
                @endif
            </div>
        </div>

        <div class="row align-items-center" style="display: flex;">
            <div class="col-3 logo">Trung tâm y tế Tận Tâm</div>
            <div class="col-9 slogan">
                CHĂM SÓC SỨC KHOẺ TRỌN ĐỜI CHO BẠN
            </div>
        </div>

        <div class="row">
            <ul class="menu">
                <li>
                    <a href="{{ route('home') }}">Trang chủ</a>
                </li>
                {{-- <li>
                    <a href="">Trang chủ</a>
                    <ul>
                        <li>
                            <a href="">> Trang chủ</a>
                        </li>
                        <li>
                            <a href="">> Trang chủ</a>
                        </li>
                        <li>
                            <a href="">> Trang chủ</a>
                        </li>
                        <li>
                            <a href="">> Trang chủ</a>
                        </li>
                    </ul>
                </li> --}}
                <li class="item-booking">
                    <a href="{{ route('web.booking-examination') }}">Đặt lịch khám</a>
                </li>
            </ul>
        </div>

        @yield('content')

    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h4 class="h4 font-weight-bold title-footer">Trung tâm y tế Tận Tâm</h4>
                    <p>Chi nhánh công ty CP Y Khoa & Thẩm Mỹ Thu Cúc</p>
                    <p>ĐKKD số: 0102624215-001 – Sở Kế hoạch và Đầu tư thành phố Hà Nội cấp ngày 11/02/2009</p>
                    <p>Giấy phép hoạt động cơ sở khám chữa bệnh số 26/BYT-GPHD do Bộ y tế cấp ngày 21/02/2017</p>
                    <p>Email: contact@thucuchospital.vn</p>
                    <p>Tổng đài tư vấn: <a href="tel:1900 5588 92">1900 5588 92</a></p>
                    <p>Email: cskh@thucuchospital.vn</p>
                </div>

                <div class="col-6">
                    <p>Địa chỉ: 286 Thụy Khuê, Tây Hồ, Hà Nội</p>
                    <p>Cấp cứu (24/24): <a href="tel:0901 793 122">0901 793 122</a></p>
                    <p>Trực sản (24/24): <a href="tel:0936 245 499">0936 245 499</a></p>
                    <p>Liên hệ: <a href="tel:1900 5588 92">1900 5588 92</a> hoặc <a href="tel:0936 388 288">0936 388 288</a> đặt lịch khám</p>
                    <p>Hotline giao thuốc tận nhà: <a href="tel:0936347266">0936347266</a></p>
                </div>
            </div>
        </div>

        <div class="coppyright">
            COPYRIGHT ©2020 Trung tâm y tế tận tâm
        </div>

    </footer>

    <!-- Messenger -->
    <a href="https://www.facebook.com/messages/t/100008685889069" title="" class="btn-call" target="_blank">
        <span><i class="fa fa-comment"></i></span>
    </a>

    <script src="{{ asset('js/jquery-2.2.1.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('slick/slick.js') }}"></script>
    <!-- toastr plugin -->
    <script src="{{ asset('libs\toastr\build\toastr.min.js') }}"></script>

    <script type="text/javascript">
        // toastr noti
        @if(Session::has('alert-success'))
        Command: toastr["success"]("{{ Session::get('alert-success') }}")

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 300,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        @endif

        @if(Session::has('alert-error'))
        Command: toastr["error"]("{{ Session::get('alert-error') }}")

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 300,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        @endif
    </script>

    @yield('js')
    @stack('js')
</body>
</html>