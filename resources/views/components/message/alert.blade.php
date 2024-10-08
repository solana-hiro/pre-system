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
    @include('components.modal.message', ['flashmessage' => session('flashmessage')])
@elseif (Session::has('errormessage'))
    @include('components.modal.error', ['errormessage' => session('errormessage')])
@endif
<div class="alert alert-danger">
    <ul id="alert-danger-ul">
</div>
