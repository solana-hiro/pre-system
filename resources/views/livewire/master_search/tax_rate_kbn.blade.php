<div class="grid">
    <table class="table_sticky">
        <thead class="grid_header">
            <tr>
                <td class="grid_wrapper_center td_5p">税率区分コード</td>
                <td class="grid_wrapper_center td_15p">税率区分名</td>
            </tr>
        </thead>
        <tbody class="tbody_scroll" id="tax_rate_rec">
            @foreach ($taxRateKbnData as $data)
                <tr data-smm-dbclick="{{ $data->tax_rate_kbn_cd }}">
                    <td class="grid_wrapper_left">{{ $data['tax_rate_kbn_cd'] }}</td>
                    <td class="grid_wrapper_left">{{ $data['tax_rate_kbn_name'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
