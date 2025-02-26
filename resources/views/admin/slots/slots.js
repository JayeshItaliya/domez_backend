$(function () {
    $(".date-range-picker-slots").flatpickr({
        mode: "range",
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "j F, Y",
        dateFormat: "Y-m-d",
        change: function (time) {
            $('.slot-content').html('');
            $('.btn-block-slots').hide();
            $('.btn-unblock-slots').hide();
        }
    });
    manageselection();
});
$(document).on("change", ".d-none.blockable-slots, .d-none.unblockable-slots", function () {
    manageselection();
});
function manageselection() {
    if ($(".d-none.blockable-slots:checked").length > 0) {
        $(".btn-block-slots").attr("disabled", false).show();
    } else {
        $(".btn-block-slots").attr("disabled", true).hide();
    }
    if ($(".d-none.unblockable-slots:checked").length > 0) {
        $(".btn-unblock-slots").attr("disabled", false).show();
    } else {
        $(".btn-unblock-slots").attr("disabled", true).hide();
    }
}

$(document).on("change","#fetchslotsform #dome, #fetchslotsform #sport, #fetchslotsform #slot_type", function () {
    $('.slot-content').html('');
    $('.btn-block-slots').hide();
});
$("#dome").on("change", function () {
    "use strict";
    if ($.trim($(this).val()) == "") {
        return false;
    }
    $.ajax({
        url: $(this).attr("data-next"),
        data: {
            id: $(this).val(),
        },
        method: "POST",
        success: function (response) {
            if (response.status == 1) {
                $("#sport option:not(:first)").remove();
                if (response.sportsdata.length > 0) {
                    $.each(response.sportsdata, function (arrayIndex, elementValue) {
                        $("#sport").append('<option value="' + elementValue.id + '" >' + elementValue.name + "</option>" );
                    });
                } else {
                    $("#sport").append('<option value="" selected disabled>' +no_data +"</option>");
                }
            } else {
                toastr.error(response.message);
                return false;
            }
        },
        error: function (e) {
            toastr.error(wrong);
            return false;
        },
    });
});

$(".btn-unblock-slots").on("click", function (event) {
    "use strict";
    var selectedslots = $(".slot-content .d-none.unblockable-slots:checked").map(function () {
            return $(this).data("slot-id");
        }).get().join(",");
    if ($.trim(selectedslots) == "") {
        $(".btn-unblock-slots").attr("disabled", true).hide();
        return false;
    }
    var sum = 0;
    $(".slot-content .d-none.unblockable-slots:checked").each(function () {
        sum += parseFloat($(this).attr("data-slot-price"));
    });
    var aurl = $(this).attr("data-action");
    var dome_name = $("#fetchslotsform #dome").find(':selected').attr("data-dome-name");
    var total_slots = $(".slot-content .d-none.unblockable-slots:checked").length;
    var selected_slots = $(".slot-content .d-none.unblockable-slots:checked").map(function () {
            return $(this).data("slot");
        }).get().join(",");
        callajax(selectedslots,sum,aurl,dome_name,total_slots,selected_slots);
});
$(".btn-block-slots").on("click", function (event) {
    "use strict";
    var selectedslots = $(".slot-content .d-none.blockable-slots:checked").map(function () {
            return $(this).data("slot-id");
        }).get().join(",");
    if ($.trim(selectedslots) == "") {
        $(".btn-block-slots").attr("disabled", true).hide();
        return false;
    }
    var sum = 0;
    $(".slot-content .d-none.blockable-slots:checked").each(function () {
        sum += parseFloat($(this).attr("data-slot-price"));
    });
    var aurl = $(this).attr("data-action");
    var dome_name = $("#fetchslotsform #dome").find(':selected').attr("data-dome-name");
    var total_slots = $(".slot-content .d-none.blockable-slots:checked").length;
    var selected_slots = $(".slot-content .d-none.blockable-slots:checked").map(function () {
            return $(this).data("slot");
        }).get().join(",");
    callajax(selectedslots,sum,aurl,dome_name,total_slots,selected_slots);
});
function callajax(selectedslots,sum,aurl,dome_name,total_slots,selected_slots){
    swalWithBootstrapButtons
        .fire({
            icon: "warning",
            title: are_you_sure,
            showCancelButton: !0,
            allowOutsideClick: !1,
            allowEscapeKey: !1,
            confirmButtonText: yes,
            cancelButtonText: no,
            reverseButtons: !0,
            showLoaderOnConfirm: !0,
            html:
                '<ul class="list-group list-group-flush text-start"><li class="list-group-item"> <b> Dome Name: </b>' + dome_name + '</li><li class="list-group-item"> <b> Selected Slots('+total_slots+'): </b>' + selected_slots + '<li class="list-group-item"> <b> Total Amount </b> : <b>$' + sum + '</b></li></ul>',
            preConfirm: function () {
                return new Promise(function (o, n) {
                    $.ajax({
                        url: aurl,
                        type: "POST",
                        data: {
                            ids: selectedslots,
                        },
                        success: function (response) {
                            if (response.status == 0) {
                                swal_cancelled(response.message);
                            }else if (response.status == 2) {
                                swal_cancelled(response.message);
                                $("#fetchslotsform").submit();
                            } else {
                                $(".btn-block-slots, .btn-unblock-slots").attr("disabled", true).hide();
                                Swal.close();
                                toastr.success(response.message);
                                $("#fetchslotsform").submit();
                            }
                            return false;
                        },
                        error: function (xhr, status, error) {
                            swal_cancelled(wrong);
                            return false;
                        },
                    });
                });
            },
        })
        .then((t) => {
            t.isConfirmed || (t.dismiss, Swal.DismissReason.cancel);
        });
}
$("#fetchslotsform").on("submit", function (event) {
    "use strict";
    event.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: $(this).attr("action"),
        type: $(this).attr("method"),
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        beforeSend: function (response) {
            $(".slot-content").html(bs_spinner);
        },
        success: function (response) {
            var html = "";
            if (response.status == 0) {
                toastr.error(response.message);
            } else {
                html += response.slotshtml;
            }
            $(".slot-content").html(html);
            $(".btn-block-slots").attr("disabled", true).hide();
            return false;
        },
        error: function (xhr, status, error) {
            toastr.error(wrong);
            $(".slot-content").html("");
            return false;
        },
    });
});
