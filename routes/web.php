<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ConsultingRoomController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\MedicalServiceController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\HealthInsuranceCardController;
use App\Http\Controllers\HealthCertificationController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ServiceVoucherController;
use App\Http\Controllers\ServiceVoucherDetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CashierHealthCertificationController;
use App\Http\Controllers\CashierServiceVoucherController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CashierPrescriptionController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\AppointmentPaperController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/dat-lich-kham', [WebController::class, 'bookingExamination'])->name('web.booking-examination');
Route::post('/dat-lich-kham', [WebController::class, 'booking'])->name('web.booking');


Route::middleware(['website'])->group(function () {
	Route::post('/dang-xuat', [WebController::class, 'logout'])->name('web.logout');
	Route::get('/thong-tin-ca-nhan', [WebController::class, 'profile'])->name('web.profile');
	Route::get('/cap-nhat-thong-tin-ca-nhan', [WebController::class, 'changeProfile'])->name('web.change-profile');
	Route::post('/cap-nhat-thong-tin-ca-nhan/{id}', [WebController::class, 'postChangeProfile'])->name('web.post-change-profile');
	Route::get('/doi-mat-khau', [WebController::class, 'changePassword'])->name('web.change-password');
	Route::post('/doi-mat-khau/{id}', [WebController::class, 'postChangePassword'])->name('web.post-change-password');
	Route::get('/danh-sach-don-thuoc', [WebController::class, 'prescription'])->name('web.prescription');
	Route::get('/chi-tiet-don-thuoc/{id}', [WebController::class, 'prescriptionDetail'])->name('web.prescription-detail');
	Route::get('/thong-tin-dat-lich', [WebController::class, 'infoBooking'])->name('web.info-booking');
	Route::post('/huy-lich-kham/{id}', [WebController::class, 'cancelAppointment'])->name('web.cancel-appointment');
	Route::get('/ho-so-benh-an', [WebController::class, 'medicalRecord'])->name('web.medical-record');
});

Route::middleware(['guest_website'])->group(function () {
	Route::get('/dang-nhap', [WebController::class, 'login'])->name('web.login');
	Route::post('/dang-nhap', [WebController::class, 'postLogin'])->name('web.post-login');
	Route::get('/dang-ky', [WebController::class, 'register'])->name('web.register');
	Route::post('/dang-ky', [WebController::class, 'postRegister'])->name('web.post-register');
});

// Admin
Route::prefix('admin')->group(function () {
	Route::get('/', function () {
		return redirect()->route('login');
	});
	Route::middleware(['auth'])->group(function () {
		Route::resource('appointment_papers', AppointmentPaperController::class);
		Route::get('/appointment_papers/print/{appointment_paper}', [AppointmentPaperController::class, 'print'])->name('appointment_papers.print');
		Route::resource('bookings', BookingController::class);
		Route::post('/bookings/approve-booking/{id}', [BookingController::class, 'approveBooking'])->name('bookings.approve-booking');
		Route::post('/bookings/cancel-appointment/{id}', [BookingController::class, 'cancelAppointment'])->name('bookings.cancel-appointment');


		Route::resource('medical_records', MedicalRecordController::class);
		Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
		
		Route::resource('patients', PatientController::class);
		Route::resource('cashier_health_certifications', CashierHealthCertificationController::class);
		Route::post('/cashier_health_certifications/confirm-payment/{id}', [CashierHealthCertificationController::class, 'confirmPayment'])->name('cashier_health_certifications.confirm-payment');
		Route::post('/cashier_health_certifications/refund/{id}', [CashierHealthCertificationController::class, 'refund'])->name('cashier_health_certifications.refund');
		Route::resource('cashier_service_vouchers', CashierServiceVoucherController::class);
		Route::post('/cashier_service_vouchers/confirm-payment/{id}', [CashierServiceVoucherController::class, 'confirmPayment'])->name('cashier_service_vouchers.confirm-payment');
		Route::post('/cashier_service_vouchers/refund/{id}', [CashierServiceVoucherController::class, 'refund'])->name('cashier_service_vouchers.refund');

		Route::resource('cashier_prescriptions', CashierPrescriptionController::class);
		Route::post('/cashier_prescriptions/confirm-payment/{id}', [CashierPrescriptionController::class, 'confirmPayment'])->name('cashier_prescriptions.confirm-payment');
		Route::post('/cashier_prescriptions/refund/{id}', [CashierPrescriptionController::class, 'refund'])->name('cashier_prescriptions.refund');

		Route::resource('revenues', RevenueController::class);

		Route::resource('users', UserController::class);
		Route::get('/users/view-change-password/{user}', [UserController::class, 'viewChangePassword'])->name('users.view-change-password');
		Route::post('/users/change-password/{user}', [UserController::class, 'changePassword'])->name('users.change-password');

		Route::resource('roles', RoleController::class);
		Route::resource('permissions', PermissionController::class);
		Route::resource('consulting_rooms', ConsultingRoomController::class);
		Route::resource('types', TypeController::class);
		Route::resource('medical_services', MedicalServiceController::class);
		Route::resource('medicines', MedicineController::class);

		Route::resource('health_insurance_cards', HealthInsuranceCardController::class);
		Route::post('/health_insurance_cards/{id}/get-insurance-card', [HealthInsuranceCardController::class, 'getInsuranceCard'])->name('health_insurance_cards.get-insurance-card');

		Route::resource('health_certifications', HealthCertificationController::class);
		Route::get('/health_certifications/print/{health_certification}', [HealthCertificationController::class, 'print'])->name('health_certifications.print');
		Route::get('/health_certifications/{health_certification}/conclude', [HealthCertificationController::class, 'viewConclude'])->name('health_certifications.conclude');
		Route::put('/health_certifications/{health_certification}/conclude', [HealthCertificationController::class, 'conclude'])->name('health_certifications.update-conclude');

		Route::resource('prescriptions', PrescriptionController::class);
		Route::get('/prescriptions/print/{prescription}', [PrescriptionController::class, 'print'])->name('prescriptions.print');

		Route::resource('service_vouchers', ServiceVoucherController::class);
		Route::get('/service_vouchers/print/{service_voucher}', [ServiceVoucherController::class, 'print'])->name('service_vouchers.print');
		Route::post('/service_vouchers/complete-examination/{service_voucher}', [ServiceVoucherController::class, 'completeExamination'])->name('service_vouchers.complete-examination');

		Route::resource('service_voucher_details', ServiceVoucherDetailController::class);
		Route::get('/service_voucher_details/delete/{service_voucher_detail}', [ServiceVoucherDetailController::class, 'delete'])->name('service_voucher_details.delete');
	});
	require __DIR__.'/auth.php';
});

