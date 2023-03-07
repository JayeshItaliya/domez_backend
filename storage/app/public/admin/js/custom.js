// Preloader
$(window).on("load", function () {
    "use strict";
    $("#status").delay(500).fadeOut("slow"),
        $("#preloader").delay(500).fadeOut("slow");
});

$(function() {
    $('form, input, textarea').attr("autocomplete", 'off');


    $('#bootstrapTable').bootstrapTable({
        toolbar: ".toolbar",
        clickToSelect: false,
        showRefresh: false,
        search: true,
        showToggle: false,
        showColumns: false,
        pagination: true,
        searchAlign: 'right',
        pageSize: 10,
        clickToSelect: false,
        pageList: [10, 25, 50, 100]
    });
    $('#bootstrapTable').removeClass('table-bordered');
});

// Common for all sweetalerts
const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success mx-2",
        cancelButton: "btn btn-danger mx-2",
    },
    buttonsStyling: false,
});

function swal_cancelled(issettitle) {
    "use strict";
    var title = wrong;
    if (issettitle) {
        title = "" + issettitle + "";
    }
    swalWithBootstrapButtons.fire(oops, title, "error");
    // Swal.fire({
    //     icon: "error",
    //     title: opps,
    //     text: wrong,
    // });
}

function showpreloader() {
    $("#preloader , #status").show();
}

function hidepreloader() {
    $("#preloader , #status").hide();
}

function logout(url) {
    "use strict";
    swalWithBootstrapButtons
        .fire({
            title: are_you_sure,
            icon: "warning",
            confirmButtonText: yes,
            cancelButtonText: no,
            showCancelButton: true,
            reverseButtons: true,
        })
        .then((result) => {
            showpreloader();
            if (result.isConfirmed) {
                window.location = url;
            }
            hidepreloader();
        });
}

function change_status(id, status, url) {
    "use strict";
    swalWithBootstrapButtons
        .fire({
            title: are_you_sure,
            icon: "warning",
            confirmButtonText: yes,
            cancelButtonText: no,
            showCancelButton: true,
            reverseButtons: true,
        })
        .then((result) => {
            showpreloader();
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: url,
                    data: {
                        id: id,
                        status: status,
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response == 1) {
                            hidepreloader();
                            toastr.success("Success");
                            location.reload();
                        } else {
                            hidepreloader();
                            swal_cancelled(wrong)
                        }
                    },
                    failure: function (response) {
                        hidepreloader();
                        swal_cancelled(wrong)
                    },
                });
            }
            hidepreloader();
        });
}
