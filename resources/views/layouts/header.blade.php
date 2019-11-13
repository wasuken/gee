<header>
	<!-- 左(アプリタイトル等) -->
	<div class="header-left">
		<a href="/">Gee</a>
	</div>
	@auth
	@include('layouts.auth_header')
	@endauth
	@guest
	@include('layouts.guest_header')
	@endguest
</header>
