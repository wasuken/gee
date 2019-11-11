<?php use \App\User; ?>
<?php use \App\Corp; ?>
<?php use \App\JobSeeker; ?>
<head>
	<title>{{ config('app.name', 'Gee') }}</title>
	<link rel="stylesheet" href="{{ asset('css/header.css') }}">
	<link rel="stylesheet" href="{{ asset('css/job_offer.css') }}">
	<link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
	@include('layouts.header', ['user' => $user])
	<div>
		@foreach($offers as $offer)
			<div class="common-detail">
				<table class="common-table">
					<tbody>
						<tr>
							<th>会社名</th>
							<td>{{ User::find(Corp::find($offer->corp_id)->user_id)->name }}</td>
						</tr>
						<tr>
							<th>求人タイトル</th>
							<td>{{ $offer->title }}</td>
						</tr>
						<tr>
							<th>年収</th>
							<td>{{ number_format($offer->presentation_annual_income) }}円</td>
						</tr>
						<tr>
							<th>勤務地</th>
							<td>{{ $offer->work_location }}</td>
						</tr>
						<tr>
							<th>職種</th>
							<td>{{ $offer->occupation }}</td>
						</tr>
						<tr>
							<th>求人内容</th>
							<td>{{ $offer->contents }}</td>
						</tr>
					</tbody>
				</table>
				@if(JobSeeker::all()->where('user_id', $user->id)->first() !== null)
					<form action="/job_application" method="POST">
						@csrf
						<input name="job_offer_id" type="hidden" value="{{$offer->id}}"/>
						<input class="radius-submit" type="submit" value="応募する" />
				</form>
				@endif
			</div>
		@endforeach
	</div>
</body>
