@extends('layouts.default')

@section('title') Thu ngân đơn thuốc @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách thu ngân đơn thuốc</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Thu ngân" data-toggle="tooltip" data-placement="top">Thu ngân</a></li>
                                    <li class="breadcrumb-item active">Danh sách thu ngân đơn thuốc</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="GET" action="{{ route('prescriptions.index') }}">
                                    <div class="row mb-2">
                                        <div class="col-sm-5">
                                            <div class="search-box mr-2 mb-2 d-inline-block">
                                                <div class="position-relative">
                                                    <input type="text" name="search" class="form-control" placeholder="Nhập tên bệnh nhân">
                                                    <i class="bx bx-search-alt search-icon"></i>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                                            </button>
                                        </div>

                                        @can('Thêm đơn thuốc')
                                        <div class="col-sm-7">
                                            <div class="text-sm-right">
                                                <a href="{{ route('prescriptions.create') }}" class="text-white btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-plus mr-1"></i> Thêm đơn thuốc</a>
                                            </div>
                                        </div><!-- end col-->
                                        @endcan
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 70px;" class="text-center">STT</th>
                                                <th>Mã</th>
                                                <th>Tên bệnh nhân</th>
                                                <th>Bác sĩ</th>
                                                <th>Tổng tiền (VNĐ)</th>
                                                <th>Trạng thái</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php ($stt = 1)
                                            @foreach ($prescriptions as $prescription)
                                                <tr>
                                                    <td class="text-center">{{ $stt++ }}</td>
                                                    <td>{{ $prescription->code }}</td>
                                                    <td>
                                                        {{ $prescription->patient->name }}
                                                    </td>
                                                    <td>
                                                        {{ $prescription->user->name }}
                                                    </td>
                                                    <td>{{ number_format($prescription->total_money, 0, ',', '.') }}</td>
                                                    <td>
                                                        @if ($prescription->status == 1)
                                                            <label class="btn btn-success waves-effect waves-light">
                                                                <i class="bx bx-check-double font-size-16 align-middle mr-2"></i> Đã mua
                                                            </label>
                                                        @elseif ($prescription->status == 2)
                                                            <label class="btn btn-success waves-effect waves-light">
                                                                <i class="bx bx-check-double font-size-16 align-middle mr-2"></i> Đã hoàn tiền
                                                            </label>
                                                        @else
                                                            <label class="btn btn-warning waves-effect waves-light font-size-12">Chưa mua</label>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <ul class="list-inline font-size-20 contact-links mb-0">
                                                            @if ($prescription->status == 0)
                                                                @can('Xác nhận thanh toán đơn thuốc')
                                                                <li class="list-inline-item px">
                                                                    <form method="post" action="{{ route('cashier_prescriptions.confirm-payment', $prescription->id) }}">
                                                                        @csrf
                                                                        
                                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="Xác nhận thanh toán" class="border-0 bg-white"><i class="bx bxs-calendar-check text-success"></i></button>
                                                                    </form>
                                                                </li>
                                                                @endcan
                                                            @elseif ($prescription->status == 1)
                                                                @can('Hoàn tiền đơn thuốc')
                                                                <li class="list-inline-item px">
                                                                    <form method="post" action="{{ route('cashier_prescriptions.refund', $prescription->id) }}">
                                                                        @csrf
                                                                        
                                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="Hoàn tiền" class="border-0 bg-white"><i class="bx bxs-calendar-check text-success"></i></button>
                                                                    </form>
                                                                </li>
                                                                @endcan
                                                            @endif

                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $prescriptions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
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