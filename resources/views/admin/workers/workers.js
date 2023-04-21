if (is_vendor) {
    $(function () {
        let html =
            '<a class="btn-custom-primary" href="javascript:void(0);" data-bs-target="#addworker" data-bs-toggle="modal">' + plus_svg_icon + '</a>';
        $('.fixed-table-toolbar .btn-group').append(html);
    })
    $('#store_worker').on('submit', function () {
        var check = 1;
        $.each($('#store_worker .form-group input'), function (indexInArray, valueOfElement) {
            if ($.trim(valueOfElement.value) == '') {
                $(this).addClass('is-invalid').focus();
                check = 0;
            } else {
                $(this).removeClass('is-invalid');
            }
            if (check == 0) {
                return false;
            }
        });
        if (check == 0) {
            return false;
        }
        showpreloader();
    });
}

function edit_worker(el) {
    "use strict";
    $('#w_').val($(el).attr('data-show-id'));
    $('#worker_name').val($(el).attr('data-show-name'));
    $('#worker_email').val($(el).attr('data-show-email'));
}
