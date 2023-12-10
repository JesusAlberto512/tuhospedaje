"use strict"
$('select').on('change', function() {
    var dobError = '';
    var day = document.getElementById("user_birthday_day").value;
    var month = document.getElementById("user_birthday_month").value;
    var y = document.getElementById("user_birthday_year").value;
    var year = parseInt(y);
    var year2 = signup_form.birthday_year;
    var age = 18;

    var setDate = new Date(year + age, month - 1, day);
    var currdate = new Date();
    if (day == '' || month == '' || y == '') {
        $('#dobError').html('<label class="text-danger">'+requiredFieldText+'</label>');
        year2.focus();
        return false;
    }
    else if (setDate > currdate) {
        $('#dobError').html('<label class="text-danger">'+oldLimitationText+'</label>');
            year2.focus();
            return false;
    } else {
        $('#dobError').html('<span class="text-danger"></span>');
        return true;
    }
});

function ageValidate()
{
    var dobError = '';
    var day = document.getElementById("user_birthday_month").value;
    var month = document.getElementById("user_birthday_day").value;
    var y = document.getElementById("user_birthday_year").value;
    var year = parseInt(y);
    var year2 = signup_form.birthday_year;
    var age = 18;

    var setDate = new Date(year + age, month - 1, day);
    var currdate = new Date();
    if (day == '' || month == '' || y == '') {
        $('#dobError').html('<label class="text-danger">'+requiredFieldText+'</label>');
        year2.focus();
        return false;
    }
    else if (setDate > currdate) {
        $('#dobError').html('<label class="text-danger">'+oldLimitationText+'</label>');
        year2.focus();
        return false;
    } else {
        $('#dobError').html('<span class="text-danger"></span>');
        return true;
    }
}

$('#signup_form').validate({
    rules: {
        first_name: {
            required: true,
            maxlength: 255
        },
        last_name: {
            required: true,
            maxlength: 255
        },
        email: {
            required: true,
            maxlength: 255,
            laxEmail: true
        },
        password: {
            required: true,
            minlength: 6
        },
        birthday_month: {
            required: true
        },
        birthday_day: {
            required: true
        },
        birthday_year: {
            required: true,
            minAge: 18
        }
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
        $('#user_birthday_month-error').addClass('d-none');
        $('#user_birthday_day-error').addClass('d-none');
        error.insertAfter(element);
        $('#user_birthday_year-error').addClass('d-none');

    },

    messages: {
    first_name: {
        required:  requiredFieldText,
        maxlength: maxLengthText,
    },
    last_name: {
        required:  requiredFieldText,
        maxlength: maxLengthText,
    },
    email: {
        required:  requiredFieldText,
        maxlength: maxLengthText,
    },
    password: {
        required:  requiredFieldText,
        minlength: minLengthText,
    },
    birthday_day: {
        required:  requiredFieldText,
    },
    birthday_month: {
        required:  requiredFieldText,
    },
    birthday_year: {
        required:  requiredFieldText,
    }
    }
});

jQuery.validator.addMethod("laxEmail", function(value, element) {
    return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
}, validEmailText );

$(document).on('blur keyup', '#email', function() {
    var emailError = '';
    var email      = $('#email').val();
    var _token     = $('input[name="_token"]').val();
    $('.error-tag').html('').hide();
    if (email != '') {
    $.ajax({
        url:checkUserURL,
        method:"POST",
        data:{
                email:email,
                "_token": _token,
                },
        success:function(result)
        {
            if (result == 'not_unique') {
                $('#emailError').html('<label class="text-danger">'+emailExistText+'</label>');
                $('#email').addClass('has-error');
                $('#btn').attr('disabled', 'disabled');
            } else {
                $('#email').removeClass('has-error');
                $('#emailError').html('');
                $('#btn').attr('disabled', false);
            }
        }
    })
    } else {
        $('#emailError').html('');
    }

});

var hasEmailError = false;

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
            $('#emailError').html('').hide();
            error.insertAfter(element);
    }
});



$.validator.addMethod("minAge", function(value, element, min) {
    var today = new Date();
    var birthDate = new Date(value);
    var age = today.getFullYear() - birthDate.getFullYear();

    if (age > min+1) { return true; }

    var m = today.getMonth() - birthDate.getMonth();

    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) { age--; }

    return age >= min;
}, minAge);