if (is_vendor) {
    $(document).ready(function () {
        let html =
            '<a href="' + window.location.href.replace(window.location.search, '') +
            '/add" class="btn-custom-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg></a>';
        $('.fixed-table-toolbar .btn-group').append(html);
    })
}
function fieldinactive(id, type, url) {
    "use strict";
    swalWithBootstrapButtons
        .fire({
            icon: type == 2 ? '' : 'warning',
            title: type == 2 ? select_date : are_you_sure,
            html: type == 2 ? '<input id="swal-input1" class="swal2-input form-control mx-auto w-100" type="date" min="' + min_date + '">' : '',
            showCancelButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            confirmButtonText: type == 2 ? save_date : yes,
            cancelButtonText: type == 2 ? cancel : no,
            reverseButtons: true,
            showLoaderOnConfirm: true,
            preConfirm: function () {
                var date = '';
                if (type == 2) {
                    date = $('#swal-input1').val();
                    if (!date) {
                        Swal.disableLoading();
                        $('.swal2-input').addClass('is-invalid');
                        return false;
                    }
                    $('.swal2-input').removeClass('is-invalid');
                }
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {
                            id: id,
                            date: date,
                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 1) {
                                location.reload();
                            } else {
                                Swal.disableLoading();
                                Swal.showValidationMessage(response.message);
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
                $('#sport_id option:not(:first)').remove();
                if (response.sportsdata.length > 0) {
                    $.each(response.sportsdata, function (arrayIndex, elementValue) {
                        let selected = $.trim($('#sport_id').attr('data-sport-selected')) == elementValue.id ? 'selected' : '';
                        $('#sport_id').append('<option value="' + elementValue.id + '"  ' + selected + ' >' + elementValue.name + '</option>');
                    });
                } else {
                    $('#sport_id').append('<option value="" selected disabled>' + no_data +
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
