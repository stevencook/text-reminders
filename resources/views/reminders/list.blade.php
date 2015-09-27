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
					<div class="panel-heading">Your Reminders</div>

					<div class="panel-body">
						<h2>You have {{ $reminderCount }} reminders</h2>
						<ul>
							@foreach ($reminders as $reminder)
								<li>{{ $reminder->message }}</li>
								<li>{{ $reminder->fires_at }}</li>
							@endforeach
						</ul>
						<p><a class="btn btn-primary" href="{{ action('ReminderController@create') }}">Add a reminder</a></p>
					</div>
				</div>
			</div>
		</div>

	@endif
</div>
@endsection
