var min_time = '';
var max_time = '';
var start_time = $('#start_time').val();
var my_interval = 60;
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
    var from_age = parseInt($(this).val());
    if (from_age == '') {
        $("#to_age").attr('disabled', true);
        return false;
    }
    $('#to_age option:not(:first)').remove();
    $('#to_age option:first').attr('disabled', false);
    if (from_age == 50) {
        $('#to_age').append('<option value="' + from_age + '" selected >' + from_age + '</option>');
        $('#to_age option:first').attr('disabled', true);
        return false;
    }
    from_age += 1;
    for (var i = from_age; i <= 50; i++) {
        let selected = $.trim($('#to_age').attr('data-to-age')) == i ? 'selected' : '';
        $('#to_age').append('<option value="' + i + '"  ' + selected + ' >' + i + '</option>');
    }
    $('#to_age option:first').attr('disabled', true);
}).change();
$('#min_player').on('change', function () {
    var min_player = parseInt($(this).val());
    if (min_player == '') {
        $("#max_player").attr('disabled', true);
        return false;
    }
    $('#max_player option:not(:first)').remove();
    $('#max_player option:first').attr('disabled', false);
    if (min_player == 30) {
        $('#max_player').append('<option value="' + min_player + '" selected >' + min_player + '</option>');
        $('#max_player option:first').attr('disabled', true);
        return false;
    }
    min_player += 1;
    for (var i = min_player; i <= 30; i++) {
        let selected = $.trim($('#max_player').attr('data-max-players')) == i ? 'selected' : '';
        $('#max_player').append('<option value="' + i + '"  ' + selected + ' >' + i + '</option>');
    }
    $('#max_player option:first').attr('disabled', true);
}).change();
$('#dome').on('change', function () {
    min_time = $(this).find(':selected').attr('data-start-time');
    max_time = $(this).find(':selected').attr('data-end-time');
    if (start_time == '') {
        start_time = $(this).find(':selected').attr('data-start-time');
    }
    my_interval = $.trim($(this).find(':selected').attr('data-slot-duration')) == 2 ? 90 : 60;
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
                        if ($.trim(sport_selected) != '') {
                            var checked = elementValue.id == sport_selected ? 'checked' : '';
                        } else {
                            var checked = arrayIndex == 0 ? 'checked' : '';
                        }
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
                if (response.fieldsdata.length > 0) {
                    $.each(response.fieldsdata, function (arrayIndex, elementValue) {
                        var selected = $.inArray(elementValue.id, field_selected) !== -1 ? 'selected' : '';
                        $('#field').append('<option value="' + elementValue.id + '"  ' + selected + '  >' + elementValue.name + '</option>');
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
        interval: my_interval,
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
                interval: my_interval,
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
            interval: my_interval,
            dynamic: false,
            dropdown: true,
            scrollbar: true,
            startTime: start_time,
            minTime: min_time,
            maxTime: max_time,
        });
    }
    if (is_vendor || is_employee || is_provider) {
        let html =
            '<a href="' + window.location.href.replace(window.location.search, '') + '/add" class="btn-custom-primary">' + plus_svg_icon + '</a>';
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
