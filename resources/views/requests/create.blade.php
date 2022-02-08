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
                            ثبت درخواست
							{{-- <a href="#">
								EN
							</a> --}}
						</div>
						<form action="{{ route('requests.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
							<div class="form-group">
                                @error('category')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <label for="category">
                                    دسته
                                </label>
                                <select name="category_id" id="category" class="form-control">
                                    @forelse ($categories as $key => $name)
                                        <option value="{{$key}}">{{$name}}</option>
                                    @empty
                                        <option >---</option>
                                    @endforelse
                                </select>
							</div>
							<div class="form-group">
                                @error('desc')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
								<label for="desc">
									شرح
								</label>
								<input type="text" name="desc" id="desc" value="{{ old('desc') }}" class="form-control">
							</div>
							<div class="form-group">
                                @error('amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
								<label for="amount">
									مبلغ
								</label>
								<input type="text" name="amount" id="amount" value="{{ old('amount') }}" class="form-control">
							</div>
							<div class="form-group">
                                @error('sheba')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
								<label for="sheba">
									شماره شبا
								</label>
								<input type="text" name="sheba" id="sheba" value="{{ old('sheba') }}" class="form-control">
							</div>
							<div class="form-group">
                                @error('national_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
								<label for="national_id">
									کد ملی
								</label>
								<input type="text" name="national_id" id="national_id" value="{{ old('national_id') }}" class="form-control">
							</div>
							<div class="form-group">
                                @error('file')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
								<label for="file">
									مستند
								</label>
								<input type="file" name="file" id="file" value="" class="form-control">
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
