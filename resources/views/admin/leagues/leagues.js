var min_time = '';
var max_time = '';
var start_time = $('#start_time').val();
$('#start_date').on('change', function () {
    if ($.trim($(this).val()) != "") {
        $('#end_date, #booking_deadline').attr('disabled', false);
        $('#end_date').attr('min', $(this).val());
        var selectedDate = new Date($(this).val());
        selectedDate.setDate(selectedDate.getDate() - 1);
        var date = new Date(selectedDate);
        var year = date.getFullYear();
        var month = date.getMonth() + 1; // Note: JavaScript months are zero-based, so we need to add 1
        var day = date.getDate();
        var newDateString = year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day : day);
        $('#booking_deadline').attr('max', newDateString);
    }
}).change();
$('#from_age').on('change', function () {
    var from_age = $(this).val();
    $("#to_age").find("option").each(function (index, el) {
        if ($(this).val() <= from_age) {
            $(this).attr('disabled', true);
        } else {
            $(this).attr('disabled', false);
        }
    });
}).change();
$('#min_player').on('change', function () {
    var min_player = $(this).val();
    $("#max_player").find("option").each(function (index, el) {
        if ($(this).val() <= min_player) {
            $(this).attr('disabled', true);
        } else {
            $(this).attr('disabled', false);
        }
    });
}).change();
$('#dome').on('change', function () {
    min_time = $(this).find(':selected').attr('data-start-time');
    max_time = $(this).find(':selected').attr('data-end-time');
    if (start_time == '') {
        start_time = $(this).find(':selected').attr('data-start-time');
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
            $('.radio-editer').parent().show();
            if (response.status == 1) {
                var html = '';
                $('.radio-editer').html('');
                if (response.sportsdata.length > 0) {
                    $.each(response.sportsdata, function (arrayIndex, elementValue) {
                        var checked = arrayIndex == 0 ? 'checked' : '';
                        html +=
                            '<div class="form-check pe-3"><input type="radio" name="sport" class="form-check-input" value="' +
                            elementValue.id + '" id="radio' + arrayIndex + '" ' +
                            checked +
                            ' ><label class="form-check-label" for="radio' +
                            arrayIndex +
                            '">' + elementValue.name + '</label></div>';
                    });
                    $('.radio-editer').html(html);
                    getfields('');
                } else {
                    $('.radio-editer').html(no_data);
                }

                // $('#field option:not(:first)').remove();
                // if (response.fieldsdata.length > 0) {
                //     $.each(response.fieldsdata, function (arrayIndex, elementValue) {
                //         let selected = $.trim($('#field').attr('data-field-selected')) == elementValue.id ? 'selected' : '';
                //         $('#field').append('<option value="' + elementValue.id + '" ' + selected + ' >' + elementValue.name + '</option>');
                //     });
                // } else {
                //     $('#field').append('<option value="" selected disabled>' + no_data +
                //         '</option>');
                // }
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
$('#field').select2({
    theme: "bootstrap-5",
    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    placeholder: $(this).data('placeholder'),
    closeOnSelect: false,
});
$('body').on('change', '.radio-editer input[type=radio]', function () {
    getfields($(this).val());
});

function getfields(sport) {
    if ($.trim(sport) == "") {
        sport = $('.radio-editer').find(':checked').val();
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        url: $('#dome').attr('data-next'),
        data: {
            id: $('#dome').find(':selected').val(),
            sport: sport,
        },
        method: 'GET',
        success: function (response) {
            if (response.status == 1) {
                $('#field option').remove();
                // $('#field option:not(:first)').remove();
                if (response.fieldsdata.length > 0) {
                    $.each(response.fieldsdata, function (arrayIndex, elementValue) {
                        if ($.inArray(elementValue.id, field_selected) !== -1) {
                            $('#field').append('<option value="' + elementValue.id + '" selected >' + elementValue.name + '</option>');
                        } else {
                            $('#field').append('<option value="' + elementValue.id + '">' + elementValue.name + '</option>');
                        }
                    });
                } else {
                    $('#field').append('<option value="" selected disabled>' + no_data + '</option>');
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
}
$(function () {
    $('.start.time_picker').timepicker({
        // timeFormat: 'h:mm p',
        interval: 60,
        dynamic: false,
        dropdown: true,
        scrollbar: true,
        startTime: start_time,
        minTime: min_time,
        maxTime: max_time,
        change: function (time) {
            var element = $(this);
            var timepicker = element.timepicker();
            $('.end.time_picker').val('');
            $('.end.time_picker').timepicker('destroy');
            $('.end.time_picker').timepicker({
                interval: 60,
                dynamic: false,
                dropdown: true,
                scrollbar: true,
                startTime: timepicker.format(time),
                minTime: timepicker.format(time),
                maxTime: max_time,
            });
        }
    });
    if ($.trim($('.end.time_picker').val()) != "") {
        $('.end.time_picker').timepicker({
            // timeFormat: 'h:mm p',
            interval: 60,
            dynamic: false,
            dropdown: true,
            scrollbar: true,
            startTime: start_time,
            minTime: min_time,
            maxTime: max_time,
        });
    }


    if (is_vendor || is_employee) {
        let html =
            '<a href="' + window.location.href.replace(window.location.search, '') + '/add" class="btn-custom-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg></a>';
        $('.fixed-table-toolbar .btn-group').append(html);
    }
});

// $('body').on('blur', '.start.time_picker', function () {
//     "use strict";
//     setTimeout(() => {
//         var start_time = $(this).val();
//         var end_time = '';
//         var dome_id = $('#dome').val();
//         var validate_start_time = 1;
//         var element = $(this);
//         validatetime(start_time, end_time, dome_id, validate_start_time, element);
//     }, 100);
// });
// $('body').on('blur', '.end.time_picker', function () {
//     "use strict";
//     var start_time = $(this).parent().parent().prev().find('.start.time_picker').val();
//     if ($.trim(start_time) == '') {
//         return false;
//     }
//     setTimeout(() => {
//         var end_time = $(this).val();
//         var dome_id = $('#dome').val();
//         var validate_start_time = '';
//         var element = $(this);
//         validatetime(start_time, end_time, dome_id, validate_start_time, element);
//     }, 100);
// });

// function validatetime(start_time, end_time, dome_id, validate_start_time, element) {
//     "use strict";
//     showpreloader();
//     $.ajax({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
//                 'content')
//         },
//         url: validatetimeurl,
//         data: {
//             start_time: start_time,
//             end_time: end_time,
//             dome_id: dome_id,
//             validate_start_time: validate_start_time,
//         },
//         method: 'get',
//         success: function (response) {
//             hidepreloader();
//             if (response.status == 0) {
//                 $(element).addClass('is-invalid').val('');
//                 if ($(element).parent().hasClass('input-group')) {
//                     $(element).next().addClass('border-danger')
//                 }
//                 toastr.error(response.message);
//                 return false;
//             } else {
//                 $(element).parent().find('.is-invalid').removeClass('is-invalid');
//                 $(element).parent().find('.border-danger').removeClass('border-danger');
//                 if (validate_start_time == 1) {
//                     $(element).parent().parent().parent().next().find('.end.time_picker').val('');
//                 }
//             }
//         },
//         error: function (e) {
//             hidepreloader();
//             toastr.error(wrong);
//             return false;
//         }
//     });
// }

function deletedata(id, url) {
    "use strict";
    swalWithBootstrapButtons
        .fire({
            icon: 'warning',
            title: are_you_sure,
            showCancelButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonText: yes,
            cancelButtonText: no,
            reverseButtons: true,
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {
                            id: id,
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 1) {
                                // toastr.success(response.message);
                                location.reload();
                            } else {
                                swal_cancelled(wrong);
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
