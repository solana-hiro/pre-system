@extends('layouts.admin.app')
@section('page_title', '納品先入力（一覧）')
@section('title', '納品先入力（一覧）')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<form role="search" action="{{ route('master.delivery.mt_delivery_destinations.update') }}" method="post">
	    @csrf
		<div class="main-area">
			<div class="button_area">
				<div class="div">
                    <button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button" data-url="" name="cancel2"><div class="text_wrapper">キャンセル</div></button>
					<button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2" data-url="" name="update2"><div class="text_wrapper_3">登録する</div></button>
				</div>
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
            @elseif (Session::has('errormessage'))
                @include('components.modal.error', ['errormessage' => session('errormessage') ])
            @endif
            <div class="alert alert-danger">
                <ul id="alert-danger-ul">
            </div>
			<div class="sub_contents" style="min-width: 100%; max-width: 100%">
				<div class="left_contents" style="min-width: 50%; max-width: 50%">
					<div class="grid_gray" style="min-width: 100%; max-width: 100%">
						<table class="grid_gray_table_100p" id="grid_table">
							<thead class="grid_gray_header">
								<tr>
									<td class="grid_wrapper_center td_20p">納品先コード</td>
									<td class="grid_wrapper_center td_60p">納品先名</td>
									<td class="grid_wrapper_center td_20p">削除区分</td>
								</tr>
							</thead>
							<tbody class="grid_body">
                                @empty(old("insert_code"))
                                    @for($i=0; $i<2; $i++)
                                        <tr>
                                            <td class="grid_wrapper_left"><input type="number" name="insert_code[]" id="insert_delivery_code" onblur="eventBlurCodeautoDelivery(arguments[0], this)" placeholder="" class="grid_textbox number_6" data-limit-len="6" data-limit-minus></td>
                                            <td class="grid_wrapper_left"><input type="text" name="insert_name[]" placeholder="" class="grid_textbox" minlength="0" maxlength="60"></td>
                                            <td class="grid_wrapper_left"><input type="text" name="insert_flg[]" placeholder="" class="grid_textbox" minlength="0" maxlength="1"></td>
                                        </tr>
                                    @endfor
                                @else
                                    @for($i = 0; $i < count(old('insert_code')); $i++)
                                        <tr>
                                            <td class="grid_wrapper_left"><input type="number" name="insert_code[]" id="insert_delivery_code" onblur="eventBlurCodeautoDelivery(arguments[0], this)" placeholder="" value='{{ old("insert_code.{$i}") }}' class="grid_textbox number_6" data-limit-len="6" data-limit-minus></td>
                                            <td class="grid_wrapper_left"><input type="text" name="insert_name[]" placeholder="" value='{{ old("insert_name.{$i}") }}' class="grid_textbox" minlength="0" maxlength="60"></td>
                                            <td class="grid_wrapper_left"><input type="text" name="insert_flg[]" placeholder="" value='{{ old("insert_flg.{$i}") }}' class="grid_textbox" minlength="0" maxlength="1"></td>
                                        </tr>
                                    @endfor
                                @endempty
							</tbody>
						</table>
						<div class="plus_rec">
							<div class="blue_text_wrapper" id="add_line" onclick="deliveryDestiationAddLine()">+ 行を追加する</div>
						</div>
					</div>
				</div>
				<livewire:master_list.delivery_destination />
			</div>
		</div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
        <button type="submit" id="transition" name="transition" class="display_none_all" value=""></button>
        @include('components.menu.selected', ['view' => 'main'])
	</form>
	@include('admin.master.search.delivery_destination')
    <script src="{{ asset('js/master/delivery/mt_delivery_destinations/index.js') }}"></script>
@endsection
