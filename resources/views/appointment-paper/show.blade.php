@extends('layouts.default')

@section('title') Thông tin giấy hẹn khám bệnh @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Thông tin giấy hẹn khám bệnh</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('appointment_papers.index') }}" title="Quản lý giấy hẹn khám bệnh" data-toggle="tooltip" data-placement="top">Quản lý giấy hẹn khám bệnh</a></li>
                                    <li class="breadcrumb-item active">Thông tin giấy hẹn khám bệnh</li>
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

                                <h4 class="card-title">Thông tin hẹn khám bệnh</h4>
                                
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Tiêu đề :</label>
                                    </div>

                                    <div class="col-sm-10">
                                        <label>{{ $data_edit->title }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Tên bệnh nhân :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ $data_edit->healthCertification->patient->name }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Tên phòng khám :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ $data_edit->healthCertification->consultingRoom->name }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Tên bác sĩ :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ $data_edit->healthCertification->user->name }}</label>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>Ngày hẹn khám bệnh :</label>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="font-weight-bold">{{ date("d-m-Y", strtotime($data_edit->date)) }}</label>
                                    </div>

                                </div>

                                <a href="{{ route('appointment_papers.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
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