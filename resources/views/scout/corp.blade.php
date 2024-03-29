<?php use \App\User; ?>
<?php use \App\JobSeeker; ?>
<head>
	<title>{{ config('app.name', 'Gee') }}</title>
	<link rel="stylesheet" href="{{ asset('css/header.css') }}">
	<link rel="stylesheet" href="{{ asset('css/scout/corp.css') }}">
	<link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
	@include('layouts.header', ['user' => $user])
	@foreach($scouts as $scout)
		<div class="common-detail">
			<p>ユーザ名:{{User::find(JobSeeker::find($scout->job_seeker_id)->user_id)->name}}</p>
			<p>スカウト文:{{$scout->contents}}</p>
		</div>
	@endforeach
</body>
