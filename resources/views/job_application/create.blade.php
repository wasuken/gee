<?php use \App\Corp; ?>
<?php use \App\User; ?>
<head>
	<title>{{ config('app.name', 'Gee') }}</title>
	<link rel="stylesheet" href="{{ asset('css/header.css') }}">
	<link rel="stylesheet" href="{{ asset('css/job_application.css') }}">
	<link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
	@include('layouts.header', ['user' => $user])
	<div>
		<h2>{{$app->title}}に応募しますか？</h2>
		<form action="/job_application" method="POST">
			<input name="job_offer_id" type="hidden" value="{{$job_offer_id}}"/>
			<input type="submit" value="応募する"/>
		</form>
	</div>
</body>
