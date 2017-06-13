<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DeathAppointment extends Model
{
	// Hours aviable to set Appointments
	const HOURS = ['09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00'];

	protected $fillable = ['name', 'email', 'date','time'];

	// Check if the Appointment is Available
	static function isAvailable($date,$time) {

		$appointment = self::where('date',$date)->where('time',$time)->first();

		if ($appointment) {

			return false;
		}

		return true;
	}

	// return the Vavailable Hours for a specific date
	static function getAvailableHours($date) {

		$date = Carbon::parse($date);

		if ($date->isWeekend()) {

			return [];
		}

		$availables = self::HOURS;
		$appointments = self::all()->where('date',$date->toDateString());

		foreach ($appointments as $appointment) {

			$key = array_search($appointment->time,$availables);
			unset($availables[$key]);
		}

		$availables = array_values($availables);

		return $availables;
	}
}
