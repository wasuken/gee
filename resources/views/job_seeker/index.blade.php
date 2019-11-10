<?php use \App\User; ?>
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gee') }}</title>
	<link rel="stylesheet" href="{{ asset('css/header.css') }}">
	<link rel="stylesheet" href="{{ asset('css/job_seeker.css') }}">
</head>
<body>
	@include('layouts.header', ['user' => $user])
	<div class="main-content">
		@foreach($seeker_users as $seeker_user)
			<div class="seeker">
				<p>名前:{{$seeker_user->name}}</p>
				<p>PR:{{$seeker_user->pr}}</p>
			</div>
		@endforeach
	</div>
</body>
