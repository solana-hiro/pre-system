<div class="right_contents" style="min-width: 50%; max-width: 50%">
    <div class="element-form">
        <div class="text_wrapper">納品先コード</div>
        <div class="frame">
            <div class="textbox">
                <input type="number" name="search_name" id="input_search_name" class="element input_number_6" 
                    data-limit-len="6" data-limit-minus wire:model="deliveryDestinationId" wire:blur="blur" />
                <img class="vector" id="img_search_name" src="/img/icon/vector.svg"
                    data-smm-open="search_delivery_destination_modal" />
                <input type="hidden" id="hidden_search_name" value="" name="hidden_search_name" />
            </div>
        </div>
    </div>

    @include('livewire.master_list.paginate_button', ['list' => $initData])
    <div class="grid">
        <table class="table_sticky" id="grid_table_1" style="max-width: 100%">
            <thead class="grid_header">
                <tr>
                    <td class="grid_wrapper_center td_5p">削除</td>
                    <td class="grid_wrapper_center td_15p">納品先コード</td>
                    <td class="grid_wrapper_center td_40p">納品先名</td>
                    <td class="grid_wrapper_center td_5p">削除区分</td>
                </tr>
            </thead>
            <tbody class="tbody_scroll">
                @foreach ($initData as $data)
                    <tr>
                        <td class="grid_wrapper_center col_rec"><button type="button" data-toggle="modal"
                                data-target="#modal_delete" data-value="{{ $data['id'] }}" class="display_none"
                                data-url="{{ route('master.customer.mt_customer_class.update') }}" name="delete"><img
                                    class="grid_img_center" src="{{ asset('/img/icon/trash.svg') }}"></button></td>
                        <td class="grid_wrapper_left col_rec"><a class="tr_link" data-toggle="modal"
                                data-target="#modal_transition_confirm" data-value="{{ $data['id'] }}"
                                class="display_none" name="transition">{{ $data['delivery_destination_id'] }}</a></td>
                        <td class="grid_wrapper_left col_rec"><a class="tr_link" data-toggle="modal"
                                data-target="#modal_transition_confirm" data-value="{{ $data['id'] }}"
                                class="display_none" name="transition">{{ $data['delivery_destination_name'] }}</a></td>
                        <td class="grid_wrapper_left col_rec"><a class="tr_link" data-toggle="modal"
                                data-target="#modal_transition_confirm" data-value="{{ $data['id'] }}"
                                class="display_none" name="transition">{{ $data['del_kbn_delivery_destination'] }}</a>
                        </td>
                        <input type="hidden" name="update_id[]" value="{{ $data['id'] }}" />
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
const inputBox1 = document.getElementById("input_search_name");
inputBox1.onblur = function () {
    if("" !== inputBox1.value) {
        inputBox1.value = inputBox1.value.toString().padStart(6, '0');
    }
};
</script>