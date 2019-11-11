<?php use \App\JobOffer; ?>
<head>
	<title>{{ config('app.name', 'Gee') }}</title>
	<link rel="stylesheet" href="{{ asset('css/header.css') }}">
	<link rel="stylesheet" href="{{ asset('css/job_application.css') }}">
	<link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
	@include('layouts.header', ['user' => $user])
	<div>
		<h2>応募済み一覧</h2>
		@foreach($apps as $app)
			<div class="common-detail">
				{{JobOffer::find($app->job_offer_id)->title}}
				<form action="/job_application" method="POST">
					@csrf
					<input type="hidden" name="_method" value="DELETE">
					<input name="id" type="hidden" value="{{$app->id}}"/>
					<input class="radius-submit" type="submit" value="申し込み削除"/>
				</form>
			</div>
		@endforeach
	</div>
</body>
