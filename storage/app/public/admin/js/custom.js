// Preloader
$(window).on("load", function () {
    "use strict";
    $("#status").delay(500).fadeOut("slow"), $("#preloader").delay(500).fadeOut("slow");
});

// Logout
function logout(url) {
    "use strict";
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success mx-2",
            cancelButton: "btn btn-danger mx-2",
        },
        buttonsStyling: false,
    });

    swalWithBootstrapButtons
        .fire({
            title: "Are You Sure?",
            icon: "warning",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            showCancelButton: true,
            reverseButtons: true,
        })
        .then((result) => {
            $("#preloader , #status").show();
            if (result.isConfirmed) {
                window.location = url;
            }
            $("#preloader , #status").hide();
        });
}

// Change Status
function change_status(id, status, url) {
    "use strict";
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success mx-2",
            cancelButton: "btn btn-danger mx-2",
        },
        buttonsStyling: false,
    });

    swalWithBootstrapButtons
        .fire({
            title: "Are You Sure?",
            icon: "warning",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            showCancelButton: true,
            reverseButtons: true,
        })
        .then((result) => {
            $("#preloader , #status").show();
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
                            $("#preloader , #status").hide();
                            toastr.success("Success");
                            location.reload();
                        } else {
                            $("#preloader , #status").hide();
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: wrong,
                            });
                        }
                    },
                    failure: function (response) {
                        $("#preloader , #status").hide();
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: wrong,
                        });
                    },
                });
            }
            $("#preloader , #status").hide();
        });
}
