<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\HealthCertification;
use App\Models\ServiceVoucher;
use App\Models\Prescription;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $today = date('Y-m-d');

        $total_revenue_health_cerrtification = HealthCertification::whereDate('date_payment', $today)->where('payment_status', 1)->sum('total_money');
        $total_revenue_service_voucher = ServiceVoucher::whereDate('date_payment', $today)->where('payment_status', 1)->sum('total_money');
        $total_revenue_prescription = Prescription::whereDate('date_payment', $today)->where('status', 1)->sum('total_money');

        if (isset($request->from_date)) {
            // dd(date('Y-m-d', strtotime(($request->from_date))));
            $total_revenue_health_cerrtification = HealthCertification::where('date_payment', '>=', date('Y-m-d', strtotime(($request->from_date))))->where('payment_status', 1)->sum('total_money');
            $total_revenue_service_voucher = ServiceVoucher::where('date_payment', '>=', date('Y-m-d', strtotime(($request->from_date))))->where('payment_status', 1)->sum('total_money');
            $total_revenue_prescription = Prescription::where('date_payment', '>=', date('Y-m-d', strtotime(($request->from_date))))->where('status', 1)->sum('total_money');
        }

        if (isset($request->to_date)) {
            $total_revenue_health_cerrtification = HealthCertification::where('date_payment', '<=', date('Y-m-d', strtotime(($request->to_date))))->where('payment_status', 1)->sum('total_money');
            $total_revenue_service_voucher = ServiceVoucher::where('date_payment', '<=', date('Y-m-d', strtotime(($request->to_date))))->where('payment_status', 1)->sum('total_money');
            $total_revenue_prescription = Prescription::where('date_payment', '<=', date('Y-m-d', strtotime(($request->to_date))))->where('status', 1)->sum('total_money');
        }

        if (isset($request->from_date) && isset($request->to_date)) {
            $total_revenue_health_cerrtification = HealthCertification::whereBetween('date_payment', [date('Y-m-d', strtotime(($request->from_date))), date('Y-m-d', strtotime(($request->to_date)))])->where('payment_status', 1)->sum('total_money');
            $total_revenue_service_voucher = ServiceVoucher::whereBetween('date_payment', [date('Y-m-d', strtotime(($request->from_date))), date('Y-m-d', strtotime(($request->to_date)))])->where('payment_status', 1)->sum('total_money');
            $total_revenue_prescription = Prescription::whereBetween('date_payment', [date('Y-m-d', strtotime(($request->from_date))), date('Y-m-d', strtotime(($request->to_date)))])->where('status', 1)->sum('total_money');
        }

        $total_revenue = $total_revenue_health_cerrtification + $total_revenue_service_voucher + $total_revenue_prescription;

        $data = [
            'total_revenue_health_cerrtification' => $total_revenue_health_cerrtification,
            'total_revenue_service_voucher' => $total_revenue_service_voucher,
            'total_revenue_prescription' => $total_revenue_prescription,
            'total_revenue' => $total_revenue,
        ];

        return view('cashier.revenue.index', $data);
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
}
