<!DOCTYPE html>
<html lang="ja">
	<head>
	    <meta charset="UTF-8">
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <meta http-equiv="Content-Script-Type" content="text/javascript">
	    <meta http-equiv="Content-Style-Type" content="text/css">
	    <title>@yield('title')</title>
	    <meta name="description" content="@yield('description')">
	    <meta name="keywords" content="@yield('keywords')">
	    <link rel="canonical" href="@yield('canonical')">
	    <link rel="stylesheet" href="{{ asset('/css/auth/globals.css') }}" >
	    <link rel="stylesheet" href="{{ asset('/css/auth/styleguide.css') }}" >
	    <link rel="stylesheet" href="{{ asset('/css/auth/style.css') }}" >
	</head>
	<body>
	  <div class="screen">
	    <div class="main_area">
	    	@yield('content')
	    </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
      <script src="{{ asset('/js/main.js') }}"></script>
	  <script src="{{ asset('/js/modal.js') }}"></script>
      <script src="{{ asset('js/common_modal.js') }}"></script>
	</body>
</html>
