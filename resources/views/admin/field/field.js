$(function () {
    if (is_vendor) {
        $('.fixed-table-toolbar .btn-group').append('<a href="' + window.location.href.replace(window.location.search, '') + '/add" class="btn-custom-primary">' + plus_svg_icon + '</a>');
    }
    $('#field_name').on('input', function () {
        var inputValue = $(this).val();
        var inputValue = inputValue.replace(/[^a-zA-Z0-9]/g, '');
        if (inputValue.length > 30) {
            $(this).addClass('is-invalid');
            inputValue = inputValue.substring(0, 30);
            $('.field_error').html($(this).attr('max-character-err'));
        } else {
            $(this).removeClass('is-invalid');
            $('.field_error').html('');
        }
        $(this).val(inputValue);
    });
});

function fieldinactive(id, type, url) {
    "use strict";
    swalWithBootstrapButtons
        .fire({
            icon: type == 2 ? '' : 'warning',
            title: type == 2 ? select_date : are_you_sure,
            html: type == 2 ? '<input id="swal-input1" class="swal2-input form-control mx-auto w-100" type="date" min="' + min_date + '">' : '',
            showCancelButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonText: type == 2 ? save_date : yes,
            cancelButtonText: type == 2 ? cancel : no,
            reverseButtons: true,
            showLoaderOnConfirm: true,
            preConfirm: function () {
                var date = '';
                if (type == 2) {
                    date = $('#swal-input1').val();
                    if (!date) {
                        Swal.disableLoading();
                        $('.swal2-input').addClass('is-invalid');
                        return false;
                    }
                    $('.swal2-input').removeClass('is-invalid');
                }
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {
                            id: id,
                            date: date,
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 1) {
                                location.reload();
                            } else {
                                Swal.disableLoading();
                                Swal.showValidationMessage(response.message);
                                return false;
                            }
                        },
                        error: function (response) {
                            swal_cancelled(wrong);
                            return false;
                        },
                    });
                });
            },
        }).then((result) => {
            if (!result.isConfirmed) {
                result.dismiss === Swal.DismissReason.cancel
            }
        })

}
$('#dome').on('change', function () {
    "use strict";
    if ($.trim($(this).val()) == '') {
        return false;
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        url: $(this).attr('data-next'),
        data: {
            id: $(this).val(),
        },
        method: 'GET',
        success: function (response) {
            if (response.status == 1) {
                $('#sport_id option:not(:first)').remove();
                if (response.sportsdata.length > 0) {
                    $.each(response.sportsdata, function (arrayIndex, elementValue) {
                        let selected = $.trim($('#sport_id').attr('data-sport-selected')) == elementValue.id ? 'selected' : '';
                        $('#sport_id').append('<option value="' + elementValue.id + '"  ' + selected + ' >' + elementValue.name + '</option>');
                    });
                } else {
                    $('#sport_id').append('<option value="" selected disabled>' + no_data +
                        '</option>');
                }
            } else {
                toastr.error(response.message);
                return false;
            }
        },
        error: function (e) {
            toastr.error(wrong);
            return false;
        }
    });
}).change();
$('#min_person').on('change', function () {
    var min_person = parseInt($(this).val());
    $('#max_person option:not(:first)').remove();
    if (min_person == '') {
        $("#max_person").attr('disabled', true);
        return false;
    }
    if (min_person == 30) {
        $('#max_person').append('<option value="' + min_person + '" >' + min_person + '</option>');
        return false;
    }
    min_person += 1;
    for (var i = min_person; i <= 30; i++) {
        let selected = $.trim($('#max_person').attr('data-max-persons')) == i ? 'selected' : '';
        $('#max_person').append('<option value="' + i + '"  ' + selected + ' >' + i + '</option>');
    }
    $('#max_person option:first').attr('disabled', false);
    setTimeout(function (params) {
        $('#max_person option:first').attr('disabled', true);
    }, 500);
}).change();
