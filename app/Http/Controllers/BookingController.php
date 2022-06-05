<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bookings = Booking::query();

        if ($request->search) {
            $bookings = $bookings->where('phone', 'like', '%'.$request->search.'%');
        }
        $bookings = $bookings->orderBy('id', 'desc')->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'bookings' => $bookings
        ];

        return view('booking.index', $data);
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
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function approveBooking($id)
    {
        try {
            DB::beginTransaction();
            
            Booking::find($id)->update([
                'status' => 1,
            ]);

            DB::commit();
            return redirect()->back()->with('alert-success','Duyệt lịch thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Duyệt lịch thất bại!');
        }
    }

    public function cancelAppointment($id)
    {
        try {
            DB::beginTransaction();
            
            Booking::find($id)->update([
                'status' => -1,
            ]);

            DB::commit();
            return redirect()->back()->with('alert-success','Huỷ lịch thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Huỷ lịch thất bại!');
        }
    }
}
