@extends('layouts.master')

@section('title') Danh sách đơn thuốc @endsection

@section('content')
    <div class="row">
        <h2 class="title">DANH SÁCH ĐƠN THUỐC</h2>

        <div class="col-sm-2">
            <label>Mã đơn thuốc :</label>
        </div>

        <div class="col-sm-10">
            <label>{{ $prescription->code }}</label>
        </div>

        <div class="col-sm-2">
            <label>Tên bệnh nhân :</label>
        </div>

        <div class="col-sm-4">
            <label>{{ $prescription->patient->name }}</label>
        </div>

        <div class="col-sm-2">
            <label>Bác sĩ :</label>
        </div>

        <div class="col-sm-4">
            <label>{{ $prescription->user->name }}</label>
        </div>

        <div class="col-sm-2">
            <label>Thẻ BHYT :</label>
        </div>

        <div class="col-sm-4">
            <div class="custom-control custom-checkbox  custom-checkbox-danger">
                @if ($prescription->is_health_insurance_card)
                <input type="checkbox" class="custom-control-input" id="check_insurance_card" disabled checked>
                <label class="custom-control-label" for="check_insurance_card">Miễn phí đơn thuốc</label>
                @else
                <input type="checkbox" class="custom-control-input" id="check_insurance_card" disabled>
                <label class="custom-control-label" for="check_insurance_card">Miễn phí đơn thuốc</label>
                @endif
            </div>
        </div>

        <div class="col-sm-2">
            <label>Tổng tiền :</label>
        </div>

        <div class="col-sm-4">
            <label class="text-danger font-weight-bold">{{ number_format($prescription->total_money, 0, ',', '.') }} VNĐ</label>
        </div>

        <div class="col-sm-2">
            <label>Trạng thái :</label>
        </div>

        <div class="col-sm-10">
            @if ($prescription->status)
                <label class="text-success">Đã mua</label>
            @else
                <label class="text-warning">Chưa mua</label>
            @endif
        </div>

        <div class="col-sm-12">
            <label>Chi tiết đơn thuốc :</label>
        </div>

        <div class="col-sm-12 mt-2">
            <table class="table table-bordered">
                <tr class="text-center">
                    <th>STT</th>
                    <th>Tên thuốc</th>
                    <th>Đơn vị tính</th>
                    <th>Số lượng</th>
                    <th>Cách dùng</th>
                    <th>Giá (VNĐ)</th>
                    <th>Tổng tiền (VNĐ)</th>
                </tr>

                @php ($stt = 1)
                @foreach ($prescription->prescriptionDetails as $prescriptionDetail)
                <tr>
                    <td class="text-center">{{ $stt++ }}</td>
                    <td>{{ $prescriptionDetail->medicine->name }}</td>
                    <td>{{ $prescriptionDetail->medicine->unit }}</td>
                    <td class="text-center">{{ $prescriptionDetail->amount }}</td>
                    <td>{{ $prescriptionDetail->use }}</td>
                    <td class="text-center">{{ number_format($prescriptionDetail->price, 0, ',', '.') }}</td>
                    <td class="text-center">{{ number_format($prescriptionDetail->total_money, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </table>
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