@extends('spark::layouts.app')

@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
	jQuery( document ).ready(function( $ ) {
		$("#reminder-date").datepicker();
	});
</script>
@endsection

@section('content')
<!-- Main Content -->
<div class="container spark-screen">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Create a Reminder</div>

				<div class="panel-body">
					<spark-errors form="@{{ registerForm }}"></spark-errors>

					<form class="form-horizontal" role="form" id="create-reminder-form">

						<div class="form-group">
							<label class="col-md-4 control-label">Date</label>
							<div class="col-md-6">
								<input type="text" id="reminder-date" class="form-control spark-first-field" name="date" v-model="registerForm.date">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Message</label>
							<div class="col-md-6">
								<textarea type="text" class="form-control spark-first-field" name="message" v-model="registerForm.message"></textarea>
							</div>
						</div>

						<div v-if="freePlanIsSelected">
							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-4">
									<button type="submit" class="btn btn-primary" v-on="click: register" v-attr="disabled: registerForm.registering">
										<span v-if="registerForm.registering">
											<i class="fa fa-btn fa-spinner fa-spin"></i> Registering
										</span>

										<span v-if=" ! registerForm.registering">
											<i class="fa fa-btn fa-check-circle"></i> Register
										</span>
									</button>
								</div>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>

</div>
@endsection
