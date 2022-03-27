@extends('layouts.master')

@section('title') Danh sách đơn thuốc @endsection

@section('content')
    <div class="row">
        <h2 class="title">DANH SÁCH ĐƠN THUỐC</h2>

        <table class="table table-bordered">
            <tr class="text-center">
                <th>STT</th>
                <th>Mã đơn thuốc</th>
                <th>Bác sĩ</th>
                <th>Tổng tiền (VNĐ)</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>

            @php ($stt = 1)
            @foreach ($prescriptions as $prescription)
            <tr>
                <td class="text-center">{{ $stt++ }}</td>
                <td>{{ $prescription->code }}</td>
                <td>{{ $prescription->user->name }}</td>
                <td class="text-center">{{ number_format($prescription->total_money, 0, ',', '.') }}</td>
                <td class="text-center">
                    @if ($prescription->status)
                        <label class="btn btn-success waves-effect waves-light">
                        <i class="bx bx-check-double font-size-16 align-middle mr-2"></i> Hoàn thành
                    </label>
                    @else
                        <label class="btn btn-warning waves-effect waves-light font-size-12">Chưa mua</label>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('web.prescription-detail', $prescription->id) }}" data-toggle="tooltip" data-placement="top" title="Chi tiết" class="btn btn-primary">Chi tiết</a>
                </td>
            </tr>
            @endforeach
        </table>

        <div class="m-auto">
            {{ $prescriptions->links() }}
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
        $('.docs-date').datepicker({
            format: 'dd-mm-yyyy',
            endDate: new Date(),
        });

    </script>
@endpush

@push('css')
    <!-- datepicker css -->
    <link href="{{ asset('libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-colorpicker\css\bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-timepicker\css\bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.css') }}">
@endpush