<div>
    <div class="grid">
        <table class="table_sticky">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_20p">付箋</td>
                    <td class="grid_wrapper_center td_20p">付箋名</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll" id="order_receive_sticky_note_rec">
                @foreach ($orderReceiveStickyNoteData as $data)
                    @if ($data['def_sticky_note_kind_id'] === 1)
                        <tr data-smm-dbclick-name="{{ $data->sticky_note_name }}" data-smm-dbclick-color="{{ $data->sticky_note_color }}" data-smm-dbclick-id="{{ $data->id }}">
                            <td class="grid_wrapper_left" style="background-color:{{ $data['sticky_note_color'] }}"></td>
                            <td class="grid_wrapper_left">{{ $data['sticky_note_name'] }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
