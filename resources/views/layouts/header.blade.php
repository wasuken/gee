<?php use \App\JobSeeker; ?>
<?php use \App\Corp; ?>
<header>
	<!-- 左(アプリタイトル等) -->
	<div class="header-left">
		<a href="/">Gee</a>
	</div>
	<?php
	$seeker_if = JobSeeker::all()->where('user_id', $user->id)->first();
	$corp_if = Corp::all()->where('user_id', $user->id)->first();
	?>
	<!-- 真ん中(検索ボックス) -->
	<div class="header-center">
		@if($seeker_if !== null)
			<form action="/job_offer" method="GET">
				@csrf
				<input name="occupation" type="text" placeholder="職種" />
				<input name="work_location" type="text" placeholder="勤務地" />
				<input name="keyword" type="text" placeholder="キーワード" />
				<input name="sbm" type="submit" value="検索"/>
			</form>
		@elseif($corp_if !== null)
			<form action="/job_seeker" method="GET">
				@csrf
				<input name="user_name" type="text" placeholder="ユーザ名検索" />
				<input name="keyword" type="text" placeholder="キーワード" />
				<input name="sbm" type="submit" value="検索"/>
			</form>
		@endif
	</div>
	<!-- 右(アカウント系) -->
	<div class="header-right">
		@if($seeker_if !== null)
			<a href="/job_application">応募一覧</a>
		@elseif($corp_if !== null)
			<div class="header-right-create-offer">
				<a href="/job_offer/create">求人票作成</a>
			</div>
			<a href="/job_seeker">求職者一覧</a>
		@endif
		<div class="header-right-scout">
			<a href="/scout">スカウト一覧</a>
		</div>
		<!-- プロファイルページへ飛ばす -->
		<div class="header-right-profile">{{ $user->name }}</div>
		<div class="header-right-logout">
			<form action="/logout" method="POST">
				@csrf
				<input name="logout" type="submit" value="ログアウト"/>
			</form>
		</div>
	</div>
</header>
