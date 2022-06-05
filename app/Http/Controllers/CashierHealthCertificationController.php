<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\HealthCertification;

class CashierHealthCertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $health_certifications = HealthCertification::query();

        if ($request->search) {
            $health_certifications = $health_certifications->whereHas('patient', function (Builder $query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%');
            });
        }
        $health_certifications = $health_certifications->orderBy('id', 'desc')->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'health_certifications' => $health_certifications
        ];

        return view('cashier.health-certification.index', $data);
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

    public function confirmPayment(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            
            HealthCertification::findOrFail($id)->update([
                'payment_status' => 1,
                'date_payment' => date('Y-m-d'),
            ]);
            
            DB::commit();
            return redirect()->route('cashier_health_certifications.index')->with('alert-success','Xác nhận thanh toán thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xác nhận thanh toán thất bại!');
        }
    }

    public function refund(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            
            HealthCertification::findOrFail($id)->update([
                'payment_status' => 2,
            ]);
            
            DB::commit();
            return redirect()->route('cashier_health_certifications.index')->with('alert-success','Hoàn tiền thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Hoàn tiền thất bại!');
        }
    }
}
