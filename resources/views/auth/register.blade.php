<?php use \App\User; ?>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gee') }}</title>
	<link rel="stylesheet" href="{{ asset('css/header.css') }}">
	<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
	<link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
	@include('layouts.header', ['user' => null])
	<div class="register-form">
		<div class="register-form-window">
			<form method="POST" action="{{ route('register') }}">
				@csrf
				<table>
					<tr>
						<th>{{ __('name') }}</th>
						<td>
							<input id="name" type="text" class="common-input-text @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
									   @error('name')
									   <span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
                                    </span>
									@enderror

						</td>
					</tr>
					<tr>
						<th>{{ __('email') }}</th>
						<td>
							<input id="email" type="email" class="common-input-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

									   @error('email')
									   <span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
									   </span>
									   @enderror
						</td>
					</tr>
					<tr>
						<th>{{ __('password') }}</th>
						<td>
							<input id="password" type="password" class="common-input-text @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

									   @error('password')
									   <span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
									   </span>
									   @enderror
						</td>
					</tr>
					<tr>
						<th>{{ __('password_confirm') }}</th>
						<td>
							<input id="password-confirm" type="password" class="common-input-text" name="password_confirmation" required autocomplete="new-password">
						</td>
					</tr>
					<tr>
						<th>{{ __('pr') }}</th>
						<td>
							<textarea class="common-detail" cols="50" id="pr" name="pr" rows="10"></textarea>
							@error('pr')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</td>
					</tr>
					<tr>
						<th>{{ __('user type') }}</th>
						<td>
							<input type="radio" name="user-type" value="0">job offer
							<input type="radio" name="user-type" value="1" checked>corp
							@error('user-type')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</td>
					</tr>
				</table>
				<button type="submit" class="radius-submit" >
					{{ __('register') }}
				</button>
			</form>
		</div>
	</div>

</body>
