<div class="common-modal-box modal-box-w400px common_modal" id="message_modal">
	<div class="common-modal-content">
        <div class="element-form-columns">
            <div class="button_area_right">
                <button type="button" class="button_close common_modal_close" id="common_modal_close"><img src="{{ asset('/img/icon/common_modal_close.svg')}}"></button>
            </div>
            <div class="modal_message">
                <p class="modal_title">【確認】</p>
                <p class="modal_attention">{!! nl2br($flashmessage) !!}</p>
            </div>
            <div class="button_area">
            	<div>
                	<button type="button" class="modal_button" id="common_modal_ok">OK</button>
                </div>
            </div>
		</div>
	</div>
</div>
