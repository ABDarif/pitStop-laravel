<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function admin_index()
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        return view('admin.index', [
            'appointments' => Appointment::all()
        ]);
    }

    public function admin_edit(Appointment $appointment)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        $count_M1 = DB::selectOne("SELECT COUNT(*) as count FROM appointments WHERE mechanic='John Doe'")->count;
        $count_M2 = DB::selectOne("SELECT COUNT(*) as count FROM appointments WHERE mechanic='Jane Smith'")->count;
        $count_M3 = DB::selectOne("SELECT COUNT(*) as count FROM appointments WHERE mechanic='Mike Brown'")->count;
        $count_M4 = DB::selectOne("SELECT COUNT(*) as count FROM appointments WHERE mechanic='Emily Davis'")->count;
        $count_M5 = DB::selectOne("SELECT COUNT(*) as count FROM appointments WHERE mechanic='Chris Wilson'")->count;

        return view('admin.edit', compact(['count_M1', 'count_M2', 'count_M3', 'count_M4', 'count_M5']), ['appointment' => $appointment]);
    }

    public function admin_update(Appointment $appointment)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }
        // authorize (on hold...)

        request()->validate([
            'appointment_date' => 'required|date|after:tomorrow',
            'mechanic' => ['required']
        ]);

        $appointment->update([
            'appointment_date'=>request('appointment_date'),
            'mechanic'=>request('mechanic')
        ]);

    return redirect('/admin');
    }

    public function admin_delete(Appointment $appointment)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }
        // authorize (on hold...)

        $appointment->delete();
        return redirect('/admin');
    }

    public function mechanic_index()
    {
        return view('mechanic.index', [
            'appointments' => Appointment::all()
        ]);
    }

    public function user_create()
    {
        return view('user.create');
        // $selectedDate = request()->datePicker;
        // $data = [$selectedDate];
        // return response()->json($data);

        // $count_M1 = DB::selectOne("SELECT COUNT(*) as count FROM appointments WHERE mechanic='John Doe'")->count;
        // $count_M2 = DB::selectOne("SELECT COUNT(*) as count FROM appointments WHERE mechanic='Jane Smith'")->count;
        // $count_M3 = DB::selectOne("SELECT COUNT(*) as count FROM appointments WHERE mechanic='Mike Brown'")->count;
        // $count_M4 = DB::selectOne("SELECT COUNT(*) as count FROM appointments WHERE mechanic='Emily Davis'")->count;
        // $count_M5 = DB::selectOne("SELECT COUNT(*) as count FROM appointments WHERE mechanic='Chris Wilson'")->count;

        // return view('user.create', compact(['count_M1', 'count_M2', 'count_M3', 'count_M4', 'count_M5']));
    }

    public function user_index()
    {
        return view('user.index');
    }

    public function user_store()
    {
        request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'digits:11'],
            'address' => ['required'],
            'car_license' => ['required', 'digits:6'],
            'car_engine' => ['required', 'digits:6'],
            'appointment_date' => 'required|date|after:tomorrow',
            'mechanic' => ['required']
        ]);

        $appointment = Appointment::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'address' => request('address'),
            'car_license' => request('car_license'),
            'car_engine' => request('car_engine'),
            'appointment_date' => request('appointment_date'),
            'mechanic' => request('mechanic')
        ]);

        Mail::to($appointment->email)->send(
            new \App\Mail\AppointmentPosted($appointment)
        );

        return redirect('/index');
    }
    public function getMechanicAvailability(Request $request)
    {
        $validated = $request->validate([
            'selected_date' => 'required|date'
        ]);

        $date = Carbon::parse($validated['selected_date'])->format('Y-m-d');

        $mechanics = [
            'John Doe',
            'Jane Smith',
            'Mike Brown',
            'Emily Davis',
            'Chris Wilson'
        ];

        $availability = [];

        foreach ($mechanics as $mechanic) {
            $count = DB::table('appointments')
                ->where('mechanic', $mechanic)
                ->whereDate('appointment_date', $date)
                ->count();

            $availability[$mechanic] = 4 - $count; // Assuming 4 is max slots per day
        }

        return response()->json([
            'availability' => $availability,
            'selected_date' => $validated['selected_date']
        ]);
    }
}
