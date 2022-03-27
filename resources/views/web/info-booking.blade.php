@extends('layouts.master')

@section('title') Thông tin đặt lịch @endsection

@section('content')
    <div class="row">
        <h2 class="title">THÔNG TIN ĐẶT LỊCH</h2>

        <table class="table table-bordered">
            <tr class="text-center">
                <th>STT</th>
                <th>Tên</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Triệu chứng hoặc yêu cầu</th>
                <th>Ngày khám</th>
                <th>Giờ khám</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
            <tbody>
                @php ($stt = 1)
                @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $stt++ }}</td>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->phone }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->content }}</td>
                    <td>{{ date("d-m-Y", strtotime($booking->date)) }}</td>
                    <td>{{ date("H:i", strtotime($booking->time)) }}</td>
                    <td>
                        @if ($booking->status == 0)
                            Chờ duyệt
                        @elseif ($booking->status == 1)
                            Đã duyệt
                        @elseif ($booking->status == -1)
                            Đã huỷ
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($booking->status == 0)
                            <form action="{{ route('web.cancel-appointment', $booking->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">Huỷ lịch</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
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