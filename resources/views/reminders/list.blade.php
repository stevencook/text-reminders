@extends('spark::layouts.app')

@section('content')
<!-- Main Content -->
<div class="container spark-screen">
	@if (Spark::usingTeams() && ! Auth::user()->hasTeams())

		<!-- Teams Are Enabled, But The User Doesn't Have One -->
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">You Need A Team!</div>

					<div class="panel-body bg-warning">
						It looks like you haven't created a team!
						You can create one in your <a href="/settings?tab=teams">account settings</a>.
					</div>
				</div>
			</div>
		</div>

	@else

		<!-- Teams Are Disabled Or User Is On Team -->
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">{{ $reminderString }}</div>

					<div class="panel-body">
						@if ($reminderCount > 0)
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Time and Date</th>
										<th>Message</th>
										<th>Status</th>
										<th> </th>
										<th> </th>
									</tr>
								</thead>
								<tbody>
									@foreach ($reminders as $reminder)
										<tr>
											<td>{!! Formatter::dateDatabaseToWebPretty($reminder->fires_at) !!}</td>
											<td>{{ $reminder->message }}</td>
											<td>
												@if ($reminder->fired_at)
													Sent
												@else
													Waiting
												@endif
											</td>
											<td><a href="{{ action('ReminderController@edit', [$reminder->id]) }}" class="btn btn-primary">Edit</a></td>
											<td>
												<form class="form-horizontal" role="form" method="POST" action="{{ action('ReminderController@destroy', [$reminder->id ]) }}">
													<input type="hidden" name="_method" value="DELETE">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">

													<button type="submit" class="btn btn-danger" data-confirm="Are you sure you want to delete '{{{ $reminder->message }}}'?">
														Delete
													</button>
												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						@endif
						<p><a class="btn btn-primary" href="{{ action('ReminderController@create') }}">Add a reminder</a></p>
					</div>
				</div>
			</div>
		</div>

	@endif
</div>
@endsection
