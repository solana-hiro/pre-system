<div class="modal  modal-box-w400px" tabindex="-1" role="dialog" id="modal_transition_confirm">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		    <div class="button_area_right">
                <button type="button" class="button_close" data-dismiss="modal" id="modal_close_button4"><img src="{{ asset('/img/icon/common_modal_close.svg')}}"></button>
            </div>
			<div class="modal-body">
				<div class="modal_message">
					<p class="modal_title">【確認】</p>
					<p class="modal_attention">別の画面へ遷移します。よろしいですか？</p>
					<p class="modal_value"></p>
				</div>
			</div>
			<div class="button_area">
				<div>
					<button type="submit" class="modal_button" onclick="submitTransition();"><div class="text_wrapper" >はい</div></button>
					<button type="button" class="modal_button" data-dismiss="modal" id="modal_close4"><div class="text_wrapper">いいえ</div></button>
				</div>
			</div>
		</div>
	</div>
</div>
