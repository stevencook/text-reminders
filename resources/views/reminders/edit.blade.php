@extends('spark::layouts.app')

@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href="{{ asset('/css/jquery-ui-timepicker-addon.css') }}" rel="stylesheet">
<script src="{{ asset('/js/jquery-ui-timepicker-addon.js') }}"></script>
<script>
	jQuery( document ).ready(function( $ ) {
		// $("#reminder-date").datepicker();

		$('#reminder-date').datetimepicker({
			timeFormat: 'hh:mm tt'
		});
	});
</script>
@endsection

@section('content')
<!-- Main Content -->
<div class="container spark-screen">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Reminder</div>

				<div class="panel-body">

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" id="create-reminder-form">
						<input type="hidden" name="_method" value="PATCH">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Date</label>
							<div class="col-md-6">
								<input type="text" id="reminder-date" class="form-control" name="date" value="{{ Formatter::dateDatabaseToWeb(Formatter::formValue('date', $reminder->fires_at)) }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Message</label>
							<div class="col-md-6">
								<textarea type="text" class="form-control" name="message">{{ Formatter::formValue('message', $reminder->message) }}</textarea>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-6 col-sm-offset-4">
								<button type="submit" class="btn btn-primary">
									Update
								</button>

								<a href="{{ action('ReminderController@index') }}" class="btn btn-default">
									Back to Reminders
								</a>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>

</div>
@endsection
