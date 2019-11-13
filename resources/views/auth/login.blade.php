<?php use \App\User; ?>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gee') }}</title>
	<link rel="stylesheet" href="{{ asset('css/header.css') }}">
	<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
	<link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
	@include('layouts.header', ['user' => null])
	<div class="login-form">
		<div class="login-form-window">
			<form action="/login" method="POST">
				@csrf
				<table>
					<tr>
						<th>email</th>
						<td>
							<input class="common-input-text" name="email" type="email" value="" required="required" />
						</td>
					</tr>
					<tr>
						<th>password</th>
						<td>
							<input class="common-input-text" name="password" type="password" value="" required="required" />
						</td>
					</tr>
				</table>
				<p>
					<a href="{{ route('password.request') }}">
						{{ __('Forgot Your Password?') }}
					</a>
				</p>
				<p>
					<input class="radius-submit" type="submit" value="login"/>
				</p>
			</form>
		</div>
	</div>
</body>
