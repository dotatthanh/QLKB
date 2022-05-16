@extends('layouts.default')

@section('title') Quản lý đặt lịch @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách đặt lịch</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item active">Danh sách đặt lịch</li>
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
                                <form method="GET" action="{{ route('bookings.index') }}">
                                    <div class="row mb-2">
                                        <div class="col-sm-5">
                                            <div class="search-box mr-2 mb-2 d-inline-block">
                                                <div class="position-relative">
                                                    <input type="text" name="search" class="form-control" placeholder="Nhập số điện thoại">
                                                    <i class="bx bx-search-alt search-icon"></i>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-search-alt search-icon font-size-16 align-middle mr-2"></i> Tìm kiếm
                                            </button>
                                        </div>

                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th>Họ và tên</th>
                                                <th>Số điện thoại</th>
                                                <th>Email</th>
                                                <th>Triệu chứng hoặc yêu cầu</th>
                                                <th>Phòng khám</th>
                                                <th>Ngày khám</th>
                                                <th>Giờ khám</th>
                                                <th>Trạng thái</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php ($stt = 1)
                                            @foreach ($bookings as $booking)
                                                <tr>
                                                    <td>{{ $stt++ }}</td>
                                                    <td>{{ $booking->name }}</td>
                                                    <td>{{ $booking->phone }}</td>
                                                    <td>{{ $booking->email }}</td>
                                                    <td>{{ $booking->content }}</td>
                                                    <td>{{ $booking->consultingRoom->name }}</td>
                                                    <td>{{ date("d-m-Y", strtotime($booking->date)) }}</td>
                                                    <td>{{ date("H:i", strtotime($booking->time)) }}</td>
                                                    <td>
                                                        @if ($booking->status == 1)
                                                            <label class="btn btn-success waves-effect waves-light">
                                                                <i class="bx bx-check-double font-size-16 align-middle mr-2"></i> Đã duyệt
                                                            </label>
                                                        @elseif ($booking->status == 0)
                                                            <label class="btn btn-warning waves-effect waves-light font-size-12">Chờ duyệt</label>
                                                        @elseif ($booking->status == -1)
                                                            <label class="btn btn-danger waves-effect waves-light font-size-12">Đã huỷ</label>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <ul class="list-inline font-size-20 contact-links mb-0">

                                                            @if ($booking->status == 0)
                                                                @can('Duyệt lịch')
                                                                <li class="list-inline-item px">
                                                                    <form method="post" action="{{ route('bookings.approve-booking', $booking->id) }}">
                                                                        @csrf
                                                                        
                                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="Duyệt" class="border-0 bg-white"><i class="bx bxs-calendar-check text-success"></i></button>
                                                                    </form>

                                                                </li>
                                                                @endcan

                                                                @can('Huỷ lịch')
                                                                <li class="list-inline-item px">
                                                                    <form method="post" action="{{ route('bookings.cancel-appointment', $booking->id) }}">
                                                                        @csrf
                                                                        
                                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="Huỷ lịch" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                                    </form>
                                                                </li>
                                                                @endcan
                                                            @else
                                                                @can('Tạo phiếu dịch vụ')
                                                                <li class="list-inline-item px">
                                                                    <a href="{{ route('health_certifications.create', ['booking_id' => $booking->id]) }}" data-toggle="tooltip" data-placement="top" title="Tạo phiếu giấy khám bệnh"><i class="mdi mdi-plus text-success"></i></a>
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

                                {{ $bookings->links() }}
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