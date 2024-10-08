<!DOCTYPE html>
<html lang="ja">
	<head>
	    <meta charset="UTF-8">
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <meta http-equiv="Content-Script-Type" content="text/javascript">
	    <meta http-equiv="Content-Style-Type" content="text/css">
	    <title>@yield('title')</title>
	    <link rel="stylesheet" href="{{ asset('/css/common/file.css') }}" >
	</head>
	<body>
	  <div class="screen" id="screen">
	    <div class="main_area">
	    	<div class="table-wrap">
	    		@yield('content')
	    	</div>
	    </div>
      </div>
	</body>
</html>
