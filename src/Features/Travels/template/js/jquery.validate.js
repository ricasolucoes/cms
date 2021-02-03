<!--//--><![CDATA[//><!--
    $(document).ready(
        function () {
            $('form#contact-us').submit(
                function () {
                    $('form#contact-us .error').remove();
                    var hasError = false;
                    $('.requiredField').each(
                        function () {
                            if($.trim($(this).val()) == '') {
                                var labelText = $(this).prev('label').text();
                                $(this).parent().append('<span class="error">Please enter this field</span>');
                                $(this).addClass('inputError');
                                hasError = true;
                            } else if($(this).hasClass('email')) {
                                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                                if(!emailReg.test($.trim($(this).val()))) {
                                    var labelText = $(this).prev('label').text();
                                    $(this).parent().append('<span class="error">Entered an invalid email address</span>');
                                    $(this).addClass('inputError');
                                    hasError = true;
                                }
                            }
                        }
                    );
                    if(!hasError) {
                        var formInput = $(this).serialize();
                        $.post(
                            $(this).attr('action'),formInput, function (data) {
                                $('form#contact-us').fadeIn(
                                    "fast", function () {                   
                                        $(this).before('<p class="tick"><span><span>Thank you for your Email. <br /> We will get in touch with you soon</span></span></p>');
                                    }
                                );
                            }
                        );
                    }
            
                    return false;    
                }
            );
        }
    );
    //-->!]]>