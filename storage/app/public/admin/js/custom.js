// Preloader
$(window).on("load", function () {
    "use strict";
    $("#status").delay(500).fadeOut("slow"),
        $("#preloader").delay(500).fadeOut("slow");
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
    swalWithBootstrapButtons.fire("Cancelled", title, "error");
    // Swal.fire({
    //     icon: "error",
    //     title: "Oops...",
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
