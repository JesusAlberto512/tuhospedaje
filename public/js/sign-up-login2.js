"use strict"


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

                $.ajax({
                    method: "POST",
                    url: duplicateNumberCheckURL,
                    dataType: "json",
                    cache: false,
                    data: {
                        "_token": token,
                        'phone': $.trim($(this).val()),
                        'carrier_code': $.trim(countryData.dialCode),
                    }
                })
                .done(function(response)
                {
                    if (response.status == true) {
                        $('#tel-error').html('');
                        $('#phone-error').show();

                        $('#phone-error').addClass('error').html(response.fail).css("font-weight", "bold");
                        hasPhoneError = true;
                        enableDisableButton();
                    } else if (response.status == false) {
                        $('#tel-error').show();
                        $('#phone-error').html('');

                        hasPhoneError = false;
                        enableDisableButton();
                    }
                });
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
               /* $.ajax({
                    url: duplicateNumberCheckURL,
                    method: "POST",
                    dataType: "json",
                    data: {
                        'phone': phone,
                        'carrier_code': pluginCarrierCode,
                        '_token': token,
                    }
                })
                .done(function(response)
                {
                    if (response.status == true) {
                        if (phone.length == 0) {
                            $('#phone-error').html('');
                        } else {
                            $('#phone-error').addClass('error').html(response.fail).css("font-weight", "bold");
                            hasPhoneError = true;
                            enableDisableButton();
                        }
                    } else if (response.status == false) {
                        
                        hasPhoneError = false;
                        enableDisableButton();
                    }
                });*/
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

/*
$.validator.addMethod("minAge", function(value, element, min) {
    var today = new Date();
    var birthDate = new Date(value);
    var age = today.getFullYear() - birthDate.getFullYear();

    if (age > min+1) { return true; }

    var m = today.getMonth() - birthDate.getMonth();

    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) { age--; }

    return age >= min;
}, minAge);
*/
