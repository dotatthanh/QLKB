<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMedicineRequest;
use DB;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $medicines = Medicine::query();

        if ($request->search) {
            $medicines = $medicines->where('name', 'like', '%'.$request->search.'%');
        }
        $medicines = $medicines->orderBy('name')->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'medicines' => $medicines
        ];

        return view('medicine.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        $data = [
            'types' => $types,
        ];

        return view('medicine.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMedicineRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $create = Medicine::create([
                'code' => '',
                'name' => $request->name,
                'price' => $request->price,
                'type_id' => $request->type_id,
                'unit' => $request->unit,
                'description' => $request->description,
                'amount' => $request->amount,
            ]);

            $create->update([
                'code' => 'T'.str_pad($create->id, 6, '0', STR_PAD_LEFT)
            ]);
            
            DB::commit();
            return redirect()->route('medicines.index')->with('alert-success','Thêm thuốc thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Thêm thuốc thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        $types = Type::all();

        $data = [
            'data_edit' => $medicine,
            'types' => $types
        ];

        return view('medicine.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMedicineRequest $request, Medicine $medicine)
    {
        try {
            DB::beginTransaction();
            
            $medicine->update([
                'name' => $request->name,
                'price' => $request->price,
                'type_id' => $request->type_id,
                'unit' => $request->unit,
                'description' => $request->description,
                'amount' => $request->amount,
            ]);
            
            DB::commit();
            return redirect()->route('medicines.index')->with('alert-success','Sửa thuốc thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Sửa thuốc thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        try {
            DB::beginTransaction();

            if ($medicine->prescriptionDetails->count() > 0) {
                return redirect()->back()->with('alert-error','Xóa thuốc thất bại! Thuốc '.$medicine->name.' đang có trong chi tiết đơn thuốc.');
            }

            Medicine::destroy($medicine->id);
            
            DB::commit();
            return redirect()->route('medicines.index')->with('alert-success','Xóa thuốc thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Xóa thuốc thất bại!');
        }
    }
}
