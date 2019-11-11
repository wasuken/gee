<head>
	<title>{{ config('app.name', 'Gee') }}</title>
	<link rel="stylesheet" href="{{ asset('css/header.css') }}">
	<link rel="stylesheet" href="{{ asset('css/job_offer.css') }}">
	<link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
	@include('layouts.header', ['user' => $user])
	<div class="common-detail">
		<h2>求人作成</h2>
		<form action="/job_offer" method="POST">
			@csrf
			@error('title')
			<div class="alert alert-danger">{{ $message }}</div>
			@enderror
			<p><input class="common-input-text" name="title" type="text" value="" placeholder="タイトル" /></p>
			@error('presentation_annual_income')
			<div class="alert alert-danger">{{ $message }}</div>
			@enderror
			<p><input class="common-input-text" name="presentation_annual_income" type="text" value="" placeholder="年収" /></p>
			@error('work_location')
			<div class="alert alert-danger">{{ $message }}</div>
			@enderror
			<p><input class="common-input-text" name="work_location" type="text" value="" placeholder="勤務地" /></p>
			@error('occupation')
			<div class="alert alert-danger">{{ $message }}</div>
			@enderror
			<p><input class="common-input-text" name="occupation" type="text" value="" placeholder="職種" /></p>
			@error('contents')
			<div class="alert alert-danger">{{ $message }}</div>
			@enderror
			<p><textarea class="job-offer-contents" cols="100" id="contents" name="contents" rows="30" placeholder="求人内容"></textarea></p>
			<p><input class="radius-submit" type="submit" value="求人作成"/></p>
		</form>
	</div>
</body>
