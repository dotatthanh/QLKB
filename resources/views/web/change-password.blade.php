@extends('layouts.master')

@section('title') Đổi mật khẩu @endsection

@section('content')
    <h2 class="title">ĐỔI MẬT </h2>
    <form action="{{ route('web.post-change-password', auth()->guard('web')->user()->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="user-password-old">Mật khẩu hiện tại</label>
                    <div class="input-group" id="show_hide_password_old">
                        <input type="password" class="form-control" id="user-password-old" placeholder="Nhập mật khẩu" name="password_old">
                        <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>  
                    {!! $errors->first('password_old', '<span class="text-danger">:message</span>') !!}
                </div>


                <div class="form-group">
                    <label for="user-password">Mật khẩu mới</label>
                    <div class="input-group" id="show_hide_password">
                        <input type="password" class="form-control" id="user-password" placeholder="Nhập mật khẩu" name="password">
                        <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>  
                    {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="password-confirmation">Nhập lại mật khẩu mới</label>
                    <div class="input-group" id="show_hide_password_confirmation">
                        <input type="password" class="form-control" id="password-confirmation" placeholder="Nhập xác nhận mật khẩu" name="password_confirmation">
                        <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>        
                    {!! $errors->first('password_confirmation', '<span class="text-danger">:message</span>') !!}
                </div>
            </div>

            <div class="col text-center">
                <button type="submit" class="btn btn-success">Lưu thông tin</button>
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

            $("#show_hide_password_old a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password_old input').attr("type") == "text"){
                    $('#show_hide_password_old input').attr('type', 'password');
                    $('#show_hide_password_old i').addClass( "fa-eye-slash" );
                    $('#show_hide_password_old i').removeClass( "fa-eye" );
                }else if($('#show_hide_password_old input').attr("type") == "password"){
                    $('#show_hide_password_old input').attr('type', 'text');
                    $('#show_hide_password_old i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password_old i').addClass( "fa-eye" );
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
    </style>
@endpush