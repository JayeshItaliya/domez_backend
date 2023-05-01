var min_time = '';
var max_time = '';
var start_time = '';
var my_interval = 60;
$('#start_date').on('change', function () {
    "use strict";
    if ($.trim($(this).val()) != "") {
        $('#end_date').attr('disabled', false);
        $('#end_date').attr('min', $(this).val());
    }
}).change();
$('#dome').on('change', function () {
    "use strict";
    if ($.trim($(this).val()) == '') {
        return false;
    }
    min_time = $(this).find(':selected').attr('data-start-time');
    max_time = $(this).find(':selected').attr('data-end-time');
    // $('.start-end-time').html('('+min_time+' - '+max_time+')');
    my_interval = $.trim($(this).find(':selected').attr('data-slot-duration')) == 2 ? 90 : 60;
    if (start_time == '') {
        start_time = min_time;
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                'content')
        },
        url: $(this).attr('data-next'),
        data: {
            id: $(this).val(),
            type: $(this).attr('data-from'),
        },
        method: 'GET',
        success: function (response) {
            if (response.status == 1) {
                $('#sport option:not(:first)').remove();
                if (response.sportsdata.length > 0) {
                    $.each(response.sportsdata, function (arrayIndex, elementValue) {
                        let selected = $.trim($('#sport').attr('data-sport-selected')) == elementValue.id ? 'selected' : '';
                        $('#sport').append('<option value="' + elementValue.id + '"  ' + selected + ' >' + elementValue.name + '</option>');
                    });
                } else {
                    $('#sport').append('<option value="" selected disabled>' + no_data +
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
$('#storesetprices').on('submit', function () {
    "use strict";
    var check = 1;
    $.each($('#storesetprices select, #storesetprices input'), function (indexInArray, valueOfElement) {
        if ($.trim(valueOfElement.value) == '') {
            $(this).addClass('is-invalid').focus();
            if ($(this).parent().hasClass('input-group')) {
                $(this).next().addClass('border-danger')
            }
            check = 0;
        } else {
            $(this).removeClass('is-invalid');
            if ($(this).parent().hasClass('input-group')) {
                $(this).next().removeClass('border-danger')
            }
        }
        if (check == 0) {
            return false;
        }
    });
    if (check == 0) {
        return false;
    }
});
// $('body').on('focus', ".time_picker", function () {
//     "use strict";
//     $(this).timepicker({
//         interval: my_interval,
//     });
// });
// var time1 = new Date('2023-04-08T10:00:00');
// var time2 = new Date('2023-04-08T11:30:00');
// var diffMs = time2 - time1;
// var diffMins = Math.floor((diffMs / 1000) / 60);    // Output: 90
var end_max_time = '';
$('body').on('focus', ".start.time_picker", function () {
    "use strict";
    $(this).timepicker({
        interval: my_interval,
        dynamic: false,
        dropdown: true,
        scrollbar: true,
        timeFormat: 'HH:mm',
        startTime: start_time,
        minTime: min_time,
        maxTime: max_time,
        change: function (time) {
            var element = $(this);
            var timepicker = element.timepicker();
            start_time = timepicker.format(time);
            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();
            var dateString = year + '-' + month + '- ' + day;
            start_time = new Date(dateString + ' ' + start_time);
            start_time.setMinutes(start_time.getMinutes() + 60);
            start_time = start_time.toLocaleString('en-US', {
                hour: 'numeric',
                minute: 'numeric',
                hour12: true
            });
            var dateObj = new Date(dateString + ' ' + start_time);
            dateObj.setMinutes(dateObj.getMinutes() + 30);
            var end_max_time = dateObj.toLocaleString('en-US', {
                hour: 'numeric',
                minute: 'numeric',
                hour12: true
            });
            var check_start_time = new Date(dateString + ' ' + start_time);
            var start_time_minutes = check_start_time.getHours() * 60 + check_start_time.getMinutes();
            var check_max_time = new Date(dateString + ' ' + max_time);
            var max_time_minutes = check_max_time.getHours() * 60 + check_max_time.getMinutes();
            if (start_time_minutes <= max_time_minutes) {
                if (start_time_minutes == max_time_minutes) {
                    end_max_time = start_time;
                    $("button[data-day-name='" + $(element).attr('data-day-name') + "']").attr("disabled", true).addClass("disabled");
                } else {
                    var check_end_max_time = new Date(dateString + ' ' + end_max_time);
                    var end_max_time_minutes = check_end_max_time.getHours() * 60 + check_end_max_time.getMinutes();
                    if (end_max_time_minutes <= max_time_minutes) {
                        if (end_max_time_minutes == max_time_minutes) {
                            end_max_time = max_time;
                            $("button[data-day-name='" + $(element).attr('data-day-name') + "']").attr("disabled", true).addClass("disabled");
                        } else {}
                    } else {
                        end_max_time = max_time;
                        $("button[data-day-name='" + $(element).attr('data-day-name') + "']").attr("disabled", true).addClass("disabled");
                    }
                }
            } else {
                start_time = max_time;
                end_max_time = max_time;
            }
            $(element).parent().parent().parent().next().find('.end.time_picker').val('');
            $(element).parent().parent().parent().next().find('.end.time_picker').timepicker('destroy');
            $(element).parent().parent().parent().next().find('.end.time_picker').timepicker({
                interval: 30,
                dynamic: false,
                dropdown: true,
                scrollbar: true,
                timeFormat: 'HH:mm',
                startTime: start_time,
                minTime: start_time,
                maxTime: end_max_time,
                change: function (time) {
                    var element = $(this);
                    var timepicker = element.timepicker();
                    start_time = timepicker.format(time);
                    if (start_time == max_time) {
                        $("button[data-day-name='" + $(element).attr('data-day-name') + "']").attr("disabled", true).addClass("disabled");
                    }
                }
            });
        }
    });
});
$(function () {
    "use strict";
    if (is_vendor || is_employee) {
        let html =
            '<a href="' + window.location.href.replace(window.location.search, '') + '/add" class="btn-custom-primary">' + plus_svg_icon + '</a>';
        $('.fixed-table-toolbar .btn-group').append(html);
    }
    var counter = 1;
    $(".appendbtn").on('click', function () {
        "use strict";
        counter++;
        var dayname = $(this).attr('data-day-name');
        var check = 1;
        $('.card-body-' + dayname + '  input').each(function () {
            if ($(this).val() === '' || $(this).val() == 0) {
                check = 0;
                $(this).addClass('is-invalid')
                $(this).parent().find('.input-group-text').addClass('border-danger')
            }else{
                $(this).removeClass('is-invalid')
                $(this).parent().find('.input-group-text').removeClass('border-danger')
            }
            if (check == 0) {
                return false;
            }
        });
        if (check == 0) {
            return false;
        }
        var html =
            '<div class="row my-2 ' + dayname + '-row " id="remove' + counter +
            '"><div class="col-md-4"><div class="form-group"><div class="input-group"><input type="text" class="form-control start time_picker border-end-0" name="start_time[' +
            dayname + '][]" data-day-name="' + dayname + '" required placeholder="' + start_time_title +
            '" /> <span class="input-group-text bg-transparent border-start-0"><i class="fa-regular fa-clock"></i> </span> </div></div></div><div class="col-md-4"><div class="form-group"><div class="input-group"><input type="text" class="form-control end time_picker border-end-0" name="end_time[' +
            dayname + '][]" data-day-name="' + dayname + '" required placeholder="' + end_time_title +
            '" /> <span class="input-group-text bg-transparent border-start-0"><i class="fa-regular fa-clock"></i> </span> </div></div></div><div class="col-md-3"><div class="form-group"><div class="input-group"><input type="number" value="" class="form-control border-end-0" name="price[' +
            dayname + '][]" required placeholder="' + price +
            '" /> <span class="input-group-text bg-transparent border-start-0"> <i class="fa-solid fa-dollar-sign"></i> </span> </div></div></div><div class="col-md-1"><div class="form-group"><button class="btn btn-sm btn-outline-danger" data-day-name="' + dayname + '" onclick="removeslot(' +
            counter + ',this)"><i class="fa fa-close"></i></button></div></div></div>'
        $('.' + dayname + '.extra_fields').append(html);
    });
});

function removeslot(id, el) {
    "use strict";
    $('#remove' + id).remove();
}
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
//     var start_time = $(this).parent().parent().parent().prev().find('.start.time_picker').val();
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
