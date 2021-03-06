<?php

namespace App\Http\Controllers;

use App\Models\HealthCertification;
use App\Models\Prescription;
use App\Models\PrescriptionDetail;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePrescriptionRequest;
use DB;
use Illuminate\Database\Eloquent\Builder;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prescriptions = Prescription::query();

        if ($request->search) {
            $prescriptions = $prescriptions->whereHas('patient', function (Builder $query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%');
            });
        }
        $prescriptions = $prescriptions->orderBy('id', 'desc')->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'prescriptions' => $prescriptions
        ];

        return view('prescription.index', $data);
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
        $medicines = Medicine::all();

        $data = [
            'medicines' => $medicines,
            'patients' => $patients,
            'users' => $users,
            'request' => $request,
        ];
        
        if ($request->health_certification_id) {
            $health_certification = HealthCertification::findOrFail($request->health_certification_id);
            $data['health_certification'] = $health_certification;
        }

        return view('prescription.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrescriptionRequest $request)
    {
        try {
            DB::beginTransaction();

            $create_precription = Prescription::create([
                'code' => '',
                'patient_id' => $request->patient_id,
                'user_id' => $request->user_id,
                'total_money' => 0,
                'status' => 0,
                'health_certification_id' => $request->health_certification_id,
            ]);

            $total_money = 0;
            foreach($request->prescription_details as $prescription_detail) {
                $medicine = Medicine::findOrFail($prescription_detail['medicine_id']);
                
                if ($prescription_detail['amount'] > $medicine->amount) {
                    return redirect()->back()->with('alert-error','Thêm đơn thuốc thất bại! Thuốc '.$medicine->name.' chỉ còn lại '.$medicine->amount.' '.$medicine->unit);
                }
                else {
                    $total = $medicine->price * $prescription_detail['amount'];
                    $total_money += $total;

                    PrescriptionDetail::create([
                        'prescription_id' => $create_precription->id,
                        'medicine_id' => $prescription_detail['medicine_id'],
                        'amount' => $prescription_detail['amount'],
                        'price' => $medicine->price,
                        'total_money' => $total,
                        'use' => $prescription_detail['use'],
                    ]);

                    $medicine->update(['amount' => $medicine->amount - $prescription_detail['amount']]);
                }
            }

            $create_precription->update([
                'code' => 'DT'.str_pad($create_precription->id, 6, '0', STR_PAD_LEFT),
                'total_money' => $total_money,
            ]);

            
            DB::commit();

            if ($request->health_certification_id) {
                return redirect()->route('health_certifications.index')->with('alert-success','Thêm đơn thuốc thành công!');
            }

            return redirect()->route('prescriptions.index')->with('alert-success','Thêm đơn thuốc thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm đơn thuốc thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(Prescription $prescription)
    {
        $data = [
            'prescription' => $prescription,
        ];

        return view('prescription.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function edit(Prescription $prescription)
    {
        $patients = Patient::all();
        $users = User::role('Bác sĩ')->get();
        $medicines = Medicine::all();

        $data = [
            'medicines' => $medicines,
            'patients' => $patients,
            'users' => $users,
            'data_edit' => $prescription,
        ];

        return view('prescription.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(StorePrescriptionRequest $request, Prescription $prescription)
    {

        try {
            DB::beginTransaction();
            // update SL thuốc trước khi xoá
            foreach($prescription->prescriptionDetails as $prescription_detail) {
                $medicine = Medicine::findOrFail($prescription_detail['medicine_id']);
                $medicine->update(['amount' => $medicine->amount + $prescription_detail['amount']]);
            }
            $prescription->prescriptionDetails()->delete();

            $total_money = 0;
            foreach($request->prescription_details as $prescription_detail) {
                $medicine = Medicine::findOrFail($prescription_detail['medicine_id']);
                
                if ($prescription_detail['amount'] > $medicine->amount) {
                    return redirect()->back()->with('alert-error','Thêm đơn thuốc thất bại! Thuốc '.$medicine->name.' chỉ còn lại '.$medicine->amount.' '.$medicine->unit);
                }
                else {
                    $total = $medicine->price * $prescription_detail['amount'];
                    $total_money += $total;

                    PrescriptionDetail::create([
                        'prescription_id' => $prescription->id,
                        'medicine_id' => $prescription_detail['medicine_id'],
                        'amount' => $prescription_detail['amount'],
                        'price' => $medicine->price,
                        'total_money' => $total,
                        'use' => $prescription_detail['use'],
                    ]);

                    $medicine->update(['amount' => $medicine->amount - $prescription_detail['amount']]);
                }
            }

            $prescription->update([
                'user_id' => $request->user_id,
                'patient_id' => $request->patient_id,
                'total_money' => $total_money,
            ]);

            
            DB::commit();
            return redirect()->route('prescriptions.index')->with('alert-success','Cập nhật đơn thuốc thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Cập nhật đơn thuốc thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prescription $prescription)
    {
        try {
            DB::beginTransaction();

            Prescription::destroy($prescription->id);

            foreach($prescription->prescriptionDetails as $prescription_detail) {
                $medicine = Medicine::findOrFail($prescription_detail['medicine_id']);
                $medicine->update(['amount' => $medicine->amount + $prescription_detail['amount']]);
            }
            $prescription->prescriptionDetails()->delete();
            
            DB::commit();
            return redirect()->route('prescriptions.index')->with('alert-success','Xóa đơn thuốc thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa đơn thuốc thất bại!');
        }
    }

    public function print(Prescription $prescription)
    {
        $data = [
            'prescription' => $prescription,
        ];

        return view('prescription.print', $data);
    }
}
