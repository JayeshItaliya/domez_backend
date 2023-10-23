var my_interval = 60;
var {
    min_time,
    max_time,
    start_time,
    end_max_time,
    lastOpenedAccordion
} = '';
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
    my_interval = $.trim($(this).find(':selected').attr('data-slot-duration')) == 2 ? 90 : 60;
    if (start_time == '') {
        start_time = min_time;
    }
    $.ajax({
        url: $(this).attr('data-next'),
        data: {
            id: $(this).val(),
            type: $(this).attr('data-from'),
        },
        method: 'GET',
        beforeSend: function (response) {
            $('.slot-days').html(bs_spinner);
            $('#sport option:not(:first)').remove();
        },
        success: function (response) {
            if (response.status == 1) {
                if (response.sportsdata.length > 0) {
                    $.each(response.sportsdata, function (arrayIndex, elementValue) {
                        let selected = $.trim($('#sport').attr('data-sport-selected')) == elementValue.id ? 'selected' : '';
                        $('#sport').append('<option value="' + elementValue.id + '"  ' + selected + ' >' + elementValue.name + '</option>');
                    });
                } else {
                    $('#sport').append('<option value="" selected disabled>' + no_data +
                        '</option>');
                }
                $('.slot-days').html(response.slotdayshtml)
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
$('#storesetprices').on('submit', function (event) {
    "use strict";
    event.preventDefault();
    var check = 1;
    $.each($('#storesetprices select, #storesetprices input'), function (indexInArray, valueOfElement) {
        if ($.trim(valueOfElement.value) == '') {
            $(this).addClass('is-invalid').focus();
            if ($(this).parent().hasClass('input-group')) {
                $(this).next().addClass('border-danger')
            }
            if ($(this).hasClass('time_picker')) {
                $(this).parent().parent().parent().parent().parent().parent().parent().prev().find('button').click();
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
    var formData = new FormData(this);
    $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        beforeSend: function () {
            showpreloader();
        },
        success: function (response) {
            hidepreloader();
            if (response.status == 1) {
                toastr.success(response.message);
                if (response.url) {
                    location.href = response.url;
                }
                $('#storesetprices').trigger("reset");
            } else {
                toastr.error(response.message);
            }
            return false;
        },
        error: function (e) {
            hidepreloader();
            toastr.error(wrong);
            return false;
        },
    });
});
$(document).on('click', ".accordion-header", function () {
    var st = $(lastOpenedAccordion + ' .card-body .extra_fields').find('.start.time_picker:last').val();
    var et = $(lastOpenedAccordion + ' .card-body .extra_fields').find('.end.time_picker:last').val();
    if (($.trim(st) == '' && $.trim(et) == '') || ($.trim(st) != '' && $.trim(et) == '') || ($.trim(st) == '' && $.trim(et) != '')) {
        var cl = $(lastOpenedAccordion + ' .card-body .extra_fields').find('.end.time_picker:last');
        $(cl).parent().parent().parent().parent().remove();
    }
    lastOpenedAccordion = $(this).find('.accordion-button').attr('data-bs-target');
    min_time = $(this).attr('data-start-time');
    max_time = $(this).attr('data-end-time');

    var currentDate = new Date().toISOString().slice(0, 10);
    var endTime = new Date(currentDate + ' ' + max_time);
    endTime.setMinutes(endTime.getMinutes() - 30);
    max_time = ('0' + endTime.getHours()).slice(-2) + ':' + ('0' + endTime.getMinutes()).slice(-2);

    if ($(this).next().find('.start.time_picker').length == 1) {
        var checkval = $.trim($(this).next().find('.end.time_picker').val());
        if (checkval != '') {
            min_time = checkval;
        }
    } else if ($(this).next().find('.start.time_picker').length > 1) {
        var checkval1 = $.trim($(this).next().find('.end.time_picker:last').val());
        if (checkval1 != '') {
            min_time = checkval1;
        }
    }
    start_time = min_time;
});
$(document).on('focus', ".start.time_picker", function () {
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
            $("body").find('.btn-reset-slots[data-days-name=' + $(element).attr('data-day-name') + ']').removeClass("d-none");

            var dmt = $("body").find('.appendbtn[data-day-name=' + $(element).attr('data-day-name') + ']').attr("data-day-max-time");
            max_time = dmt;

            var timepicker = element.timepicker();
            var set_last_val = '';
            start_time = timepicker.format(time);
            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();
            var dateString = year + '-' + month + '-' + day;
            start_time = new Date(dateString + ' ' + start_time);
            start_time.setMinutes(start_time.getMinutes() + 60);
            var extended_time = start_time;
            start_time = start_time.toLocaleString('en-US', {
                hour: 'numeric',
                minute: 'numeric',
                hour24: true
            });
            var dateObj = new Date(dateString + ' ' + start_time);
            dateObj.setMinutes(dateObj.getMinutes() + 30);
            var end_max_string = dateObj;
            var end_max_time = dateObj.toLocaleString('en-US', {
                hour: 'numeric',
                minute: 'numeric',
                hour24: true
            });
            var check_start_time = new Date(dateString + ' ' + start_time);
            var start_time_minutes = check_start_time.getHours() * 60 + check_start_time.getMinutes();
            var check_max_time = new Date(dateString + ' ' + max_time);
            var max_time_minutes = check_max_time.getHours() * 60 + check_max_time.getMinutes();

            var currentDate = new Date().toISOString().slice(0, 10);
            var specificTime = currentDate + ' ' + max_time;

            var start_time__ = new Date(extended_time);
            var end_max_string__ = new Date(end_max_string);
            var currentDate__ = new Date(specificTime);

            // if ( (start_time__.toDateString() > currentDate__.toDateString()) || (end_max_string__.toDateString() > currentDate__.toDateString()) ) {
            if ((start_time__ > currentDate__) || (end_max_string__ > currentDate__)) {
                set_last_val = max_time
                start_time = max_time;
                end_max_time = max_time;
            } else {
                if (start_time_minutes <= max_time_minutes) {
                    if (start_time_minutes == max_time_minutes) {
                        end_max_time = start_time;
                        disable_btn($(element).attr('data-day-name'));
                    } else {
                        var check_end_max_time = new Date(dateString + ' ' + end_max_time);
                        var end_max_time_minutes = check_end_max_time.getHours() * 60 + check_end_max_time.getMinutes();
                        if (end_max_time_minutes <= max_time_minutes) {
                            if (end_max_time_minutes == max_time_minutes) {
                                end_max_time = max_time;
                                disable_btn($(element).attr('data-day-name'));
                            } else {}
                        } else {
                            end_max_time = max_time;
                            disable_btn($(element).attr('data-day-name'));
                        }
                    }
                } else {
                    start_time = max_time;
                    end_max_time = max_time;
                }
            }
            $(element).parent().parent().parent().next().find('.end.time_picker').val(set_last_val);
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
                        disable_btn($(element).attr('data-day-name'));
                    }
                }
            });
        }
    });
});
$(function () {
    "use strict";
    $('.ui-timepicker-container.ui-timepicker-standard').css('z-index', '9');
    if (is_vendor || is_employee) {
        let html =
            '<a href="' + window.location.href.replace(window.location.search, '') + '/add" class="btn-custom-primary">' + plus_svg_icon + '</a>';
        $('.fixed-table-toolbar .btn-group').append(html);
    }
    var counter = 1;
    $(document).on('click', ".appendbtn", function () {
        "use strict";
        counter++;
        var dayname = $(this).attr('data-day-name');
        var day_max_time = $(this).attr('data-day-max-time');
        var check = 1;
        min_time = start_time;
        var last_endtime = $(this).parent().parent().parent().parent().find('.end.time_picker:last').val();
        if ($.trim(last_endtime) != '') {
            start_time = last_endtime;
        }
        $('.card-body-' + dayname + '  input').each(function () {
            if ($(this).val() === '' || $(this).val() == 0) {
                check = 0;
                $(this).addClass('is-invalid');
                $(this).parent().find('.input-group-text').addClass('border-danger');
            } else {
                $(this).removeClass('is-invalid');
                $(this).parent().find('.input-group-text').removeClass('border-danger');
            }
            if (check == 0) {
                return false;
            }
        });
        if (check == 0) {
            return false;
        }
        if (last_endtime == max_time) {
            return false;
        }

        var currentDate = new Date().toISOString().slice(0, 10);
        var endTime = new Date(currentDate + ' ' + day_max_time);
        endTime.setMinutes(endTime.getMinutes() - 30);
        max_time = ('0' + endTime.getHours()).slice(-2) + ':' + ('0' + endTime.getMinutes()).slice(-2);

        var html =
            '<div class="row my-2 ' + dayname + '-row " id="remove' + counter +
            '"><div class="col-md-4"><div class="form-group"><div class="input-group"><input type="text" class="form-control start time_picker border-end-0" name="start_time[' +
            dayname + '][]" data-day-name="' + dayname + '" required placeholder="' + start_time_title +
            '" /> <span class="input-group-text bg-transparent border-start-0"><i class="fa-regular fa-clock"></i> </span> </div></div></div><div class="col-md-4"><div class="form-group"><div class="input-group"><input type="text" class="form-control end time_picker border-end-0" name="end_time[' +
            dayname + '][]" data-day-name="' + dayname + '" required placeholder="' + end_time_title +
            '" /> <span class="input-group-text bg-transparent border-start-0"><i class="fa-regular fa-clock"></i> </span> </div></div></div><div class="col-md-3"><div class="form-group"><div class="input-group"><input type="text" class="form-control numbers_only  border-end-0" value="" name="price[' +
            dayname + '][]" required placeholder="' + price +
            '" /> <span class="input-group-text bg-transparent border-start-0"> <i class="fa-solid fa-dollar-sign"></i> </span> </div></div></div><div class="col-md-1"><div class="form-group"><button class="btn btn-sm btn-outline-danger" data-day-name="' + dayname + '" onclick="removeslot(' +
            counter + ',this)"><i class="fa fa-close"></i></button></div></div></div>'
        $('.' + dayname + '.extra_fields').append(html);
    });
});

function disable_btn(dayname) {
    $("button[data-day-name='" + dayname + "'].appendbtn").attr("disabled", true);
    $("body").find('.btn-reset-slots[data-days-name=' + dayname + ']').removeClass("d-none");
}

function reset_slots(el) {
    "use strict";
    $('.' + $(el).attr('data-days-name') + '.extra_fields').html('');
    var last_time = $('.' + $(el).attr('data-days-name') + '-row').find('.end.time_picker').val();
    start_time = last_time;
    $('.' + $(el).attr('data-days-name') + '-row').find('input').val('');
    $('.' + $(el).attr('data-days-name') + '-row').find('.appendbtn').attr('disabled', false);
    $(el).addClass('d-none');
}

function removeslot(id, el) {
    "use strict";
    var st = $(el).parent().parent().parent().parent().find('.start.time_picker:last').val();
    var et = $(el).parent().parent().parent().parent().find('.end.time_picker:last').val();
    if (($.trim(st) == '' && $.trim(et) == '') || ($.trim(st) != '' && $.trim(et) == '') || ($.trim(st) == '' && $.trim(et) != '')) {
        var cl = $(el).parent().parent().parent().parent().find('.end.time_picker:last');
        $(cl).parent().parent().parent().parent().remove();
    }
    var el = $('#remove' + id);
    el.remove();
}
