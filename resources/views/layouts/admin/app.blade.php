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
    <link rel="stylesheet" href="{{ asset('/css/admin/globals.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/styleguide.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/accordion.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css">
    <!-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> -->
    <script src="https://postcode-jp.com/js/postcodejp.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              border: '#D4DDE1',
              required: '#165C9D',
              baseText: '#2D3842',
              tableBorder: '#D0DFE4',
              mainBg: '#FFFFCC',
              active: '#1483F8',
              tableHeaderBg: '#3A5A9B'
            }
          }
        }
      }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="module" src="{{ asset('js/modules/load.js') }}"></script>
    @section('blade_script')
    @show
</head>

<body>
    <div class="screen" id="screen">
        <div class="main_area">
            @include('layouts.admin.menu')
            <div class="main_content" id="main_content">
                @include('layouts.admin.header')
                @include('components.modal.cancel')
                @include('components.modal.delete')
                @include('components.modal.confirm')
                @include('components.modal.transitionConfirm')
                @include('components.modal.passwordReset')
                @include('components.modal.subDelete')
                @include('components.modal.fileImportConfirm1')
                @include('components.modal.fileImportConfirm2')
                @include('components.modal.fileImportConfirm3')
                @include('components.modal.fileImportConfirm4')
                @include('components.modal.fileImportConfirm5')
                @include('components.modal.executeConfirm')
                @include('components.modal.removeConfirm')
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('js/common_modal.js') }}"></script>
    <script src="{{ asset('js/vendor/axios/min.js') }}"></script>
    <script src="{{ asset('js/vendor/lodash/core.min.js') }}"></script>
</body>

</html>
