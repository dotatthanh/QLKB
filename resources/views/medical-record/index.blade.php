@extends('layouts.default')

@section('title') Quản lý hồ sơ bệnh nhân @endsection

@section('content')
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Danh sách hồ sơ bệnh nhân</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);" title="Quản lý" data-toggle="tooltip" data-placement="top">Quản lý</a></li>
                                    <li class="breadcrumb-item active">Danh sách hồ sơ bệnh nhân</li>
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
                                <form method="GET" action="{{ route('medical_records.index') }}">
                                    <div class="row mb-2">
                                        <div class="col-sm-5">
                                            <div class="search-box mr-2 mb-2 d-inline-block">
                                                <div class="position-relative">
                                                    <input type="text" name="search" class="form-control" placeholder="Nhập họ và tên">
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
                                                <th style="width: 70px;" class="text-center">STT</th>
                                                <th>Mã</th>
                                                {{-- <th>Ảnh đại diện</th> --}}
                                                <th>Họ và tên</th>
                                                <th>Giới tính</th>
                                                <th>Số điện thoại</th>
                                                <th>Ngày sinh</th>
                                                <th>Địa chỉ</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php ($stt = 1)
                                            @foreach ($patients as $patient)
                                                <tr>
                                                    <td class="text-center">{{ $stt++ }}</td>
                                                    <td>{{ $patient->code }}</td>
                                                    {{-- <td>
                                                        @if ($patient->avatar)
                                                            <div>
                                                                <img class="rounded-circle avatar-xs" src="{{ asset($patient->avatar) }}" alt="">
                                                            </div>
                                                        @else
                                                            <div class="avatar-xs">
                                                                <span class="avatar-title rounded-circle text-uppercase">
                                                                    {{ substr($patient->name, 0, 1) }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </td> --}}
                                                    <td>
                                                        {{ $patient->name }}
                                                    </td>
                                                    <td>{{ $patient->gender }}</td>
                                                    <td>{{ $patient->phone }}</td>
                                                    <td>{{ date("d-m-Y", strtotime($patient->birthday)) }}</td>
                                                    <td>{{ $patient->address }}</td>
                                                    <td class="text-center">
                                                        <ul class="list-inline font-size-20 contact-links mb-0">
                                                            <li class="list-inline-item px">
                                                                <a href="{{ route('medical_records.show', $patient->id) }}" data-toggle="tooltip" data-placement="top" title="Xem hồ sơ bệnh nhân"><i class="bx bx-news text-success"></i></a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{ $patients->links() }}
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