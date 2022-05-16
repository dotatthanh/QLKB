<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WebLoginRequest;
use Auth;
use DB;
use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\BookingRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Prescription;
use App\Models\Booking;
use App\Models\ConsultingRoom;
use App\Models\HealthCertification;
use App\Models\User;

class WebController extends Controller
{
    public function index()
    {
        $doctors = User::role("Bác sĩ")->get();

        $data = [
            'doctors' => $doctors,
        ];

    	return view('web.index', $data);
    }

    public function login()
    {
    	return view('web.login');
    }

    public function postLogin(WebLoginRequest $request) {
        $data = $request->all();
        if (Auth::guard('web')->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ])) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('alert-error', 'Sai email hoặc mật khẩu. Vui lòng thử lại!');
        }
    }

    public function logout()
    {
    	Auth::guard('web')->logout();
        return redirect()->route('home');
    }

    public function register()
    {
    	return view('web.register');
    }

    public function postRegister(StorePatientRequest $request)
    {
        try {
            DB::beginTransaction();

            $file_path = '';
            if ($request->file('avatar')) {
                $name = time().'_'.$request->avatar->getClientOriginalName();
                $file_path = 'uploads/avatar/patient/'.$name;
                Storage::disk('public_uploads')->putFileAs('avatar/patient', $request->avatar, $name);
            }

            $create = Patient::create([
                'code' => '',
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'birthday' => date("Y-m-d", strtotime($request->birthday)),
                'phone' => $request->phone,
                'address' => $request->address,
                'avatar' => $file_path,
                'password' => Hash::make($request->password),
            ]);

            $create->update([
                'code' => 'BN'.str_pad($create->id, 6, '0', STR_PAD_LEFT)
            ]);
            
            DB::commit();
            return redirect()->route('web.login')->with('alert-success','Đăng ký thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Đăng ký thất bại!');
        }
    }

    public function profile() {
        return view('web.profile');
    }

    public function changeProfile() {
        return view('web.change-profile');
    }

    public function postChangeProfile(UpdateProfileRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $patient = Patient::find($id);

            $file_path = '';
            if ($request->file('avatar')) {
                $name = time().'_'.$request->avatar->getClientOriginalName();
                $file_path = 'uploads/avatar/patient/'.$name;
                Storage::disk('public_uploads')->putFileAs('avatar/patient', $request->avatar, $name);
            }
            
            $patient->update([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'birthday' => date("Y-m-d", strtotime($request->birthday)),
                'phone' => $request->phone,
                'address' => $request->address,
                'avatar' => $file_path,
            ]);
            
            DB::commit();
            return redirect()->route('web.profile')->with('alert-success','Cập nhật thông tin thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Cập nhật thông tin thất bại!');
        }
    }

    public function changePassword() 
    {
        return view('web.change-password');
    }

    public function postChangePassword(ChangePasswordRequest $request, $id) 
    {
        try {
            DB::beginTransaction();
            
            $patient = Patient::find($id);
            if (Hash::check($request->password_old, $patient->password)) {
                $patient->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            DB::commit();
        	return redirect()->route('home')->with('alert-success','Đổi mật khẩu thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Đổi mật khẩu thất bại!');
        }
    }

    public function prescription()
    {
        $prescriptions = Prescription::where('patient_id', auth()->guard('web')->user()->id)->paginate(10);

        $data = [
            'prescriptions' => $prescriptions
        ];

        return view('web.prescription', $data);
    }

    public function prescriptionDetail($id)
    {
        $prescription = Prescription::find($id);

        $data = [
            'prescription' => $prescription
        ];

        return view('web.prescription-detail', $data);
    }

    public function bookingExamination()
    {
        $consulting_rooms = ConsultingRoom::all();

        $data = [
            'consulting_rooms' => $consulting_rooms,
        ];

        return view('web.booking-examination', $data);
    }

    public function booking(BookingRequest $request)
    {
        try {
            DB::beginTransaction();
            
            $user = auth()->guard('web')->user();
            $patient_id = $user ? $user->id : NULL;

            Booking::create([
                'status' => 0,
                'patient_id' => $patient_id,
                'consulting_room_id' => $request->consulting_room_id,
                'email' => $request->email,
                'phone' => $request->phone,
                'name' => $request->name,
                'content' => $request->content,
                'time' => date("H:i:s", strtotime($request->time)),
                'date' => date("Y-m-d", strtotime($request->date)),
            ]);

            DB::commit();
            return redirect()->route('home')->with('alert-success','Đặt lịch khám thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Đặt lịch khám thất bại!');
        }
    }

    public function infoBooking()
    {
        $bookings = Booking::where('patient_id', auth()->guard('web')->user()->id)->get();

        $data = [
            'bookings' => $bookings,
        ];

        return view('web.info-booking', $data);
    }

    public function cancelAppointment($id)
    {
        try {
            DB::beginTransaction();
            
            Booking::find($id)->update([
                'status' => -1,
            ]);

            DB::commit();
            return redirect()->back()->with('alert-success','Huỷ lịch khám thành công!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('alert-error','Huỷ lịch khám thất bại!');
        }
    }

    public function medicalRecord()
    {
        $health_certifications = HealthCertification::where('patient_id', auth()->guard('web')->user()->id)->get();

        $data = [
            'health_certifications' => $health_certifications,
        ];

        return view('web.medical-record', $data);
    }
}
