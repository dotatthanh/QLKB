<div class="vertical-menu">

    <div data-simplebar="" class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Quản lý</li>

                <li>
                    <a href="{{ route('dashboard') }}" class=" waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('medical_records.index') }}" class=" waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Hồ sơ bệnh án</span>
                    </a>
                </li>

                @can('Xem danh sách đặt lịch')
                    <li>
                        <a href="{{ route('bookings.index') }}" class=" waves-effect">
                            <i class="bx bx-calendar"></i>
                            <span>Đặt lịch</span>
                        </a>
                    </li>
                @endcan

                @can('Xem danh sách giấy khám bệnh')
                    <li>
                        <a href="{{ route('health_certifications.index') }}" class=" waves-effect">
                            <i class="bx bx-calendar"></i>
                            <span>Giấy khám bệnh</span>
                        </a>
                    </li>
                @endcan

                @can('Xem danh sách đơn thuốc')
                <li>
                    <a href="{{ route('prescriptions.index') }}" class=" waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span>Đơn thuốc</span>
                    </a>
                </li>
                @endcan

                @can('Xem danh sách phiếu dịch vụ')
                <li>
                    <a href="{{ route('service_vouchers.index') }}" class=" waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span>Phiếu dịch vụ</span>
                    </a>
                </li>
                @endcan

                @can('Xem danh sách giấy hẹn tái khám')
                <li>
                    <a href="{{ route('appointment_papers.index') }}" class=" waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span>Giấy hẹn tái khám</span>
                    </a>
                </li>
                @endcan

                @can('Xem danh sách phòng khám')
                <li>
                    <a href="{{ route('consulting_rooms.index') }}" class=" waves-effect">
                        <i class="bx bx-home-alt"></i>
                        <span>Phòng khám</span>
                    </a>
                </li>
                @endcan

                @can('Xem danh sách dịch vụ khám')
                <li>
                    <a href="{{ route('medical_services.index') }}" class=" waves-effect">
                        <i class="bx bx-globe"></i>
                        <span>Dịch vụ khám</span>
                    </a>
                </li>
                @endcan

                @can('Xem danh sách loại thuốc')
                <li>
                    <a href="{{ route('types.index') }}" class=" waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span>Loại thuốc</span>
                    </a>
                </li>
                @endcan

                @can('Xem danh sách thuốc')
                <li>
                    <a href="{{ route('medicines.index') }}" class=" waves-effect">
                        <i class="bx bx-plus-medical"></i>
                        <span>Thuốc</span>
                    </a>
                </li>
                @endcan

                @can('Xem danh sách bệnh nhân')
                <li>
                    <a href="{{ route('patients.index') }}" class=" waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span>Bệnh nhân</span>
                    </a>
                </li>
                @endcan

                @can('Xem thu ngân giấy khám bệnh', 'Xem thu ngân phiếu dịch vụ')
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bxs-bar-chart-alt-2"></i><span class="badge badge-pill badge-info float-right">02</span>
                        <span>Thu ngân</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('Xem thu ngân giấy khám bệnh')
                        <li><a href="{{ route('cashier_health_certifications.index') }}">Giấy khám bệnh</a></li>
                        @endcan
                        @can('Xem thu ngân phiếu dịch vụ')
                        <li><a href="{{ route('cashier_service_vouchers.index') }}">Phiếu dịch vụ</a></li>
                        @endcan
                        @can('Xem thu ngân đơn thuốc')
                        <li><a href="{{ route('cashier_prescriptions.index') }}">Đơn thuốc</a></li>
                        @endcan
                        @can('Xem doanh thu')
                        <li><a href="{{ route('revenues.index') }}">Doanh thu</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('Xem danh sách tài khoản', 'Xem danh sách vai trò', 'Xem danh sách quyền')
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-cog"></i><span class="badge badge-pill badge-info float-right">03</span>
                        <span>Cài đặt</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('Xem danh sách tài khoản')
                        <li><a href="{{ route('users.index') }}">Tài khoản</a></li>
                        @endcan
                        @can('Xem danh sách vai trò')
                        <li><a href="{{ route('roles.index') }}">Vai trò</a></li>
                        @endcan
                        @can('Xem danh sách quyền')
                        <li><a href="{{ route('permissions.index') }}">Quyền</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>