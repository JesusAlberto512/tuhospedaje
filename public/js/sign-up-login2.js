"use strict"
//ajustado jurdaneta ver 1 27102023

$('#signup_form').validate({
    rules: {},
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
    }
});

var hasPhoneError = false;
$('form').find("button[type='submit']").prop('disabled', true);
$('form').find("button[type='submit']").addClass('not-allowed'); 


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
            error.insertAfter(element);
    }
});

$(document).ready(function()
{
    $("#phone").intlTelInput({
        separateDialCode: true,
        nationalMode: true,
        preferredCountries: ["ve"],
        autoPlaceholder: "polite",
        placeholderNumberType: "MOBILE",
        utilsScript: baseURL + '/public/js/intl-tel-input-13.0.0/build/js/utils.js'
    });

    var countryData = $("#phone").intlTelInput("getSelectedCountryData");
    $('#default_country').val(countryData.iso2);
    $('#carrier_code').val(countryData.dialCode);

    $("#phone").on("countrychange", function(e, countryData)
    {
        formattedPhone();
        // log(countryData);
        $('#default_country').val(countryData.iso2);
        $('#carrier_code').val(countryData.dialCode);
        if ($.trim($(this).val()) !== '') {
            //Invalid Number Validation - Add
            if (!$(this).intlTelInput("isValidNumber") || !isValidPhoneNumber($.trim($(this).val()))) {
                $('#tel-error').addClass('error').html(validInternationalNumber).css("font-weight", "bold");
                hasPhoneError = true;
                $('#phone-error').hide();
            } else  {
                $('#tel-error').html('');
            }
        } else {
            $('#tel-error').html('');
            $('#phone-error').html('');
            hasPhoneError = false;
            enableDisableButton();
        }
    });
});

$(document).ready(function()
{
    $("input[name=phone]").on('blur keyup', function(e)
    {
        formattedPhone();

        $('#btnPhone').attr('disabled', false);
        $('#phone').html('').css("border-color","none");
        if ($.trim($(this).val()) !== '') {
            if (!$(this).intlTelInput("isValidNumber") || !isValidPhoneNumber($.trim($(this).val()))) {
                $('#tel-error').addClass('error').html(validInternationalNumber).css("font-weight", "bold");
                hasPhoneError = true;
                $('#btn').attr('disabled','disabled');
                $('#phone-error').hide();
                enableDisableButton();

            } else {

                var phone = $(this).val().replace(/-|\s/g,""); //replaces 'whitespaces', 'hyphens'
                var phone = $(this).val().replace(/^0+/,"");  //replaces (leading zero - for BD phone number)
                var pluginCarrierCode = $('#phone').intlTelInput('getSelectedCountryData').dialCode;

                $('#phone-error').html('');
                $('#tel-error').html('');
                $('#phone-error').show();
                hasPhoneError = false;
                $('#phone').html('').css("border-color","none");
                enableDisableButton();
            }
        } else {
            $('#tel-error').html('');
            $('#phone-error').html('');
            hasPhoneError = false;
            $('#phone').html('').css("border-color","none");
            enableDisableButton();
        }
    });

});

function formattedPhone()
{
    if ($('#phone').val != '') {
        var p = $('#phone').intlTelInput("getNumber").replace(/-|\s/g,"");
        $("#formatted_phone").val(p);
    }
}
function enableDisableButton() {
    if (!hasPhoneError) {
        $('form').find("button[type='submit']").prop('disabled', false);
        $('form').find("button[type='submit']").removeClass('not-allowed'); 
    } else {
        $('form').find("button[type='submit']").prop('disabled', true);
        $('form').find("button[type='submit']").addClass('not-allowed'); 
    }
}
