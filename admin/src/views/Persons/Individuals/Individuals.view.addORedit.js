$("#individual_mobile").on('input', function () {

    $.ajax({
        url: 'controllers/Persons/Individuals/Individuals',
        type: 'POST',
        data: {
            mobile: $(this).val(),
            controller_type: 'uniqeMobile',
        },
        success: res => {
            if (res === 'true') {
                Swal.fire({
                    icon: 'error',
                    title: 'خطایی رخ داد!',
                    text: 'شماره موبایل تکراری است',
                    showConfirmButton: false,
                    showCloseButton: true
                })
                $(this).val('');
            }
        }
    });
});
