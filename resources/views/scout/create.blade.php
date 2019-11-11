<?php use \App\JobSeeker; ?>
<?php use \App\User; ?>
<head>
	<title>{{ config('app.name', 'Gee') }}</title>
	<link rel="stylesheet" href="{{ asset('css/header.css') }}">
	<link rel="stylesheet" href="{{ asset('css/scout/job_seeker.css') }}">
	<link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
	@include('layouts.header', ['user' => $user])
	<div class="common-detail">
		<p>{{User::find(JobSeeker::find($job_seeker_id)->user_id)->name}}さんへ</p>
		<form action="/scout" method="POST">
			@csrf
			<input name="job_seeker_id" type="hidden" value="{{$job_seeker_id}}"/>
			@error('contents')
			<div class="alert alert-danger">{{ $message }}</div>
			@enderror
			<p><textarea class="scout-create-contents" cols="100" name="contents" rows="30" placeholder="スカウト文"></textarea></p>
			<p><input class="radius-submit" type="submit" value="送信"/></p>
		</form>
	</div>
</body>
