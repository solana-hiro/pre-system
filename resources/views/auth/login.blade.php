<!DOCTYPE html>
<html lang="ja">
	<head>
	    <link rel="preconnect" href="https://dev.visualwebsiteoptimizer.com"/>
	    <meta charset="UTF-8">
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <meta http-equiv="Content-Script-Type" content="text/javascript">
	    <meta http-equiv="Content-Style-Type" content="text/css">
	    <link rel="stylesheet" href="{{ asset('/css/globals.css') }}" >
	    <link rel="stylesheet" href="{{ asset('/css/auth/styleguide.css') }}" >
	    <link rel="stylesheet" href="{{ asset('/css/auth/style.css') }}" >
	</head>
	<body>
		<div class="screen">
			<div class="group-wrapper">
				<div class="group">
					<form id="login" method="POST" action="{{ route('auth.login') }}" class="form">
						@csrf
						<img class="wundou" src="{{ asset('/img/logo/wundou-1.svg') }}" />
						<div class="text-wrapper-memo">ユーザーIDとパスワードを入力してください。</div>
						<div class="screen screen-columns">
							<div class="text_wrapper">ユーザーID</div>
							<div class="frame">
								<input type="text" name="user_cd" class="element" placeholder="ユーザーID" value="{{ old('user_cd') }}">
							</div>
						</div>
						<div class="screen screen-columns">
							<div class="text_wrapper">パスワード</div>
							<div class="frame">
								<input type="password" name="password" class="element" placeholder="パスワード" value="{{ old('password') }}">
							</div>
						</div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif (Session::has('sessionErrors'))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach (session('sessionErrors') as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @elseif (Session::has('flashmessage'))
                            @include('components.modal.message', ['flashmessage' => session('flashmessage') ])
                        @endif
						<button type="submit" class="component text-wrapper-2">ログイン</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
