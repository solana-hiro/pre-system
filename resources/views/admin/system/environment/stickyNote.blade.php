@extends('layouts.admin.app')
@section('page_title', '受付付箋マスタ')
@section('title', '受付付箋マスタ')
@section('description', '')
@section('keywords', '')
@section('canonical', '')

@section('content')
	<form role="search" action="{{ route('system.environment.sticky_note.update') }}" method="post" name="mtStickNoteIndexForm">
	    @csrf		<div class="main-area">
			<div class="button_area">
				<div class="div">
					<button type="button" data-toggle="modal" data-target="#modal_cancel" data-value="" class="button" data-url="" name="cancel2"><div class="text_wrapper">キャンセル</div></button>
                    <!--
                    <button type="button" data-toggle="modal" data-target="#modal_color" data-value="" class="button" data-url="" name="change"><div class="text_wrapper">色変更</div></button>
					-->
                    <button type="button" data-toggle="modal" data-target="#modal_confirm" data-value="" class="button-2" data-url="" name="update2"><div class="text_wrapper_3">登録する</div></button>
                </div>
            </div>
	    	<div class="box">
				<div class="group">
					<div class="element">
						<div class="text_wrapper">付箋種別</div>
						<div class="frame">
							<div class="div">
								<label class="text_wrapper_2">
									<input type="radio" id="def_sticky_note_kind_id_1" onclick="stickyNoteIdIndexClick()" name="def_sticky_note_kind_id" value="1"  @if(old('def_sticky_note_kind_id') === '1' || empty(old('def_sticky_note_kind_id'))) checked @endif />
									得意先特記事項用
								</label>
							</div>
							<div class="div">
								<label class="text_wrapper_2">
									<input type="radio" id="def_sticky_note_kind_id_2" onclick="stickyNoteIdIndexClick()" name="def_sticky_note_kind_id" value="2" @if(old('def_sticky_note_kind_id') === '2') checked @endif />
									受注伝票ヘッダ用
								</label>
							</div>
							<div class="div">
								<label class="text_wrapper_2">
									<input type="radio" id="def_sticky_note_kind_id_3" onclick="stickyNoteIdIndexClick()" name="def_sticky_note_kind_id" value="3" @if(old('def_sticky_note_kind_id') === '3') checked @endif />
									受注伝票明細用
								</label>
							</div>
						</div>
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
			<div class="sub_contents">
				@if(old('def_sticky_note_kind_id') !== '2' && old('def_sticky_note_kind_id') !== '3')
				    <div class="left_contents" id="right_content_1">
                @else
                    <div class="left_contents display_none_all" id="right_content_1">
                @endif
					<div class="grid">
						<table class="table_sticky" id="grid_table_1">
							<thead class="grid_header">
								<tr>
									<td class="grid_wrapper_center td_200px">付箋</td>
									<td class="grid_wrapper_center td_300px">付箋名</td>
								</tr>
							</thead>
							<tbody class="tbody_scroll">
                                @php $i=0; @endphp
								@foreach($initData as $data)
                                    @if($data['def_sticky_note_kind_id'] === 1 && ($data["branch_number"] !== 0))
                                        <tr style="background-color: #ffffff;">
                                            <td class="grid_wrapper_center col_rec"><input type="color" placeholder="" name="update_color1[]" class="" minlength="0" maxlength="7" value="{{ $data['sticky_note_color'] }}" style="width:80%; padding:0; margin: 6px;"></td>
                                            <td class="grid_wrapper_left col_rec"><input type="text" placeholder="" name="update_note_name1[]" class="grid_textbox" minlength="0"  maxlength="20" value="{{ $data['sticky_note_name'] }}"></td>
                                            <input type="hidden" name="update_id1[]" value="{{ $data['id'] }}" />
                                        </tr>
                                    @endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
            @if(old('def_sticky_note_kind_id') === '2')
                <div class="left_contents display_none_all" id="right_content_2">
            @else
                <div class="left_contents display_none_all" id="right_content_2" display="style: none;">
            @endif
                <div class="grid">
						<table class="table_sticky" id="grid_table_2">
							<thead class="grid_header">
								<tr>
									<td class="grid_wrapper_center td_200px">付箋</td>
									<td class="grid_wrapper_center td_300px">付箋名</td>
								</tr>
							</thead>
							<tbody class="tbody_scroll">
                                @php $i=0; @endphp
								@foreach($initData as $data)
                                    @if($data['def_sticky_note_kind_id'] === 2 && ($data["branch_number"] !== 0))
                                        <tr style="background-color: #ffffff;">
                                            <td class="grid_wrapper_center col_rec"><input type="color" placeholder="" name="update_color2[]" class="" minlength="0" maxlength="7" value="{{ $data['sticky_note_color'] }}" style="width:80%; padding:0; margin: 6px;"></td>
                                            <td class="grid_wrapper_left col_rec"><input type="text" placeholder="" name="update_note_name2[]" class="grid_textbox" minlength="0"  maxlength="20" value="{{ $data['sticky_note_name'] }}"></td>
                                            <input type="hidden" name="update_id2[]" value="{{ $data['id'] }}" />
                                        </tr>
                                    @endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
            @if(old('def_sticky_note_kind_id') === '3')
                <div class="left_contents display_none_all" id="right_content_3">
            @else
                <div class="left_contents display_none_all" id="right_content_3" style="display: none;">
            @endif
					<div class="grid">
						<table class="table_sticky" id="grid_table_1">
							<thead class="grid_header">
								<tr>
									<td class="grid_wrapper_center td_200px">付箋</td>
									<td class="grid_wrapper_center td_300px">付箋名</td>
								</tr>
							</thead>
							<tbody class="tbody_scroll">
                                @php $i=0; @endphp
								@foreach($initData as $data)
                                    @if($data['def_sticky_note_kind_id'] === 3 && ($data["branch_number"] !== 0))
                                        <tr style="background-color: #ffffff;">
                                            <td class="grid_wrapper_center col_rec"><input type="color" placeholder="" name="update_color3[]" class="" minlength="0" maxlength="7" value="{{ $data['sticky_note_color'] }}" style="width:80%; padding:0; margin: 6px;"></td>
                                            <td class="grid_wrapper_left col_rec"><input type="text" placeholder="" name="update_note_name3[]" class="grid_textbox" minlength="0"  maxlength="20" value="{{ $data['sticky_note_name'] }}"></td>
                                            <input type="hidden" name="update_id3[]" value="{{ $data['id'] }}" />
                                        </tr>
                                    @endif
								@endforeach
							</tbody>
						</table>
					</div>
                </div>
			</div>
		</div>
        <button type="submit" id="cancel" name="cancel" class="display_none_all"></button>
        <button type="submit" id="update" name="update" class="display_none_all"></button>
        <button type="submit" id="delete" name="delete" class="display_none_all" value=""></button>
    </form>
@endsection
