jQuery(document).ready(function($){
	$('#tao-form .save').on('click', function(){
		validate('tao-form');
		if(validateState){
			$('#tao-form').append('<p class="sucess">Enviando...</p>');
			$.ajax({
			type      : 'post',
			url       : TaoAjax.ajaxSave,
			data      : $("#tao-form").serialize(),
			dataType  : 'html',
			success	  : function() {
				$('#tao-form .sucess').text('Enviado com sucesso');
				$('#tao-form input[type="text"], #tao-form input[type="email"]').val('');
				setTimeout(function() {
					$('#tao-form .sucess').fadeOut();
				}, 1500);
			}
			});
		}
    });
});