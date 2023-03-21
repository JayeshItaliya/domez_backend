if (is_vendor) {
    $(document).ready(function () {
        let html =
            '<a href="' + window.location.href.replace(window.location.search, '') +
            '/add" class="btn-custom-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg></a>';
        $('.fixed-table-toolbar .btn-group').append(html);
    })
}

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
