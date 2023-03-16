// Preloader
$(window).on("load", function () {
    "use strict";
    $("#status").delay(500).fadeOut("slow"),
        $("#preloader").delay(500).fadeOut("slow");
});
// ------- CUSTOM FONT FAMILY --- START ----------------
$('input[name=font_family]').on('change', function () {
    var font_family = $(this).val();
    set_cookie('font_family', font_family);
});
// ------- CUSTOM FONT FAMILY --- End ----------------

// ------- CUSTOM COLOR --- START ----------------
$('.btn-change-color').on('click', function () {
    var primary_color = $('input[type="color"]#primary_color').val();
    var secondary_color = $('input[type="color"]#secondary_color').val();
    set_cookie('primary_color', primary_color, 'secondary_color', secondary_color);
})

function set_cookie(primary_color_name, primary_color, secondary_color_name, secondary_color) {
    "use strict";
    showpreloader();
    var date = new Date();
    date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000));
    var expires = "; expires=" + date.toUTCString();
    document.cookie = primary_color_name + " = " + primary_color + expires + "; path=/";
    document.cookie = secondary_color_name + " = " + secondary_color + expires + "; path=/";
    location.reload();
}

function getCookie(name) {
    "use strict";
    var cookie_name = name + "=";
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var c = cookies[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(cookie_name) == 0) return c.substring(cookie_name.length, c.length);
    }
    return;
}
$(window).on('load', function () {
    "use strict";
    var bodyStyles = window.getComputedStyle(document.body);
    if ($.trim(getCookie("primary_color")) != "") {
        document.documentElement.style.setProperty('--bs-primary', getCookie("primary_color"));
        document.documentElement.style.setProperty('--bs-primary-rgb', hexToRgb(getCookie("primary_color")));
        $('#primary_color').val(getCookie("primary_color"));
    } else {
        $('#primary_color').val($.trim(bodyStyles.getPropertyValue('--bs-primary')));
    }
    if ($.trim(getCookie("secondary_color")) != "") {
        document.documentElement.style.setProperty('--bs-secondary', getCookie("secondary_color"));
        document.documentElement.style.setProperty('--bs-secondary-rgb', hexToRgb(getCookie("secondary_color")));
        $('#secondary_color').val(getCookie("secondary_color"));
    } else {
        $('#secondary_color').val($.trim(bodyStyles.getPropertyValue('--bs-secondary')));
    }
    if ($.trim(getCookie("font_family")) != "") {
        document.documentElement.style.setProperty('--bs-font-sans-serif', getCookie("font_family"));
        document.documentElement.style.setProperty('--bs-font-sans-serif',  "'"+getCookie("font_family")+"', sans-serif");
        $("input[name=font_family][value=" + getCookie('font_family') + "]").prop("checked", true);

    } else {
        $('#font_family').val($.trim(bodyStyles.getPropertyValue('--bs-font-sans-serif')));
    }
});

function hexToRgb(hex) {
    var hexString = (hex.charAt(0) == "#") ? hex.substring(1, 7) : hex;
    var hexInt = parseInt(hexString, 16);
    var red = (hexInt >> 16) & 255;
    var green = (hexInt >> 8) & 255;
    var blue = hexInt & 255;
    return red + ", " + green + ", " + blue;
}
// ------- CUSTOM COLOR --- END ----------------

$(function () {
    $('form, input, textarea').attr("autocomplete", 'off');
    if (document.getElementById('bootstrapTable')) {
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
    }
}); // Common for all sweetalerts
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
