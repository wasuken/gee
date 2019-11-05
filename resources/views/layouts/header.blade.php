<header>
	<!-- 左(アプリタイトル等) -->
	<div class="header-left">
		<a href="/">Gee</a>
	</div>
	<!-- 真ん中(検索ボックス) -->
	<div class="header-center">
		<form action="/job_offer" method="GET">
			@csrf
			<input name="occupation" type="text" placeholder="職種" />
			<input name="work_location" type="text" placeholder="勤務地" />
			<input name="keyword" type="text" placeholder="キーワード" />
			<input name="sbm" type="submit" value="検索"/>
		</form>
	</div>
	<!-- 右(アカウント系) -->
	<div class="header-right">
		<a href="/job_application">応募一覧</a>
		<!-- プロファイルページへ飛ばす -->
		<div class="header-right-profile">{{ $name }}</div>
		<div class="header-right-logout">
			<form action="/logout" method="POST">
				@csrf
				<input name="logout" type="submit" value="ログアウト"/>
			</form>
		</div>
	</div>
</header>
