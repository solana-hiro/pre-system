<div class="modal-box" id="ps_kbnxxx">
	<div class="modal-content">
	    <header class="header">
	        <div class="text-wrapper">銀行検索</div>
	        <div>
	        	<img class="modal-close" id="modal-close" src="{{ asset('/img/icon/modal_close.svg') }}" />
	        </div>
	    </header>
	    <form method="post" action="{{ route('master.search.ps_kbn') }}">
		    <div class="button_area">
		    	<button class="button" type="button"><div class="button-text_wrapper">実行する</div></button>
		    </div>
			<div class="element-form-rows">
				<div class="element-form">
					<div class="text_wrapper">銀行コード</div>
					<div class="frame">
			    		<div class="textbox">
							<input type="text" name="name" class="element" minlength="0" maxlength="6" size="6">
						</div>
					</div>
				</div>
				<div class="element-form">
					<div class="text_wrapper">銀行名(部分)</div>
					<div class="frame">
			    		<div class="textbox">
							<input type="text" name="name" class="element" minlength="0" maxlength="20" size="10">
						</div>
					</div>
				</div>
			</div>
		</form>
		<div class="modal-paging">
			<div class="text-wrapper-5">1/12</div>
			<div class="component">
				<div class="left-wrapper"><img class="img-2" src="{{ asset('/img/icon/page-left-off.svg') }}"></div>
				<div class="right-wrapper"><img class="img-2" src="{{ asset('/img/icon/page-right-on.svg') }}"></div>
			</div>
		</div>
		<div class="grid">
			<table class="table_sticky">
				<thead class="grid_header">
					<tr>
						<td class="grid_wrapper_center td_5p">銀行コード</td>
						<td class="grid_wrapper_center td_10p">銀行名</td>
					</tr>
				</thead>
				<tbody class="tbody_scroll">
					@for($i = 0; $i <= 80; $i++)
				        @if($i % 2 === 1)
				        	<tr>
				        @else
				        	<tr class="col_yellow">
			        	@endif
							<td class="grid_col_6 col_rec col_rec"><input type="text" placeholder="000001" class="grid_textbox grid_textbox_70p" minlength="0" maxlength="6" size="6"></td>
							<td class="grid_col_2 col_rec"><input type="text" placeholder="XXXXXXXXXX" class="grid_textbox" minlength="0"  maxlength="100" size="20"></td>
						</tr>
					@endfor
				</tbody>
			</table
		</div>
	</div>
</div>
