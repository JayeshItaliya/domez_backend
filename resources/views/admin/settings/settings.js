$('.my-spinner').hide();
var checkemail = $('#email_address').val();
$('#email_address').on('change', function () {
    "use strict";
    var email = $(this).val();
    if ($.trim(email) == '' || email == checkemail) {
        return false;
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        url: $(this).attr('data-next'),
        data: {
            email: email,
        },
        method: 'POST',
        beforeSend: function () {
            $('.my-spinner').show();
            $('.btn_submit').attr('disabled', true);
        },
        success: function (response) {
            $('.my-spinner').hide();
            $('.btn_submit').attr('disabled', false);
            if (response.status == 1) {
                $('#email_address').removeClass('is-invalid')
                $('#verifyemailmodal .show_email').text(email);
                $('#verifyemailmodal #show_email').val(email);
                $('#verifyemailmodal').modal('show');
            } else {
                $('#email_address').addClass('is-invalid')
                toastr.error(response.message);
                return false;
            }
        },
        error: function (e) {
            toastr.error(wrong);
            return false;
        }
    });
});
$('.btn_verify').on('click', function () {
    "use strict";
    $('#otp').removeClass('is-invalid');
    if ($.trim($('#otp').val()) == '') {
        $('#otp').addClass('is-invalid').focus();
        return false;
    }
    var btntext = $(this).html();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        url: $(this).attr('data-next'),
        data: {
            otp: $('#otp').val(),
            email: $('#show_email').val(),
        },
        method: 'POST',
        beforeSend: function () {
            $('.btn_verify').html($('.my-spinner').html());
        },
        success: function (response) {
            $('.btn_verify').html(btntext);
            if (response.status == 1) {
                toastr.error(response.message);
                location.reload();
            } else {
                toastr.error(response.message);
                return false;
            }
        },
        error: function (e) {
            $('.btn_verify').html(btntext);
            toastr.error(wrong);
            return false;
        }
    });
});
