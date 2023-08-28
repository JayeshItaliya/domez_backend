var min_time = '';
var max_time = '';
var start_time = $('#start_time').val();
var my_interval = 60;

if (document.getElementById('days')) {
    $('#days').selectpicker();
}
if (document.getElementById('field')) {
    $('#field').selectpicker();
}
$(function () {
    "use strict";
    $('.start.time_picker').timepicker({
        interval: my_interval,
        dynamic: false,
        dropdown: true,
        scrollbar: true,
        timeFormat: 'HH:mm',
        change: function (time) {
            var element = $(this);
            var timepicker = element.timepicker();

            var start_time = timepicker.format(time);
            var currentDate = new Date();
            var day = currentDate.getDate();
            var month = currentDate.getMonth() + 1;
            var year = currentDate.getFullYear();
            var dateString = year + "-" + month + "-" + day;
            start_time = new Date(dateString + " " + start_time);
            start_time.setMinutes(start_time.getMinutes() + 60);

            $('.end.time_picker').val('');
            $('.end.time_picker').timepicker('destroy');
            $('.end.time_picker').timepicker({
                interval: my_interval,
                dynamic: false,
                dropdown: true,
                scrollbar: true,
                timeFormat: 'HH:mm',
                startTime: start_time,
                minTime: start_time,
            });
        }
    });
    if ($.trim($('.end.time_picker').val()) != "") {
        $('.end.time_picker').timepicker({
            interval: my_interval,
            dynamic: false,
            dropdown: true,
            scrollbar: true,
            timeFormat: 'HH:mm',
            startTime: start_time,
        });
    }
    if (is_vendor || is_employee || is_provider) {
        let html =
            '<a href="' + window.location.href.replace(window.location.search, '') + '/add" class="btn-custom-primary">' + plus_svg_icon + '</a>';
        $('.fixed-table-toolbar .btn-group').append(html);
    }
});
$('#start_date').on('change', function () {
    "use strict";
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
}).change();;
$('#from_age').on('change', function () {
    "use strict";
    var from_age = parseInt($(this).val());
    if (from_age == '') {
        $("#to_age").attr('disabled', true);
        return false;
    }
    $('#to_age option:not(:first)').remove();
    $('#to_age option:first').attr('disabled', false);
    if (from_age == 89) {
        $('#to_age').append('<option value="' + from_age + '" selected >' + from_age + '</option>');
        $('#to_age option:first').attr('disabled', true);
        return false;
    }
    from_age += 1;
    for (var i = from_age; i <= 90; i++) {
        let selected = $.trim($('#to_age').attr('data-to-age')) == i ? 'selected' : '';
        $('#to_age').append('<option value="' + i + '"  ' + selected + ' >' + i + '</option>');
    }
    $('#to_age option:first').attr('disabled', true);
}).change();
$('#min_player').on('change', function () {
    "use strict";
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
    "use strict";
    min_time = $(this).find(':selected').attr('data-start-time');
    max_time = $(this).find(':selected').attr('data-end-time');
    if (start_time == '') {
        start_time = $(this).find(':selected').attr('data-start-time');
    }
    my_interval = $.trim($(this).find(':selected').attr('data-slot-duration')) == 2 ? 90 : 60;
    $.ajax({
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
                append_days(response.working_days)
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
$('body').on('change', '.radio-editer input[type=radio]', function () {
    "use strict";
    getfields($(this).val());
});

function getfields(sport) {
    "use strict";
    if ($.trim(sport) == "") {
        sport = $('.radio-editer').find(':checked').val();
    }
    $.ajax({
        url: $('#dome').attr('data-next'),
        data: {
            id: $('#dome').find(':selected').val(),
            sport: sport,
        },
        method: 'GET',
        success: function (response) {
            if (response.status == 1) {
                append_fields(response.fieldsdata)
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

function append_fields(options) {
    "use strict";
    var $select = $('#field');
    $select.empty();
    if (options.length > 0) {
        $.each(options, function (key, value) {
            var selected__ = $.inArray(value.id, field_selected) !== -1 ? true : false;
            $select.append($('<option>', {
                value: value.id,
                text: value.name,
                selected: selected__
            }));
        });
    } else {
        $select.append($('<option>', {
            value: '',
            text: no_data,
            selected: true,
            disabled: true,
        }));
    }
    $select.selectpicker('refresh');
}

function append_days(options) {
    "use strict";
    const daysMap = {};
    options.forEach(dayObj => {
        var dayShort = Object.keys(dayObj)[0];
        var dayFullName = dayObj[dayShort];
        daysMap[dayShort] = dayFullName;
    });
    var $select = $('#days');
    $select.empty();
    $.each(daysMap, function (key, value) {
        var selected_ = $.inArray(key, days_selected) !== -1 ? true : false;
        $select.append($('<option>', {
            value: key,
            text: value,
            selected: selected_
        }));
    });
    $select.selectpicker('refresh');
}
