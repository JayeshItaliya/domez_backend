$(function () {
    "use strict";
    $(".time_picker").timepicker({
        interval: 60,
    });
    if (is_vendor) {
        let html =
            '<a href="' + window.location.href.replace(window.location.search, '') + '/add" class="btn-custom-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg></a>';
        $('.fixed-table-toolbar .btn-group').append(html);
    }

    var counter = 1;
    $(".appendbtn").on('click', function () {
        "use strict";
        counter++;
        var dayname = $(this).attr('data-day-name');
        var html =
            '<div class="row my-2" id="remove' + counter +
            '"><div class="col-md-4"><div class="form-group"><div class="input-group"><input type="text" class="form-control time_picker border-end-0" name="start_time[' +
            dayname + '][]" placeholder="' + start_time +
            '" /> <span class="input-group-text bg-transparent border-start-0"><i class="fa-regular fa-clock"></i> </span> </div></div></div><div class="col-md-4"><div class="form-group"><div class="input-group"><input type="text" class="form-control time_picker border-end-0" name="end_time[' +
            dayname + '][]" placeholder="' + end_time +
            '" /> <span class="input-group-text bg-transparent border-start-0"><i class="fa-regular fa-clock"></i> </span> </div></div></div><div class="col-md-3"><div class="form-group"><div class="input-group"><input type="number" value="0" class="form-control border-end-0" name="price[' +
            dayname + '][]" placeholder="' + price +
            '" /> <span class="input-group-text bg-transparent border-start-0"> <i class="fa-solid fa-dollar-sign"></i> </span> </div></div></div><div class="col-md-1"><div class="form-group"><a class="btn-custom-danger cursor-pointer" onclick="removeslot(' +
            counter + ')"><i class="fa fa-close"></i></a></div></div></div>'
        $('.' + dayname + '.extra_fields').append(html);
    });
});

function removeslot(id) {
    "use strict";
    $('#remove' + id).remove();
}
$('#start_date').on('change', function () {
    "use strict";
    if ($.trim($(this).val()) != "") {
        $('#end_date').attr('disabled', false);
        $('#end_date').attr('min', $(this).val());
    }
}).change();
$('body').on('focus', ".time_picker", function () {
    "use strict";
    $(this).timepicker({
        interval: 60,
    });
});
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
