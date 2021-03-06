<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use App\Models\MedicalService;
use App\Models\ServiceVoucher;
use App\Models\HealthCertification;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServiceVoucherRequest;
use DB;
use Illuminate\Database\Eloquent\Builder;

class ServiceVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $service_vouchers = ServiceVoucher::query();

        if ($request->search) {
            $service_vouchers = $service_vouchers->whereHas('patient', function (Builder $query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%');
            });
        }
        $service_vouchers = $service_vouchers->orderBy('id', 'desc')->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'service_vouchers' => $service_vouchers
        ];

        return view('service-voucher.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $patients = Patient::all();
        $users = User::role('Bác sĩ')->get();
        $medical_services = MedicalService::all();

        $data = [
            'medical_services' => $medical_services,
            'patients' => $patients,
            'users' => $users,
            'request' => $request,
        ];

        return view('service-voucher.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceVoucherRequest $request)
    {
        try {
            DB::beginTransaction();
            $health_certification_id = $request->health_certification_id ? $request->health_certification_id : null;

            $medical_service = MedicalService::findOrFail($request->medical_service_id);

            $create = ServiceVoucher::create([
                'code' => '',
                'patient_id' => $request->patient_id,
                'medical_service_id' => $request->medical_service_id,
                'user_id' => $request->user_id,
                'start_date' => date("Y-m-d", strtotime($request->start_date)),
                // 'end_date' => date("Y-m-d", strtotime($request->end_date)),
                'total_money' => $medical_service->price,
                'status' => 0,
                'health_certification_id' => $health_certification_id,
            ]);

            $create->update([
                'code' => 'PDV'.str_pad($create->id, 6, '0', STR_PAD_LEFT)
            ]);
            
            DB::commit();
            return redirect()->route('service_vouchers.index')->with('alert-success','Thêm phiếu dịch vụ thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm phiếu dịch vụ thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceVoucher  $serviceVoucher
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceVoucher $serviceVoucher)
    {
        $patients = Patient::all();
        $users = User::role('Bác sĩ')->get();
        $medical_services = MedicalService::all();

        $data = [
            'medical_services' => $medical_services,
            'patients' => $patients,
            'users' => $users,
            'data_edit' => $serviceVoucher,
        ];

        return view('service-voucher.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceVoucher  $serviceVoucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ServiceVoucher $serviceVoucher)
    {
        $patients = Patient::all();
        $users = User::role('Bác sĩ')->get();
        $medical_services = MedicalService::all();

        $data = [
            'medical_services' => $medical_services,
            'patients' => $patients,
            'users' => $users,
            'data_edit' => $serviceVoucher,
            'request' => $request,
        ];

        return view('service-voucher.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceVoucher  $serviceVoucher
     * @return \Illuminate\Http\Response
     */
    public function update(StoreServiceVoucherRequest $request, ServiceVoucher $serviceVoucher)
    {
        try {
            DB::beginTransaction();

            $medical_service = MedicalService::findOrFail($request->medical_service_id);

            $serviceVoucher->update([
                'patient_id' => $request->patient_id,
                'medical_service_id' => $request->medical_service_id,
                'user_id' => $request->user_id,
                'start_date' => date("Y-m-d", strtotime($request->start_date)),
                // 'end_date' => date("Y-m-d", strtotime($request->end_date)),
                'total_money' => $medical_service->price,
            ]);

            DB::commit();
            return redirect()->route('service_vouchers.index')->with('alert-success','Cập nhật phiếu dịch vụ thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Cập nhật phiếu dịch vụ thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceVoucher  $serviceVoucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceVoucher $serviceVoucher)
    {
        try {
            DB::beginTransaction();

            ServiceVoucher::destroy($serviceVoucher->id);

            $serviceVoucher->serviceVoucherDetails()->delete();
            
            DB::commit();
            return redirect()->route('service_vouchers.index')->with('alert-success','Xóa phiếu dịch vụ thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa phiếu dịch vụ thất bại!');
        }
    }

    public function completeExamination(ServiceVoucher $serviceVoucher)
    {
        try {
            DB::beginTransaction();

            if (!$serviceVoucher->serviceVoucherDetails->count()) {
                return redirect()->back()->with('alert-error','Xác nhận hoàn thành khám thất bại! Phiếu dịch vụ chưa kết luận khám!');
            }

            $serviceVoucher->update([
                'status' => 1,
            ]);
            
            DB::commit();
            return redirect()->route('service_vouchers.index')->with('alert-success','Xác nhận hoàn thành khám thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xác nhận hoàn thành khám thất bại!');
        }
    }

    public function print(ServiceVoucher $serviceVoucher)
    {
        $patients = Patient::all();
        $users = User::role('Bác sĩ')->get();
        $medical_services = MedicalService::all();

        $data = [
            'medical_services' => $medical_services,
            'patients' => $patients,
            'users' => $users,
            'data_edit' => $serviceVoucher,
        ];

        return view('service-voucher.print', $data);
    }
}
