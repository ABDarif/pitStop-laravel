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
        if (Auth::check() && Auth::user()->type=='admin') {
            return view('admin.index', [
                'appointments' => DB::table('appointments')->simplePaginate(5)
            ]);
        }
        return redirect('/login');
    }

    public function admin_edit(Appointment $appointment)
    {
        if (Auth::check() && Auth::user()->type=='admin') {
            return view('admin.edit', ['appointment' => $appointment]);
        }
        return redirect('/login');
    }

    public function admin_update(Appointment $appointment)
    {
        if (Auth::check() && Auth::user()->type=='admin') {
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
        return redirect('/login');
    }

    public function admin_delete(Appointment $appointment)
    {
        if (Auth::check() && Auth::user()->type=='admin') {
            $appointment->delete();
            return redirect('/admin');
        }
        return redirect('/login');
    }

    public function mechanic_index()
    {
        if (Auth::check() && Auth::user()->type=='mechanic') {
            // Retrieve the currently authenticated user...
            $user = Auth::user();

            return view('mechanic.index', [
                'appointments' => Appointment::all(), 'user' => $user
            ]);
        }
        return redirect('/login');
    }

    public function user_create()
    {
        if (Auth::check() && Auth::user()->type=='client') {
            return view('user.create');
        }
        return redirect('/login');
    }

    public function user_index()
    {
        if (Auth::check() && Auth::user()->type=='client') {
            // Retrieve the currently authenticated user...
            $user = Auth::user();

            return view('user.index', [
                'appointments' => Appointment::all(), 'user' => $user
            ]);
        }
        return redirect('/login');
    }

    public function user_store()
    {
        request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'digits:11'],
            'address' => ['required'],
            'car_license' => ['required', 'digits:6', 'unique:appointments,car_license'],
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
    public function user_edit(Appointment $appointment)
    {
        if (Auth::check() && Auth::user()->type=='client') {
            return view('user.edit', ['appointment' => $appointment]);
        }
        return redirect('/login');
    }

    public function user_update(Appointment $appointment)
    {
        if (Auth::check() && Auth::user()->type=='client') {
            request()->validate([
                'appointment_date' => 'required|date|after:tomorrow',
                'mechanic' => ['required']
            ]);

            $appointment->update([
                'appointment_date'=>request('appointment_date'),
                'mechanic'=>request('mechanic')
            ]);

            return redirect('/index');
        }
        return redirect('/login');
    }

    public function user_delete(Appointment $appointment)
    {
        if (Auth::check() && Auth::user()->type=='client') {
            $appointment->delete();
            return redirect('/index');
        }
        return redirect('/login');
    }

    public function getMechanicAvailability()
    {
        $validated = request()->validate([
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

            $availability[$mechanic] = 4 - $count;
        }

        return response()->json([
            'availability' => $availability,
            'selected_date' => $validated['selected_date']
        ]);
    }
}
