<!DOCTYPE html>
<html lang="fa-IR" dir="rtl">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>
		ایجاد درخواست
	</title>
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" type="text/css" media="all" />
	<link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css') }}" type="text/css" media="all" />
	<link rel="stylesheet" href="{{ asset('css/mmenu.css') }}" type="text/css" media="all" />
	<link rel="stylesheet" href="{{ asset('css/style.css') }}" media="all" />
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
</head>

<body>
	<div id="login-page">
		<div class="container">
			<div class="row">
				<div class="panel login-panel col-xs-10 col-sm-6 col-md-5 col-lg-4">
					<div class="panel-body">
						<div class="logo">
                            رد درخواست
							{{-- <a href="#">
								EN
							</a> --}}
						</div>
						<form action="{{ route('requests.reject', ['request' => $financialRequest]) }}" method="post">
                            @csrf
							<div class="form-group">
                                @error('reason')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
								<label for="reason">
									شرح
								</label>
								<input type="text" name="reason" id="reason" value="{{ old('reason') }}" class="form-control">
							</div>
							<button type="submit" class="btn btn-blue" name="login-button">
								ثبت اطلاعات
							</button>
							<a href="{{ route('requests.index') }}" class="btn btn-red">
								برگشت
							</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script type="text/javascript" src="./include/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./include/js/mmenu.js"></script>
	<script type="text/javascript" src="./include/js/script.js"></script>
</body>

</html>
