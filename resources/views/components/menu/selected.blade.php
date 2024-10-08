<div id="{{ $view === 'sidemenu' ? 'selected-menu-for-sidemenu' : 'selected-menu-for-main' }}" class="hidden">
    @foreach (session('selected_def1') ?? [] as $def1)
        <input type="hidden" name="selected_def1[]" value="{{ $def1 }}">
    @endforeach
    @foreach (session('selected_def2') ?? [] as $def2)
        <input type="hidden" name="selected_def2[]" value="{{ $def2 }}">
    @endforeach
</div>
