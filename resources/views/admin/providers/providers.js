if (is_vendor) {
    $(function () {
        let html =
            '<a class="btn-custom-primary" href="javascript:;" data-bs-target="#addprovider" data-bs-toggle="modal"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-primary)" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg></a>';
        $('.fixed-table-toolbar .btn-group').append(html);
    });
    $('#store_provider').on('submit', function () {
        var check = 1;
        $.each($('#store_provider .form-group input'), function (indexInArray, valueOfElement) {
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
