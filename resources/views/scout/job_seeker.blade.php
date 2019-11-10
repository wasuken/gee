<?php use \App\User; ?>
<?php use \App\Corp; ?>
<head>
	<title>{{ config('app.name', 'Gee') }}</title>
	<link rel="stylesheet" href="{{ asset('css/header.css') }}">
	<link rel="stylesheet" href="{{ asset('css/scout/job_seeker.css') }}">
</head>
<body>
	@include('layouts.header', ['user' => $user])
	@foreach($scouts as $scout)
		<div class="scout">
			<p>企業名:{{User::find(Corp::find($scout->corp_id)->user_id)->name}}</p>
			<p>スカウト文:{{$scout->contents}}</p>
		</div>
	@endforeach
</body>
