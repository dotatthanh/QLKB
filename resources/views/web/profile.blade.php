@extends('layouts.master')

@section('title') Đăng ký @endsection

@section('content')
    <h2 class="title">THÔNG TIN CÁ NHÂN</h2>
    <form action="" method="POST">
        <div class="row">

            <div class="table-responsive">
                <table class="table table-nowrap mb-0">
                    <tbody>
                        <tr>
                            <th scope="row">Họ và tên :</th>
                            <td>{{ auth()->guard('web')->user()->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Giới tính :</th>
                            <td>{{ auth()->guard('web')->user()->gender }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Ngày sinh :</th>
                            <td>{{ date("d-m-Y", strtotime(auth()->guard('web')->user()->birthday)) }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Số điện thoại :</th>
                            <td>{{ auth()->guard('web')->user()->phone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">E-mail :</th>
                            <td>{{ auth()->guard('web')->user()->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Địa chỉ :</th>
                            <td>{{ auth()->guard('web')->user()->address }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Ảnh đại diện :</th>
                            <td>
                                <img src="{{ asset(auth()->guard('web')->user()->avatar) }}" alt="" class="avatar">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col text-center">
                <a class="btn btn-success" href="{{ route('web.change-profile') }}">Cập nhật thông tin cá nhân</a>
            </div>  
        </div>
    </form>
@endsection

@push('js')
    <!-- datepicker -->
    <script src="{{ asset('libs\bootstrap-datepicker\js\bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-colorpicker\js\bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-timepicker\js\bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-touchspin\jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('libs\bootstrap-maxlength\bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.js') }}"></script>
    <!-- form advanced init -->
    <script src="{{ asset('js\pages\form-advanced.init.js') }}"></script>

    <script type="text/javascript">
        $('.docs-date').datepicker({
            format: 'dd-mm-yyyy',
            endDate: new Date(),
        });

        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });

            $("#show_hide_password_confirmation a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password_confirmation input').attr("type") == "text"){
                    $('#show_hide_password_confirmation input').attr('type', 'password');
                    $('#show_hide_password_confirmation i').addClass( "fa-eye-slash" );
                    $('#show_hide_password_confirmation i').removeClass( "fa-eye" );
                }else if($('#show_hide_password_confirmation input').attr("type") == "password"){
                    $('#show_hide_password_confirmation input').attr('type', 'text');
                    $('#show_hide_password_confirmation i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password_confirmation i').addClass( "fa-eye" );
                }
            });
        });
    </script>
@endpush

@push('css')
    <!-- datepicker css -->
    <link href="{{ asset('libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-colorpicker\css\bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-timepicker\css\bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.css') }}">

    <style>
        .input-group-addon {
            padding: 0.5rem 0.75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.25;
            color: #495057;
            text-align: center;
            background-color: #e9ecef;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: 0.25rem;
            width: 45px;
        }

        .input-group-addon a i{
            color: #495057;
        }

        .avatar {
            max-width: 300px;
        }
    </style>
@endpush