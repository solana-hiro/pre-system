<header class="header">
  <div class="text_wrapper">@yield('page_title')</div>
  <div class="frame">
    <div class="div">{{ date("Y年m月d日") }}</div>
    <div class="frame-2">
      <div class="user-icon"><img class="ic-round-person" src="{{ asset('/img/icon/userIcon.svg') }}" /></div>
      <div class="div">{{ Auth::guard('user')->user()->user_name }}</div>
    </div>
    <div class="group">
      <a href="javascript:void(0);" onclick="document.getElementById('logout').submit(); return false;" class=""><div class="text_wrapper_2">ログアウト</div></a>
      <form id="logout" method="post" action="{{ route('auth.logout') }}">
        @csrf
      </form>
      <img class="icon-logout" src="{{ asset('/img/icon/logout.svg') }}" />
    </div>
  </div>
</header>
