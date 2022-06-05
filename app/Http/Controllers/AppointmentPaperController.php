<?php

namespace App\Http\Controllers;

use App\Models\AppointmentPaper;
use App\Models\HealthCertification;
use Illuminate\Http\Request;
use DB;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\StoreAppointmentPaperRequest;

class AppointmentPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $appointment_papers = AppointmentPaper::query();

        if ($request->search) {
            $appointment_papers = $appointment_papers->whereHas('healthCertification.patient', function (Builder $query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%');
            });
        }
        $appointment_papers = $appointment_papers->orderBy('id', 'desc')->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'appointment_papers' => $appointment_papers
        ];

        return view('appointment-paper.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $health_certification = HealthCertification::findOrFail($request->health_certification_id);
        
        $data = [
            'request' => $request,
            'health_certification' => $health_certification,
        ];

        return view('appointment-paper.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentPaperRequest $request)
    {
        try {
            DB::beginTransaction();

            $create = AppointmentPaper::create([
                'date' => date("Y-m-d", strtotime($request->date)),
                'title' => $request->title,
                'health_certification_id' => $request->health_certification_id,
            ]);
            
            DB::commit();
            return redirect()->route('appointment_papers.index')->with('alert-success','Thêm giấy hẹn khám bệnh thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm giấy hẹn khám bệnh thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppointmentPaper  $appointmentPaper
     * @return \Illuminate\Http\Response
     */
    public function show(AppointmentPaper $appointmentPaper)
    {
        $data = [
            'data_edit' => $appointmentPaper,
        ];

        return view('appointment-paper.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppointmentPaper  $appointmentPaper
     * @return \Illuminate\Http\Response
     */
    public function edit(AppointmentPaper $appointmentPaper)
    {
        $data = [
            'data_edit' => $appointmentPaper,
        ];

        return view('appointment-paper.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AppointmentPaper  $appointmentPaper
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAppointmentPaperRequest $request, AppointmentPaper $appointmentPaper)
    {
        try {
            DB::beginTransaction();
            
            $appointmentPaper->update([
                'date' => date("Y-m-d", strtotime($request->date)),
                'title' => $request->title,
            ]);
            
            DB::commit();
            return redirect()->route('appointment_papers.index')->with('alert-success','Cập nhật giấy hẹn khám bệnh thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Cập nhật giấy hẹn khám bệnh thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppointmentPaper  $appointmentPaper
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppointmentPaper $appointmentPaper)
    {
        try {
            DB::beginTransaction();

            AppointmentPaper::destroy($appointmentPaper->id);
            
            DB::commit();
            return redirect()->route('appointment_papers.index')->with('alert-success','Xóa giấy hẹn khám bệnh thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa giấy hẹn khám bệnh thất bại!');
        }
    }

    public function print(AppointmentPaper $appointmentPaper)
    {
        $data = [
            'data_edit' => $appointmentPaper,
        ];

        return view('appointment-paper.print', $data);
    }
}
