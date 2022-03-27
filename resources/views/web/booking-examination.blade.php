@extends('layouts.master')

@section('title') Đặt lịch khám @endsection

@section('content')
    <div class="row">
        <h2 class="title">ĐẶT LỊCH KHÁM</h2>

        <div class="col-6">
            <h3 class="title-note font-weight-bold">Lưu ý</h3>
            <p class="font-weight-bold mt-2">Quý khách vui lòng gửi thông tin chi tiết để chúng tôi có thể sắp xếp cuộc hẹn.</p>

            <p class="mt-3">Lịch hẹn có hiệu lực sau khi được xác nhận chính thức từ Trung tâm y tế Tận Tâm</p>
            <p class="mt-3">Vui lòng cung cấp thông tin chính xác để được phục vụ tốt nhất. Trong trường hợp cung cấp sai thông tin email & điện thoại, việc xác nhận cuộc hẹn sẽ không hiệu lực.</p>
            <p class="mt-3">Quý khách sử dụng dịch vụ Đặt hẹn trực tuyến, xin vui lòng đặt trước ít nhất là 24 giờ trước khi đến khám.</p>
            <p class="mt-3">Trong những trường hợp khẩn cấp hoặc nghi ngờ có các triệu chứng nguy hiểm, quý khách nên ĐẾN TRỰC TIẾP hoặc trung tâm y tế gần nhất để kịp thời xử lý.</p>
        </div>

        <div class="col-6">
            <form action="{{ route('web.booking') }}" method="POST" class="form-booking">
                @csrf
                <h4 class="title-note w-100 text-center">ĐẶT LỊCH KHÁM</h4>

                <input type="text" name="name" class="form-control mt-3" id="name" placeholder="Họ và tên (*)" value="{{ auth()->guard('web')->user() ? auth()->guard('web')->user()->name : '' }}" {{ auth()->guard('web')->user() ? 'readonly' : '' }}>
                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                
                <input type="text" name="phone" class="form-control mt-3" id="phone" placeholder="Số điện thoại (*)" value="{{ auth()->guard('web')->user() ? auth()->guard('web')->user()->phone : '' }}" {{ auth()->guard('web')->user() ? 'readonly' : '' }}>
                {!! $errors->first('phone', '<span class="text-danger">:message</span>') !!}
                
                <input type="email" name="email" class="form-control mt-3" id="email" placeholder="Email (*)" value="{{ auth()->guard('web')->user() ? auth()->guard('web')->user()->email : '' }}" {{ auth()->guard('web')->user() ? 'readonly' : '' }}>
                {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                
                <textarea name="content" id="content" class="form-control mt-3" placeholder="Triệu chứng hoặc yêu cầu khám (*)" rows="5"></textarea>
                {!! $errors->first('content', '<span class="text-danger">:message</span>') !!}

                <div class="docs-datepicker mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control docs-date" name="date" placeholder="Chọn ngày khám (*)" autocomplete="off" value="{{ old('date', isset($data_edit->date) ? date('d-m-Y', strtotime($data_edit->date)) : '') }}">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="docs-datepicker-container"></div>
                    {!! $errors->first('date', '<span class="error">:message</span>') !!}
                </div>

                <div class="input-group mt-3" id="timepicker-input-group2">
                    <input id="timepicker2" type="text" class="form-control" name="time" data-provide="timepicker" placeholder="Chọn giờ khám (*)">

                    <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                </div>
                {!! $errors->first('time', '<span class="error">:message</span>') !!}

                <button type="submit" class="btn btn-booking mt-3">ĐẶT LỊCH KHÁM</button>
            </form>
        </div>
    </div>
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
        let date = new Date();
        $('.docs-date').datepicker({
            format: 'dd-mm-yyyy',
            startDate: new Date(date),
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
        .bootstrap-timepicker-hour, .bootstrap-timepicker-minute, .bootstrap-timepicker-meridian {
            padding: 0 !important;
        }
    </style>
@endpush