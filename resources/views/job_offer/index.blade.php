<?php use \App\User; ?>
<?php use \App\Corp; ?>
<head>
	<title>Gee</title>
	<link rel="stylesheet" href="{{ asset('css/header.css') }}">
	<link rel="stylesheet" href="{{ asset('css/job_offer.css') }}">
</head>
<body>
	@include('layouts.header', ['user' => $user])
	<div class="main-content">
		@foreach($offers as $offer)
			<div class="offer">
				<h3>会社名:{{ User::find(Corp::find($offer->corp_id)->user_id)->name }}</h3>
				<p>求人タイトル:{{$offer->title}}</p>
				<p>年収:{{ $offer->presentation_annual_income }}</p>
				<p>勤務地:{{ $offer->work_location }}</p>
				<p>職種:{{ $offer->occupation }}</p>
				<p>求人内容:{{ $offer->contents }}</p>
				<form action="/job_application" method="POST">
					@csrf
					<input name="job_offer_id" type="hidden" value="{{$offer->id}}"/>
					<input type="submit" value="応募する" />
				</form>
			</div>
		@endforeach
	</div>
</body>
