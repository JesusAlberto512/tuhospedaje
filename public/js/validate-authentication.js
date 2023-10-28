"use strict"



$('#form_verify_code').validate({
    rules: {

    },

    submitHandler: function(form)
    {

        $("#btn").on("click", function (e)
        {
            $("#btn").attr("disabled", true);
            e.preventDefault();
        });


        $(".spinner").removeClass('d-none');
        $("#btn_next-text").text(signedUpText);
        return true;
    },

    errorPlacement: function (error, element) {
        error.insertAfter(element);
    },

    messages: {
    }
});





var hasCodeError = true;

//jquery validation
$.validator.setDefaults({


    highlight: function(element) {
        $(element).parent('div').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).parent('div').removeClass('has-error');
    },
    errorPlacement: function (error, element) {
            $('.error-tag').html('').hide();
            //$('#emailError').html('').hide();
            error.insertAfter(element);
    }
});




$(document).ready(function()
{
    enableDisableButton();
    $("input[name=validation_code]").on('blur keyup', function(e)
    {

        $('#btn').attr('disabled', false);

        if ($('#validation_code').val() !== '') {
            if ($('#validation_code').val().length == 6) {
                $('#code-error').addClass('error').css("font-weight", "bold");
                hasCodeError = false;
                $('#btn').attr('disabled','disabled');
                enableDisableButton();
                $('#form_verify_code').submit();
            } else {

                $('#code-error').html('CAMBIAR POR EL ERROR');
                $('#code-error').show();
                hasCodeError = true;
                enableDisableButton();
            }
        } else {
            $('#code-error').html('CAMBIAR POR EL ERROR');
            $('#code-error').show();
            hasCodeError = true;
            enableDisableButton();
        }
    });
    $('#validation_code').focus();
});


function enableDisableButton() {
    if (!hasCodeError) {
        $('#form_verify_code').find("button[type='submit']").prop('disabled', false);
        $('#form_verify_code').find("button[type='submit']").removeClass('not-allowed');
    } else {
        $('#form_verify_code').find("button[type='submit']").prop('disabled', true);
        $('#form_verify_code').find("button[type='submit']").addClass('not-allowed');
    }
}

