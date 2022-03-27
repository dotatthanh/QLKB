@extends('layouts.default')

@section('title') Thông tin hồ sơ bệnh án @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Thông tin hồ sơ bệnh án</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('health_certifications.index') }}" title="Quản lý giấy khám bệnh" data-toggle="tooltip" data-placement="top">Quản lý hồ sơ bệnh án</a></li>
                                    <li class="breadcrumb-item active">Thông tin hồ sơ bệnh án</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Thông tin bệnh nhân</h4>
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label>Mã bệnh nhân :</label>
                                            </div>

                                            <div class="col-sm-9">
                                                <label class="font-weight-bold">{{ $patient->code }}</label>
                                            </div>

                                            <div class="col-sm-3">
                                                <label>Tên bệnh nhân :</label>
                                            </div>

                                            <div class="col-sm-9">
                                                <label class="font-weight-bold">{{ $patient->name }}</label>
                                            </div>

                                            <div class="col-sm-3">
                                                <label>Giới tính :</label>
                                            </div>

                                            <div class="col-sm-9">
                                                <label class="font-weight-bold">{{ $patient->gender }}</label>
                                            </div>


                                            <div class="col-sm-3">
                                                <label>Số điện thoại :</label>
                                            </div>

                                            <div class="col-sm-9">
                                                <label class="font-weight-bold">{{ $patient->phone }}</label>
                                            </div>

                                            <div class="col-sm-3">
                                                <label>Ngày sinh :</label>
                                            </div>

                                            <div class="col-sm-9">
                                                <label class="font-weight-bold">{{ date("d-m-Y", strtotime($patient->birthday)) }}</label>
                                            </div>

                                            <div class="col-sm-3">
                                                <label>Địa chỉ :</label>
                                            </div>

                                            <div class="col-sm-9">
                                                <label class="font-weight-bold">{{ $patient->address }}</label>
                                            </div>


                                            <div class="col-sm-3">
                                                <label>Thẻ BHYT :</label>
                                            </div>

                                            <div class="col-sm-9">
                                                <div class="custom-control custom-checkbox  custom-checkbox-danger mb-3">
                                                    @if ($patient->is_health_insurance_card)
                                                        <input type="checkbox" class="custom-control-input" id="check_insurance_card" disabled checked>
                                                        <label class="custom-control-label" for="check_insurance_card">Miễn phí dịch vụ khám</label>
                                                    @else
                                                        <input type="checkbox" class="custom-control-input" id="check_insurance_card" disabled>
                                                        <label class="custom-control-label" for="check_insurance_card">Miễn phí dịch vụ khám</label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Ảnh đại diện :</label>
                                            </div>
                                            <div class="col-sm-12 text-center">
                                                <img src="{{ asset($patient->avatar) }}" alt="" style="max-height: 200px; max-width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach ($patient->healthCertifications as $healthCertification)
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Thông tin khám ngày {{ date("d-m-Y", strtotime($healthCertification->created_at)) }}</h4>
                                
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Mã giấy khám bệnh :</label>
                                    </div>

                                    <div class="col-sm-10">
                                        <label>{{ $healthCertification->code }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Tiêu đề :</label>
                                    </div>

                                    <div class="col-sm-10">
                                        <label>{{ $healthCertification->title }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>STT khám :</label>
                                    </div>

                                    <div class="col-sm-10">
                                        <label>{{ $healthCertification->number }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Tên bệnh nhân :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ $healthCertification->patient->name }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Tên phòng khám :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ $healthCertification->consultingRoom->name }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Thẻ BHYT :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="custom-control custom-checkbox  custom-checkbox-danger mb-3">
                                            @if ($healthCertification->is_health_insurance_card)
                                                <input type="checkbox" class="custom-control-input" id="check_insurance_card" disabled checked>
                                                <label class="custom-control-label" for="check_insurance_card">Miễn phí dịch vụ khám</label>
                                            @else
                                                <input type="checkbox" class="custom-control-input" id="check_insurance_card" disabled>
                                                <label class="custom-control-label" for="check_insurance_card">Miễn phí dịch vụ khám</label>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Tên bác sĩ :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ $healthCertification->user->name }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Ngày khám :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ date("d-m-Y", strtotime($healthCertification->date)) }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Giờ khám :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ date("H:i", strtotime($healthCertification->time)) }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Trạng thái :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        @if ($healthCertification->status)
                                            <label class="text-success">Đã khám</label>
                                        @else
                                            <label class="text-warning">Chưa khám</label>
                                        @endif
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Giá :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="text-danger font-weight-bold">{{ number_format($healthCertification->total_money, 0, ',', '.') }} VNĐ</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Thanh toán :</label>
                                    </div>

                                    <div class="col-sm-10">
                                        @if ($healthCertification->payment_status)
                                            <label class="text-success">Đã thanh toán</label>
                                        @else
                                            <label class="text-warning">Chưa thanh toán</label>
                                        @endif
                                    </div>

                                    @if ($healthCertification->status == 1)
                                        <div class="col-sm-2">
                                            <label>Kết luận :</label>
                                        </div>

                                        <div class="col-sm-10">
                                            <label>{!! $healthCertification->conclude !!}</label>
                                        </div>

                                        <div class="col-sm-2">
                                            <label>Hướng dẫn điều trị :</label>
                                        </div>

                                        <div class="col-sm-10">
                                            <label>{!! $healthCertification->treatment_guide !!}</label>
                                        </div>

                                        <div class="col-sm-2">
                                            <label>Đề nghị khám lâm sàng :</label>
                                        </div>

                                        <div class="col-sm-10">
                                            <label>{!! $healthCertification->suggestion !!}</label>
                                        </div>
                                    @endif

                                    @if ($healthCertification->prescription)
                                        <div class="col-sm-2">
                                            <label>Mã đơn thuốc :</label>
                                        </div>

                                        <div class="col-sm-10">
                                            <label>{{ $healthCertification->prescription->code }}</label>
                                        </div>

                                        <div class="col-sm-2">
                                            <label>Tổng tiền :</label>
                                        </div>

                                        <div class="col-sm-10">
                                            <label class="text-danger font-weight-bold">{{ number_format($healthCertification->prescription->total_money, 0, ',', '.') }} VNĐ</label>
                                        </div>

                                        <div class="col-sm-2">
                                            <label>Trạng thái :</label>
                                        </div>

                                        <div class="col-sm-10">
                                            @if ($healthCertification->prescription->status)
                                                <label class="text-success">Đã mua</label>
                                            @else
                                                <label class="text-warning">Chưa mua</label>
                                            @endif
                                        </div>

                                        <div class="col-sm-12">
                                            <label>Chi tiết đơn thuốc :</label>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-centered table-nowrap">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="text-center">STT</th>
                                                            <th>Tên thuốc</th>
                                                            <th>Đơn vị tính</th>
                                                            <th>Số lượng</th>
                                                            <th>Cách dùng</th>
                                                            <th>Giá (VNĐ)</th>
                                                            <th>Tổng tiền (VNĐ)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php ($stt = 1)
                                                        @foreach ($healthCertification->prescription->prescriptionDetails as $prescription_detail)
                                                            <tr>
                                                                <td class="text-center">{{ $stt++ }}</td>
                                                                <td>{{ $prescription_detail->medicine->name }}</td>
                                                                <td>
                                                                    {{ $prescription_detail->medicine->unit }}
                                                                </td>
                                                                <td>
                                                                    {{ $prescription_detail->amount }}
                                                                </td>
                                                                <td>{{ $prescription_detail->use }}</td>
                                                                <td>{{ number_format($prescription_detail->price, 0, ',', '.') }}</td>
                                                                <td>{{ number_format($prescription_detail->total_money, 0, ',', '.') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('health_certifications.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Skote.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                            Design & Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

@push('js')
    <!-- select 2 plugin -->
    <script src="{{ asset('libs\select2\js\select2.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('js\pages\ecommerce-select2.init.js') }}"></script>

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
        });

        // $(document).ready(function() {
        //     $(`#print`).click(function() {
        //         $(`#print`).addClass('d-block');
        //         window.print();
        //     });
        // });
    </script>
@endpush

@push('css')
    <!-- datepicker css -->
    <link href="{{ asset('libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-colorpicker\css\bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs\bootstrap-timepicker\css\bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('libs\@chenfengyuan\datepicker\datepicker.min.css') }}">
    <!-- select2 css -->
    <link href="{{ asset('libs\select2\css\select2.min.css') }}" rel="stylesheet" type="text/css">
@endpush