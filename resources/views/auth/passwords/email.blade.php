<?php use \App\User; ?>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gee') }}</title>
	<link rel="stylesheet" href="{{ asset('css/header.css') }}">
	<link rel="stylesheet" href="{{ asset('css/auth/email.css') }}">
	<link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
	@include('layouts.header', ['user' => null])
	<div class="email-reset-form">
		<div class="email-reset-form-window">
			@if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

			<form method="POST" action="{{ route('password.email') }}">
				@csrf

				<table>
					<tr>
						<th></th>
						<td>{{ __('Reset Password') }}</td>
					</tr>
					<tr>
						<th></th>
						<td>
							<input placeholfer="email" id="email" type="email" class="common-input-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

									   @error('email')
									   <span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
                                    </span>
									@enderror
						</td>
					</tr>
					<tr>
						<th>

						</th>
						<td>

						</td>
					</tr>
					<tr>
						<th>

						</th>
						<td>
							<button type="submit" class="radius-submit-var-width">
                                {{ __('Send Password Reset Link') }}
                            </button>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>

</body>
