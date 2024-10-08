<div class="modal-box  modal-box-w550px" id="supplier_balance">
	<div class="modal-content">
	    <header class="header">
	        <div class="text-wrapper">仕入先残高検索</div>
	        <div>
	        	<a href=""><img class="modal-close" id="modal-close" src="{{ asset('/img/icon/modal_close.svg') }}" /></a>
	        </div>
	    </header>
	    <form method="post" action="{{ route('master.search.supplier') }}">
		    <div class="button_area">
		    	<button class="button" type="button"><div class="button-text_wrapper">実行する</div></button>
		    </div>
			<div class="element-form-rows">
				<div class="element-form">
					<div class="text_wrapper">仕入先</div>
					<div class="frame">
						<div class="textbox">
							<input type="text" name="name" class="element" minlength="0" maxlength="6" size="6" />
							<img class="vector" src="/img/icon/vector.svg" />
						</div>
						<div class="textbox">
							<input type="text" name="name" class="element" minlength="0" maxlength="20" size="20" />
						</div>
					</div>
				</div>
			</div>
			@include('components.menu.selected', ['view' => 'main'])
		</form>
		<div class="flex_contents">
			<div class="flex_item">
				<div class="grid">
					<table class="table_sticky">
						<thead class="gray_header">
							<tr>
								<td class="grid_wrapper_center td_50p" colspan="2">買掛帳簿残高</td>
							</tr>
							<tr>
								<td class="grid_wrapper_center">設定日</td>
								<td class="grid_wrapper_center">金額</td>
							</tr>
						</thead>
						<tbody class="tbody_scroll">
							<tr>
								<td class="grid_wrapper_right"></td>
								<td class="grid_wrapper_right"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="flex_item">
				<div class="grid">
					<table class="table_sticky">
						<thead class="gray_header">
							<tr>
								<td class="grid_wrapper_center td_50p" colspan="2">支払帳簿残高</td>
							</tr>
							<tr>
								<td class="grid_wrapper_center">設定日</td>
								<td class="grid_wrapper_center">金額</td>
							</tr>
						</thead>
						<tbody class="tbody_scroll">
							<tr>
								<td class="grid_wrapper_right"></td>
								<td class="grid_wrapper_right"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="flex_contents">
			<div class="flex_item">
				<div class="grid">
					<table class="table">
						<thead class="grid_header">
							<tr>
								<td class="grid_wrapper_center td_50p" colspan="2">買掛登録残高</td>
							</tr>
							<tr>
								<td class="grid_wrapper_center">設定日</td>
								<td class="grid_wrapper_center">金額</td>
							</tr>
						</thead>
						<tbody class="tbody_scroll">
							@for($i = 0; $i <= 3; $i++)
								<tr>
									<td class="grid_wrapper_right"></td>
									<td class="grid_wrapper_right"></td>
							@endfor
						</tbody>
					</table>
				</div>
			</div>
			<div class="flex_item">
				<div class="grid">
					<table class="table_sticky">
						<thead class="grid_header">
							<tr>
								<td class="grid_wrapper_center td_50p" colspan="2">支払登録残高</td>
							</tr>
							<tr>
								<td class="grid_wrapper_center">設定日</td>
								<td class="grid_wrapper_center">金額</td>
							</tr>
						</thead>
						<tbody class="tbody_scroll">
							@for($i = 0; $i <= 3; $i++)
								<tr>
									<td class="grid_wrapper_right"></td>
									<td class="grid_wrapper_right"></td>
							@endfor
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
