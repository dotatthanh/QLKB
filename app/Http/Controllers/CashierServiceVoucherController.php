<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ServiceVoucher;

class CashierServiceVoucherController extends Controller
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

        return view('cashier.service-voucher.index', $data);
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
            
            ServiceVoucher::findOrFail($id)->update([
                'payment_status' => 1,
                'date_payment' => date('Y-m-d'),
            ]);
            
            DB::commit();
            return redirect()->route('cashier_service_vouchers.index')->with('alert-success','X??c nh???n thanh to??n th??nh c??ng!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','X??c nh???n thanh to??n th???t b???i!');
        }
    }

    public function refund(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            
            ServiceVoucher::findOrFail($id)->update([
                'payment_status' => 2,
            ]);
            
            DB::commit();
            return redirect()->route('cashier_service_vouchers.index')->with('alert-success','X??c nh???n thanh to??n th??nh c??ng!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','X??c nh???n thanh to??n th???t b???i!');
        }
    }
}
