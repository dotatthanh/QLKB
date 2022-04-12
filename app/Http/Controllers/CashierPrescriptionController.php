<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Prescription;

class CashierPrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prescriptions = Prescription::paginate(10);

        if ($request->search) {
            $prescriptions = Prescription::whereHas('patient', function (Builder $query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%');
            })->paginate(10);
            $prescriptions->appends(['search' => $request->search]);
        }

        $data = [
            'prescriptions' => $prescriptions
        ];

        return view('cashier.prescription.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function confirmPayment($id)
    {
        try {
            DB::beginTransaction();

            Prescription::find($id)->update([
                'status' => 1,
                'date_payment' => date('Y-m-d'),
            ]);
            
            DB::commit();
            return redirect()->route('cashier_prescriptions.index')->with('alert-success','Xác nhận thanh toán thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xác nhận thanh toán thất bại!');
        }
    }

    public function refund($id)
    {
        try {
            DB::beginTransaction();

            Prescription::find($id)->update([
                'status' => 2
            ]);
            
            DB::commit();
            return redirect()->route('cashier_prescriptions.index')->with('alert-success','Xác nhận thanh toán thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xác nhận thanh toán thất bại!');
        }
    }
}
