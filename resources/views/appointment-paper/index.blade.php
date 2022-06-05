@extends('layouts.default')

@section('title') Quản lý giấy hẹn tái khám @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách giấy hẹn tái khám</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item active">Danh sách giấy hẹn tái khám</li>
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
                                <form method="GET" action="{{ route('appointment_papers.index') }}">
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
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th>Mã</th>
                                                <th>Tên bệnh nhân</th>
                                                <th>Tiêu đề</th>
                                                <th>Phòng khám</th>
                                                <th>Bác sĩ</th>
                                                <th>Ngày hẹn</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($appointment_papers as $data)
                                                <tr>
                                                    <td class="text-center">{{ $data->healthCertification->number }}</td>
                                                    <td>{{ $data->healthCertification->code }}</td>
                                                    <td>
                                                        {{ $data->healthCertification->patient->name }}
                                                    </td>
                                                    <td>
                                                        {{ $data->title }}
                                                    </td>
                                                    <td>{{ $data->healthCertification->consultingRoom->name }}</td>
                                                    <td>{{ $data->healthCertification->user->name }}</td>
                                                    <td>{{ date("d-m-Y", strtotime($data->date)) }}</td>
                                                    <td class="text-center">
                                                        <ul class="list-inline font-size-20 contact-links mb-0">
                                                            @can('Xem thông tin giấy hẹn tái khám')
                                                            <li class="list-inline-item px">
                                                                <a href="{{ route('appointment_papers.show', $data->id) }}" data-toggle="tooltip" data-placement="top" title="Xem thông tin"><i class="bx bx-user-circle text-success"></i></a>
                                                            </li>
                                                            @endcan

                                                            @can('In giấy hẹn tái khám')
                                                            <li class="list-inline-item px">
                                                                <a href="{{ route('appointment_papers.print', $data->id) }}" data-toggle="tooltip" data-placement="top" title="In giấy hẹn tái khám"><i class="bx bx-printer text-success"></i></a>
                                                            </li>
                                                            @endcan

                                                            @can('Chỉnh sửa giấy hẹn tái khám')
                                                            <li class="list-inline-item px">
                                                                <a href="{{ route('appointment_papers.edit', $data->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                            </li>
                                                            @endcan
                                                            
                                                            @can('Xóa giấy hẹn tái khám')
                                                            <li class="list-inline-item px">
                                                                <form method="post" action="{{ route('appointment_papers.destroy', $data->id) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    
                                                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white" onclick="return confirm('Bạn có chắc chắn muốn xoá?')"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                                </form>
                                                            </li>
                                                            @endcan
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $appointment_papers->links() }}
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