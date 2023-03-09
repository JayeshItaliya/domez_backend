$('#start_date').on('change', function () {
    if ($.trim($(this).val()) != "") {
        $('#end_date').attr('disabled', false);
        $('#end_date').attr('min', $(this).val());
    }
}).change();
$('body').on('focus', ".time_picker", function () {
    $(this).timepicker({
        interval: 60,
    });
});
$(function () {
    $(".time_picker").timepicker({
        interval: 60,
    });
    var counter = 1;
    $(".appendbtn").on('click', function () {
        counter++;
        var dayname = $(this).attr('data-day-name');
        var html =
            '<div class="row my-2" id="remove' + counter +
            '"><div class="col-md-4"><div class="form-group"><div class="input-group"><input type="text" class="form-control time_picker border-end-0" name="start_time[' +
            dayname + '][]" placeholder="' + start_time +
            '" required /> <span class="input-group-text bg-transparent border-start-0"><i class="fa-regular fa-clock"></i> </span> </div></div></div><div class="col-md-4"><div class="form-group"><div class="input-group"><input type="text" class="form-control time_picker border-end-0" name="end_time[' +
            dayname + '][]" placeholder="' + end_time +
            '" required /> <span class="input-group-text bg-transparent border-start-0"><i class="fa-regular fa-clock"></i> </span> </div></div></div><div class="col-md-3"><div class="form-group"><div class="input-group"><input type="number" value="0" class="form-control border-end-0" name="price[' +
            dayname + '][]" placeholder="' + price +
            '"> <span class="input-group-text bg-transparent border-start-0"> <i class="fa-solid fa-dollar-sign"></i> </span> </div></div></div><div class="col-md-1"><div class="form-group"><a class="btn-custom-danger cursor-pointer" onclick="removeslot(' +
            counter + ')"><i class="fa fa-close"></i></a></div></div></div>'
        $('.' + dayname + '.extra_fields').append(html);
    });
});

function removeslot(id) {
    $('#remove' + id).remove();
}
$('#dome').on('change', function () {
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
                $('#sport option:not(:first)').remove();
                if (response.sportsdata.length > 0) {
                    $.each(response.sportsdata, function (arrayIndex, elementValue) {
                        $('#sport').append('<option value="' + elementValue.id + '">' +
                            elementValue.name + '</option>');
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
});
$('#storesetprices').on('submit', function () {
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
