<?php

namespace App\Http\Controllers;

use App\DeathAppointment;
use Illuminate\Http\Request;

class DeathAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = deathAppointment::all();

        return response($appointments,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'date' => 'required|date_format:Y-m-d|after:today',
                'time' => 'required|date_format:H:i'
            ]);

            $name = $request->name;
            $email = $request->email;
            $date = $request->date;
            $time = $request->time;

            if (!(deathAppointment::isAvailable($date,$time))) {

                return response("Duplicate",400);
            }

            DeathAppointment::create([
                'name' => $name,
                'email' => $email,
                'date' => $date,
                'time' => $time
            ]);

            return response("Created",200);

        } catch (Exception $e) {

            return response("error",500);
        }

    }

    public function availables(Request $request) {

        try {

            $this->validate($request, [
                'date' => 'required|date_format:Y-m-d|after:today'
            ]);

            $date = $request->date;
            $availables = DeathAppointment::getAvailableHours($date);

            return response($availables,200);

        } catch (Exception $e) {

            return response($e->getMEssage(),500);
        }

    }
}
