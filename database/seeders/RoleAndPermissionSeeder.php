<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo vai trò
        $admin = Role::create(['guard_name' => 'admin','name' => 'Admin']);
        $doctor = Role::create(['guard_name' => 'admin','name' => 'Bác sĩ']);

        // Gán vai trò
        User::find(1)->assignRole('Admin');

        // Tạo quyền
        $view_health_certification = Permission::create(['guard_name' => 'admin','name' => 'Xem danh sách giấy khám bệnh']);
        $view_detail_health_certification = Permission::create(['guard_name' => 'admin','name' => 'Xem thông tin giấy khám bệnh']);
        $create_health_certification = Permission::create(['guard_name' => 'admin','name' => 'Thêm giấy khám bệnh']);
        $edit_health_certification = Permission::create(['guard_name' => 'admin','name' => 'Chỉnh sửa giấy khám bệnh']);
        $delete_health_certification = Permission::create(['guard_name' => 'admin','name' => 'Xóa giấy khám bệnh']);
        $create_service_voucher_health_certification = Permission::create(['guard_name' => 'admin','name' => 'Tạo phiếu dịch vụ trong giấy khám bệnh']);
        $create_prescription_health_certification = Permission::create(['guard_name' => 'admin','name' => 'Tạo đơn thuốc trong giấy khám bệnh']);
        $create_health_certification_booking = Permission::create(['guard_name' => 'admin','name' => 'Tạo giấy khám bệnh trong đặt lịch']);
        $conclude_health_certification = Permission::create(['guard_name' => 'admin','name' => 'Kết luận khám giấy khám bệnh']);
        $print_health_certification = Permission::create(['guard_name' => 'admin','name' => 'In giấy khám bệnh']);
        $list_prescription = Permission::create(['guard_name' => 'admin','name' => 'Kê đơn thuốc']);

        // Set quyền cho vai trò admin
        $admin->givePermissionTo($view_health_certification);
        $admin->givePermissionTo($view_detail_health_certification);
        $admin->givePermissionTo($create_health_certification);
        $admin->givePermissionTo($edit_health_certification);
        $admin->givePermissionTo($delete_health_certification);
        $admin->givePermissionTo($create_service_voucher_health_certification);
        $admin->givePermissionTo($create_prescription_health_certification);
        $admin->givePermissionTo($create_health_certification_booking);
        $admin->givePermissionTo($conclude_health_certification);
        $admin->givePermissionTo($print_health_certification);
        $admin->givePermissionTo($list_prescription);

        $view_prescription = Permission::create(['guard_name' => 'admin','name' => 'Xem danh sách đơn thuốc']);
        $view_detail_prescription = Permission::create(['guard_name' => 'admin','name' => 'Xem thông tin đơn thuốc']);
        $create_prescription = Permission::create(['guard_name' => 'admin','name' => 'Thêm đơn thuốc']);
        $edit_prescription = Permission::create(['guard_name' => 'admin','name' => 'Chỉnh sửa đơn thuốc']);
        $delete_prescription = Permission::create(['guard_name' => 'admin','name' => 'Xóa đơn thuốc']);
        $print_prescription = Permission::create(['guard_name' => 'admin','name' => 'In đơn thuốc']);

        $admin->givePermissionTo($view_prescription);
        $admin->givePermissionTo($view_detail_prescription);
        $admin->givePermissionTo($create_prescription);
        $admin->givePermissionTo($edit_prescription);
        $admin->givePermissionTo($delete_prescription);
        $admin->givePermissionTo($print_prescription);

        $view_service_voucher = Permission::create(['guard_name' => 'admin','name' => 'Xem danh sách phiếu dịch vụ']);
        $view_detail_service_voucher = Permission::create(['guard_name' => 'admin','name' => 'Xem thông tin phiếu dịch vụ']);
        $create_service_voucher = Permission::create(['guard_name' => 'admin','name' => 'Thêm phiếu dịch vụ']);
        $edit_service_voucher = Permission::create(['guard_name' => 'admin','name' => 'Chỉnh sửa phiếu dịch vụ']);
        $delete_service_voucher = Permission::create(['guard_name' => 'admin','name' => 'Xóa phiếu dịch vụ']);
        $complete_examination_service_voucher = Permission::create(['guard_name' => 'admin','name' => 'Hoàn thành khám phiếu dịch vụ']);
        $conclude_service_voucher = Permission::create(['guard_name' => 'admin','name' => 'Kết luận khám phiếu dịch vụ']);
        $print_service_voucher = Permission::create(['guard_name' => 'admin','name' => 'In phiếu dịch vụ']);

        $admin->givePermissionTo($view_service_voucher);
        $admin->givePermissionTo($view_detail_service_voucher);
        $admin->givePermissionTo($create_service_voucher);
        $admin->givePermissionTo($edit_service_voucher);
        $admin->givePermissionTo($delete_service_voucher);
        $admin->givePermissionTo($complete_examination_service_voucher);
        $admin->givePermissionTo($conclude_service_voucher);
        $admin->givePermissionTo($print_service_voucher);

        $view_consulting_room = Permission::create(['guard_name' => 'admin','name' => 'Xem danh sách phòng khám']);
        $create_consulting_room = Permission::create(['guard_name' => 'admin','name' => 'Thêm phòng khám']);
        $edit_consulting_room = Permission::create(['guard_name' => 'admin','name' => 'Chỉnh sửa phòng khám']);
        $delete_consulting_room = Permission::create(['guard_name' => 'admin','name' => 'Xóa phòng khám']);

        $admin->givePermissionTo($view_consulting_room);
        $admin->givePermissionTo($create_consulting_room);
        $admin->givePermissionTo($edit_consulting_room);
        $admin->givePermissionTo($delete_consulting_room);

        $view_medical_service = Permission::create(['guard_name' => 'admin','name' => 'Xem danh sách dịch vụ khám']);
        $create_medical_service = Permission::create(['guard_name' => 'admin','name' => 'Thêm dịch vụ khám']);
        $edit_medical_service = Permission::create(['guard_name' => 'admin','name' => 'Chỉnh sửa dịch vụ khám']);
        $delete_medical_service = Permission::create(['guard_name' => 'admin','name' => 'Xóa dịch vụ khám']);

        $admin->givePermissionTo($view_medical_service);
        $admin->givePermissionTo($create_medical_service);
        $admin->givePermissionTo($edit_medical_service);
        $admin->givePermissionTo($delete_medical_service);

        $view_type = Permission::create(['guard_name' => 'admin','name' => 'Xem danh sách loại thuốc']);
        $create_type = Permission::create(['guard_name' => 'admin','name' => 'Thêm loại thuốc']);
        $edit_type = Permission::create(['guard_name' => 'admin','name' => 'Chỉnh sửa loại thuốc']);
        $delete_type = Permission::create(['guard_name' => 'admin','name' => 'Xóa loại thuốc']);

        $admin->givePermissionTo($view_type);
        $admin->givePermissionTo($create_type);
        $admin->givePermissionTo($edit_type);
        $admin->givePermissionTo($delete_type);

        $view_medicine = Permission::create(['guard_name' => 'admin','name' => 'Xem danh sách thuốc']);
        $create_medicine = Permission::create(['guard_name' => 'admin','name' => 'Thêm thuốc']);
        $edit_medicine = Permission::create(['guard_name' => 'admin','name' => 'Chỉnh sửa thuốc']);
        $delete_medicine = Permission::create(['guard_name' => 'admin','name' => 'Xóa thuốc']);

        $admin->givePermissionTo($view_medicine);
        $admin->givePermissionTo($create_medicine);
        $admin->givePermissionTo($edit_medicine);
        $admin->givePermissionTo($delete_medicine);

        $view_patient = Permission::create(['guard_name' => 'admin','name' => 'Xem danh sách bệnh nhân']);
        $create_patient = Permission::create(['guard_name' => 'admin','name' => 'Thêm bệnh nhân']);
        $edit_patient = Permission::create(['guard_name' => 'admin','name' => 'Chỉnh sửa bệnh nhân']);
        $delete_patient = Permission::create(['guard_name' => 'admin','name' => 'Xóa bệnh nhân']);

        $admin->givePermissionTo($view_patient);
        $admin->givePermissionTo($create_patient);
        $admin->givePermissionTo($edit_patient);
        $admin->givePermissionTo($delete_patient);

        $view_user = Permission::create(['guard_name' => 'admin','name' => 'Xem danh sách tài khoản']);
        $create_user = Permission::create(['guard_name' => 'admin','name' => 'Thêm tài khoản']);
        $edit_user = Permission::create(['guard_name' => 'admin','name' => 'Chỉnh sửa tài khoản']);
        $delete_user = Permission::create(['guard_name' => 'admin','name' => 'Xóa tài khoản']);

        $admin->givePermissionTo($view_user);
        $admin->givePermissionTo($create_user);
        $admin->givePermissionTo($edit_user);
        $admin->givePermissionTo($delete_user);

        $view_role = Permission::create(['guard_name' => 'admin','name' => 'Xem danh sách vai trò']);
        $create_role = Permission::create(['guard_name' => 'admin','name' => 'Thêm vai trò']);
        $edit_role = Permission::create(['guard_name' => 'admin','name' => 'Chỉnh sửa vai trò']);
        $delete_role = Permission::create(['guard_name' => 'admin','name' => 'Xóa vai trò']);

        $admin->givePermissionTo($view_role);
        $admin->givePermissionTo($create_role);
        $admin->givePermissionTo($edit_role);
        $admin->givePermissionTo($delete_role);

        $view_permission = Permission::create(['guard_name' => 'admin','name' => 'Xem danh sách quyền']);
        $view_permission_detail = Permission::create(['guard_name' => 'admin','name' => 'Xem quyền']);
        $edit_permission = Permission::create(['guard_name' => 'admin','name' => 'Chỉnh sửa quyền']);

        $admin->givePermissionTo($view_permission);
        $admin->givePermissionTo($view_permission_detail);
        $admin->givePermissionTo($edit_permission);

        $view_cashier_health_certificate = Permission::create(['guard_name' => 'admin','name' => 'Xem thu ngân giấy khám bệnh']);
        $confirm_payment_health_certificate = Permission::create(['guard_name' => 'admin','name' => 'Xác nhận thanh toán giấy khám bệnh']);
        $refund_health_certificate = Permission::create(['guard_name' => 'admin','name' => 'Hoàn tiền giấy khám bệnh']);
        $view_cashier_service_voucher = Permission::create(['guard_name' => 'admin','name' => 'Xem thu ngân phiếu dịch vụ']);
        $confirm_payment_service_voucher = Permission::create(['guard_name' => 'admin','name' => 'Xác nhận thanh toán phiếu dịch vụ']);
        $refund_health_service_voucher = Permission::create(['guard_name' => 'admin','name' => 'Hoàn tiền phiếu dịch vụ']);
        $view_cashier_prescription = Permission::create(['guard_name' => 'admin','name' => 'Xem thu ngân đơn thuốc']);
        $confirm_payment_prescription = Permission::create(['guard_name' => 'admin','name' => 'Xác nhận thanh toán đơn thuốc']);
        $refund_health_prescription = Permission::create(['guard_name' => 'admin','name' => 'Hoàn tiền đơn thuốc']);
        $view_revenue = Permission::create(['guard_name' => 'admin','name' => 'Xem doanh thu']);

        $admin->givePermissionTo($view_cashier_health_certificate);
        $admin->givePermissionTo($view_cashier_service_voucher);
        $admin->givePermissionTo($view_cashier_prescription);
        $admin->givePermissionTo($confirm_payment_health_certificate);
        $admin->givePermissionTo($confirm_payment_service_voucher);
        $admin->givePermissionTo($confirm_payment_prescription);
        $admin->givePermissionTo($refund_health_certificate);
        $admin->givePermissionTo($refund_health_service_voucher);
        $admin->givePermissionTo($refund_health_prescription);
        $admin->givePermissionTo($view_revenue);

        $view_booking = Permission::create(['guard_name' => 'admin','name' => 'Xem danh sách đặt lịch']);
        $approve_booking = Permission::create(['guard_name' => 'admin','name' => 'Duyệt lịch']);
        $cancel_appointment_booking = Permission::create(['guard_name' => 'admin','name' => 'Huỷ lịch']);

        $admin->givePermissionTo($view_booking);
        $admin->givePermissionTo($approve_booking);
        $admin->givePermissionTo($cancel_appointment_booking);


        $view_appointment_paper = Permission::create(['guard_name' => 'admin','name' => 'Xem danh sách giấy hẹn tái khám']);
        $view_detail_appointment_paper = Permission::create(['guard_name' => 'admin','name' => 'Xem thông tin giấy hẹn tái khám']);
        $create_appointment_paper = Permission::create(['guard_name' => 'admin','name' => 'Thêm giấy hẹn tái khám']);
        $edit_appointment_paper = Permission::create(['guard_name' => 'admin','name' => 'Chỉnh sửa giấy hẹn tái khám']);
        $delete_appointment_paper = Permission::create(['guard_name' => 'admin','name' => 'Xóa giấy hẹn tái khám']);
        $print_appointment_paper = Permission::create(['guard_name' => 'admin','name' => 'In giấy hẹn tái khám']);

        $admin->givePermissionTo($view_appointment_paper);
        $admin->givePermissionTo($view_detail_appointment_paper);
        $admin->givePermissionTo($create_appointment_paper);
        $admin->givePermissionTo($edit_appointment_paper);
        $admin->givePermissionTo($delete_appointment_paper);
        $admin->givePermissionTo($print_appointment_paper);
    }
}
