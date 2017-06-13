@extends('layouts.master')

@section('content')

	<div id="vue-app" class="container">
		<!-- jumbotron -->
		<div class="jumbotron jumbotron-fluid">

			<!-- container -->
			<div class="container">
			    <h1 class="text-center display-4">Dancing With Death Appointment</h1>
			    <p class="text-center lead">Select your special date to dance with the death</p>
			</div>
			<!-- /container -->
			<!-- container -->
			<div v-if="scheduled" class="container">
				<div class="container">
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<button @click="scheduled = false" type="button" class="close" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<strong>Your appointment has been scheduled!</strong> Are you ready to dance with Death?.
					</div>
				</div>
			</div>
			<!-- /container -->
			<!-- container -->
			<div class="container">

				<div class="form-group row ">
					<label class="col-2 col-form-label">Name:</label>
					<div class="col-3">
						<input class="form-control" type="text" name="name" v-model="name">
					</div>

					<label class="col-1 col-form-label">Email:</label>
					<div class="col-3">
						<input class="form-control" type="email" name="email" v-model="email">
					</div>
				</div>

				<div class="form-group row ">
					<label class="col-2 col-form-label">Select Date:</label>
					<div class="col-3">
						<input class="form-control" type="date" v-model="date" @change="getAvailableHours">
					</div>

					<label class="col-1 col-form-label">Hour:</label>
					<div class="col-2">
						<input class="form-control" type="text" v-model="hour" disabled>
					</div>

					<div class="col-2">
						<button :disabled="(hour && name && email && date) ? false : true" type="submit" class="btn btn-primary" @click="storeAppointment">Schedule</button>
					</div>
				</div>

			</div>
			<!-- /container -->
			<!-- card -->
			<div class="card">
				<div class="card-block">

					<h6 class="text-center card-title">Select available hours to schedule an appointment</h6>

					<table class="table table-hover table-sm table-bordered">
						<thead class="thead-inverse">
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Available Hours</th>
							</tr>
						</thead>
						<tbody>
							<td colspan="7" class="text-center" v-if="availablesHours <= 0">Not hours available...</td>
							<a href="#">
								<tr v-for="(hour,key) in availablesHours" @click="loadHour(hour)">
									<th class="text-center">@{{key+1}}</th>
									<th class="text-center">@{{hour}}</th>
								</tr>
							</a>
						</tbody>
					</table>

				</div>
			</div>
			<!-- /card -->
		</div>
		<!-- jumbotron -->
	</div>

@endsection
