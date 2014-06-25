/**
* Autor: Rafael Clares
* Mail: rafadinix@gmail.com
* Web: www.clares.wordpress.com
* Ano : 10/2010 
*/

/* Config Vars */
/* Nao alterar ValidateState */
validateState = false;
/* Required message */
validateRequiredMsg = "Campo de preechimento obrigatório";
/* E-mail message */
validateMailMsg = "E-mail informado é inválido";
/* Numeric message */
validateNumericMsg = "O valor deve ser numérico";
/* Min message */
validateMinMsg = "A quantidade mínima de caracters é: ";
/* Max message */
validateMaxMsg = "A quantidade máxima de caracters é: ";
/* Password message */
validatePasswordMsg = "Senhas não conferem";

function validate(form_id)
{
    jQuery('#'+form_id+' :input').each(function(){
        /* required */
        if ( jQuery(this).hasClass('required') && jQuery.trim( jQuery(this).val() ) == ""){
            jQuery(this).addClass('invalid');
            jQuery(this).focus();
			jQuery('#validate_message').html(validateRequiredMsg);
            validateState = false; 
            return false;
        }
        else{
            jQuery(this).removeClass('invalid');
            validateState = true;
        }
		
         /* numeric value */
        if ( jQuery(this).hasClass('required') && jQuery(this).hasClass('numeric') ){
            var nan = new RegExp(/(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/);
            if (!nan.test(jQuery.trim( jQuery(this).val() ))){
                jQuery(this).addClass('invalid');
                jQuery(this).focus();
                jQuery('#validate_message').html(validateNumericMsg);
                validateState = false;
                return false;
            }
            else{
                jQuery('#validate_message').html('');
                jQuery(this).removeClass('invalid');
                validateState = true;
            }
        }
		
        /* mail */
        if ( jQuery(this).hasClass('email') ){
            var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
            if (!er.test(jQuery.trim( jQuery(this).val() ))){
                 jQuery(this).addClass('invalid');
                 jQuery(this).focus();
				 jQuery('#validate_message').html(validateMailMsg);
                 validateState = false;
                 return false;
            }
            else{
                jQuery(this).removeClass('invalid');
                validateState = true;
            }
        } 

        /* min value */
        if ( jQuery(this).attr('min') && jQuery(this).hasClass('required') ){
            if(jQuery.trim(jQuery(this).val()).length < jQuery(this).attr('min') ){
                jQuery(this).addClass('invalid');
                jQuery(this).focus();
                jQuery('#validate_message').html(validateMinMsg + jQuery(this).attr('min'));
                validateState = false;
                return false;
            }
            else{
                jQuery('#validate_message').html('');
                jQuery(this).removeClass('invalid');
                validateState = true;
            }
        }
		
         /* max value */
        if ( jQuery(this).attr('max')  && jQuery(this).hasClass('required') ){
            if(jQuery.trim(jQuery(this).val()).length > jQuery(this).attr('max') ){
                jQuery(this).addClass('invalid');
                jQuery(this).focus();
                jQuery('#validate_message').html(validateMaxMsg + jQuery(this).attr('max'));				
                validateState = false;
                return false;
            }
            else{
                jQuery('#validate_message').html('');
                jQuery(this).removeClass('invalid');
                validateState = true;
            }
        }		
        /* password */
        if ( jQuery(this).hasClass('password') && jQuery(this).nextAll('.password').hasClass('password')){ 
            if (jQuery.trim( jQuery(this).val() ) != jQuery.trim( jQuery(this).nextAll('.password').val() )){
                 jQuery(this).nextAll('.password').addClass('invalid');
                 jQuery(this).nextAll('.password').focus();
                 jQuery('#validate_message').html(validatePasswordMsg);
                 validateState = false;
                 return false;
            }
            else{ 
            jQuery('#validate_message').html('');
            jQuery(this).nextAll('.password').removeClass('invalid');
            validateState = true;
            }
        }
    })
}