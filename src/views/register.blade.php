@extends('site.site')

@section('title','Impulse Commerce - Sign up')

@section('head')
	@parent
	<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading clearfix" style="background-color:inherit; border:none;">
					<div class="clearfix" style="position:relative">
						<h1 style="margin-bottom:0px">Sign up</h1>
						<a class="hidden-xs" style="position:absolute;right:0px;bottom:0px;" href="#">Sign up with your Google account</a>
						<a class="visible-xs" style="margin-top:10px" href="#">Sign up with your Google account</a>
					</div>
					<hr style="margin-top:10px;margin-bottom:10px"/>
				</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ route('account.signup') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">First name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="firstName" value="{{ old('firstName') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Last name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="lastName" value="{{ old('lastName') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Email</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-offset-4 col-md-6">
								<div class="g-recaptcha" data-sitekey="6LdnegoTAAAAABD5tKTrOLRlS6xibVMN_u9HdccC"></div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-offset-4 col-md-6">
								By clicking you agree to our <a href="#">privacy policy</a> and <a href="#">customer agreement</a>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Sign up
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
