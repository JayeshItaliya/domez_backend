if (is_vendor) {
    $(document).ready(function () {
        let html =
            '<a class="btn-custom-primary" data-bs-target="#addprovider" data-bs-toggle="modal"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg></a>';
        $('.fixed-table-toolbar .btn-group').append(html);
    })
    $('#store_provider').on('submit', function () {
        if ($('#store_provider #name').val() == "") {
            $('#store_provider #name').addClass('is-invalid');
            return false;
        } else {
            $('#store_provider #name').removeClass('is-invalid');
            if ($('#store_provider #email').val() == "") {
                $('#store_provider #email').addClass('is-invalid');
                return false;
            } else {
                $('#store_provider #email').removeClass('is-invalid');
                if ($('#store_provider #password').val() == "") {
                    $('#store_provider #password').addClass('is-invalid');
                    return false;
                } else {
                    $('#store_provider #password').removeClass('is-invalid');
                }
            }
        }
        showpreloader();
    });
}

function deletevendor(id, status, url) {
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
