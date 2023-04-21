$(function () {
    let html =
        '<a href="' + window.location.href.replace(window.location.search, '') + '/add" class="btn-custom-primary">' + plus_svg_icon + '</a>';
    $('.fixed-table-toolbar .btn-group').append(html);
})

function delete_sport(id, status, url) {
    "use strict";
    swalWithBootstrapButtons.fire({
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
                            swal_cancelled(wrong);
                        }
                    },
                    failure: function (response) {
                        hidepreloader();
                        swal_cancelled(wrong);
                    },
                });
            }
            hidepreloader();
        });
}
