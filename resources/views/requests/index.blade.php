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
				<div class="panel login-panel ">
					<div class="panel-body">
						<div class="logo">
                            لیست درخواست ها
							<a href="{{route('requests.create')}}">
								ایجاد
							</a>
                            ----
							<a href="{{route('requests.pay')}}">
								پرداخت گروهی
							</a>
						</div>
						<form method="post" enctype="multipart/form-data">
                            @csrf
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col"></th>
                                    <th scope="col">#</th>
                                    <th scope="col">دسته بندی</th>
                                    <th scope="col">کاربر</th>
                                    <th scope="col">شرح</th>
                                    <th scope="col">مقدار</th>
                                    <th scope="col">شبا</th>
                                    <th scope="col">پرداخت</th>
                                    <th scope="col">وضعیت</th>
                                    <th scope="col">قبول</th>
                                    <th scope="col">رد</th>
                                    <th scope="col">دانلود</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($financialRequests as $financialRequest)
                                        <tr>
                                        <th scope="row"><input type="checkbox" name="requests[{{$financialRequest->id}}]" id="{{$financialRequest->id}}"></th>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $financialRequest->category->name }}</td>
                                        <td>{{ $financialRequest->user->name }}</td>
                                        <td>{{ $financialRequest->desc }}</td>
                                        <td>{{ $financialRequest->amount }}</td>
                                        <td>{{ substr($financialRequest->sheba, 5) }}</td>
                                        <td>{{ $financialRequest->paid_at === null ? "خیر" : "بله" }}</td>
                                        <td>{{ $financialRequest->status }}</td>
                                        <td>
                                            <a href="{{ route('requests.approve', $financialRequest) }}">
                                                A
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('requests.rejection', ['request' => $financialRequest]) }}">
                                                R
                                            </a>
                                        </td>
                                        @if ($media = $financialRequest->getFirstMedia())
                                            <td>
                                                <a href="{{ route('media.download', $media) }}">
                                                    DL
                                                </a>
                                            </td>
                                        @else
                                            <td></td>
                                        @endif
                                        </tr>
                                    @empty
                                        <tr colspan=6>Nothing</tr>
                                    @endforelse
                                </tbody>
                            </table>
							<button formaction="{{ route('requests.bulk_approve') }}" type="submit" class="btn btn-blue" name="login-button">
								تایید
							</button>
							<button formaction="{{ route('requests.bulk_reject') }}" type="submit" class="btn btn-blue" name="login-button">
								رد
							</button>
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
