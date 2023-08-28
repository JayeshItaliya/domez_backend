$(function () {
    $(".filter_content").appendTo($(".fixed-table-toolbar .float-left"));
    if ($('body').find('.date-range-picker').length > 0) {
        $('.date-range-picker').flatpickr({
            mode: "range",
            placeHolder: "Select Date",
            dateFormat: "Y-m-d",
            onClose: function (selectedDates, dateStr, instance) {
                window.location.href = window.location.href.replace(window.location.search, '') +
                    "?type=" + $('#type').val() + "&filter=" + $('#filter').val() + "&dates=" +
                    dateStr;
            }
        });
    }
});


$('.main-slots').on('change', function () {
    "use strict";
    $.ajax({
        url: location.href,
        data: {
            booking_id: booking_id,
            slot_id: $(this).attr('data-slot-id'),
        },
        method: 'get',
        beforeSend: function (response) {
            $('.' + $(this).attr('data-show-target')).show();
            $('.lists').html(bs_spinner);
        },
        success: function (response) {
            if (response.status == 0) {
                toastr.error(response.message);
            } else {
                $('.lists').html(response.slots);
                toastr.success(response.message);
            }
            return false;
        },
        error: function (e) {
            console.log(e);
            toastr.error(wrong);
            return false;
        }
    });
});
var my_val = '';
var old_slot_id = '';
var new_slot_id = '';
var slot_price = '';
var slot = '';

function manageslot(el) {
    my_val = $(el).val();
    old_slot_id = $(el).attr('data-old-slot-id');
    new_slot_id = $(el).attr('data-new-slot-id');
    slot_price = $(el).attr('data-slot-price');
    slot = $(el).attr('data-slot');
    $('.lists button[type="button"]:hidden').show();
}

function submitdata() {
    var html = $('.lists').html();
    $.ajax({
        url: location.href,
        data: {
            manage_slot: 1,
            booking_id: booking_id,
            slot_time: my_val,
            slot: slot,
            old_slot_id: old_slot_id,
            new_slot_id: new_slot_id,
            slot_price: slot_price,
        },
        method: 'get',
        beforeSend: function (response) {
            $('.btn-close').prop('disabled', true);
            $('.lists').html(bs_spinner);
        },
        success: function (response) {
            if (response.status == 0) {
                $('.lists').html(html);
                $('.lists button[type="button"]').hide();
                $('.btn-close').prop('disabled', false);
                toastr.error(response.message);
            } else {
                toastr.success(response.message);
                location.reload()
            }
            return false;
        },
        error: function (e) {
            $('.lists').html(html);
            $('.btn-close').prop('disabled', false);
            $('.lists button[type="button"]').hide();
            toastr.error(wrong);
            return false;
        }
    });
}
