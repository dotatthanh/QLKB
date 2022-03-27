@extends('layouts.master')

@section('title') Đăng ký @endsection

@section('content')
    <h2 class="title">ĐĂNG KÝ</h2>
    <form action="{{ route('web.post-register') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="name">Họ và tên <span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" class="form-control" placeholder="Họ và tên" value="{{ old('name', $data_edit->name ?? '') }}">
                    {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="gender">Giới tính <span class="text-danger">*</span></label>
                    <div class="form-check form-check">
                        <input type="radio" class="form-check-input" id="nam" name="gender" value="Nam" 
                        checked>
                        <label class="form-check-label" for="nam">Nam</label>
                    </div>
                    <div class="form-check form-check">
                        <input type="radio" class="form-check-input" id="nu" name="gender" value="Nữ" >
                        <label class="form-check-label" for="nu">Nữ</label>
                    </div>
                    {!! $errors->first('gender', '<span class="text-danger">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="birthday">Ngày sinh <span class="text-danger">*</span></label>
                    <div class="docs-datepicker">
                        <div class="input-group">
                            <input type="text" class="form-control docs-date" name="birthday" placeholder="Chọn ngày sinh" autocomplete="off" value="{{ old('birthday', isset($data_edit->birthday) ? date('d-m-Y', strtotime($data_edit->birthday)) : '') }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="docs-datepicker-container"></div>
                    </div>
                    {!! $errors->first('birthday', '<span class="text-danger">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="userpassword">Mật khẩu <span class="text-danger">*</span></label>
                    <div class="input-group" id="show_hide_password">
                        <input type="password" class="form-control" id="userpassword" placeholder="Nhập mật khẩu" autocomplete="new-password" name="password">
                        <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>  
                    {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                    <div class="input-group" id="show_hide_password_confirmation">
                        <input type="password" class="form-control" id="password_confirmation" placeholder="Nhập xác nhận mật khẩu" name="password_confirmation">
                        <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>        
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input id="email" name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email', $data_edit->email ?? '') }}">
                    {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="avatar">Ảnh đại diện</label>
                    <input id="avatar" name="avatar" type="file" class="form-control">
                    {!! $errors->first('avatar', '<span class="text-danger">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                    <input id="phone" name="phone" type="number" class="form-control" placeholder="Số điện thoại" value="{{ old('phone', $data_edit->phone ?? '') }}">
                    {!! $errors->first('phone', '<span class="text-danger">:message</span>') !!}
                </div>

                <div class="form-group">
                    <label for="address">Địa chỉ <span class="text-danger">*</span></label>
                    <input id="address" name="address" type="text" class="form-control" placeholder="Địa chỉ" value="{{ old('address', $data_edit->address ?? '') }}">
                    {!! $errors->first('address', '<span class="text-danger">:message</span>') !!}
                </div>
            </div>

            <div class="col text-center">
                <button type="submit" class="btn btn-success">Đăng ký</button>
                <a href="" class="btn btn-primary d-inline-block ml-3">Đăng nhập</a>
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
    </style>
@endpush