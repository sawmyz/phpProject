$.submit = function () {
    $("form").attr("novalidate", 'novalidate');
    $("form").attr("novalidate", true);
    $("form").submit(function (e) {
        if ($("#controller_type").val().toString() === 'delete') {
            let thi = this;
            Swal.fire({
                icon: 'warning',
                title: 'آیا مطمئن هستید؟',
                text: 'پس از انجام این عمل قادر به بازگشت آن نخواهید بود',
                showCancelButton: true,
                cancelButtonText: 'لفو',
                confirmButtonText: 'تایید',
                confirmButtonColor: '#37ca4c',
                cancelButtonColor: '#c00300',
                reverseButtons: true,
                preConfirm: () => {
                    submitForm(thi, true);
                }
            });
        } else {
            submitForm(this);
        }
        e.preventDefault();
    });


};
function submitForm(form, removeRefresh = false, controller_type = null,ajaxSuccess = null) {
    $("#fw-preloader").removeClass('loaded');
    let that = $(form), $this = form;
    let url = $($this).attr("action");
    let validationArray = [];
    if (ajaxSuccess === null){
        ajaxSuccess = res => {
            if ($('div.card-footer').find('button.refresh').length > 0){
                $("#fw_refresh_btn").click();
            }
            $(that).html(res);
            if (removeRefresh) {
                $("#fw_refresh_btn").fadeOut(250);
            }

        }
    }
    setTimeout(() => {
        $(that).find('input[fw-id^=fw_price_]').each(function () {
            $(this).val($(this).val().replace(/,/g, ''))
        });
        $(that).find('input:required').each(function () {
            if ($(this).val() === '') {
                $(this).removeClass("is-valid");
                $(this).addClass("is-invalid");
                validationArray.push(false);
            }

            $(this).on('input', function () {
                if ($(this).val() === '') {
                    $(this).removeClass("is-valid");
                    $(this).addClass("is-invalid");
                } else {
                    $(this).removeClass("is-invalid");
                    $(this).addClass("is-valid");
                }
            });
        });

        $(that).find('select:required').each(function () {
            if ($(this).val()) {
                if (parseInt($(this).val().length) === 0 || $(this).children('option:selected').val().length === 0) {
                    $(this).siblings('span').removeClass("is-valid");
                    $(this).siblings('span').addClass("is-invalid");
                    validationArray.push(false);
                }
            } else {

                $(this).siblings('span').removeClass("is-valid");
                $(this).siblings('span').addClass("is-invalid");
                validationArray.push(false);
            }
            $(this).on('change', function () {
                if (parseInt($(this).val().length) === 0 || $(this).children('option:selected').val().length === 0) {
                    $(this).siblings('span').removeClass("is-valid");
                    $(this).siblings('span').addClass("is-invalid");
                } else {
                    $(this).siblings('span').removeClass("is-invalid");
                    $(this).siblings('span').addClass("is-valid");
                }
            });
        });
        if (!validationArray.includes(false)) {
            let formData = new FormData($this);
            if (controller_type != null){
                formData.append('controller_type',controller_type);
            }

            setTimeout(() => {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    async: false,
                    success: data => {
                        $.loader();
                        ajaxSuccess(data)
                    },
                    error: error => {
                        $.loader();
                        Swal.fire({
                            icon: 'error',
                            title: 'خطایی رخ داد',
                            text: 'ثبت اطلاعات  با خطا مواجه شد!',
                            showConfirmButton: false,
                            showCloseButton: true
                        });
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            },1)
        } else {
            $.loader();
            Swal.fire({
                icon: 'warning',
                title: 'اطلاعات کامل نیست!',
                text: 'لطفا تمام اطلاعات خواسته شده (موارد اجباری با رنگ قرمز مشخص شده است) را وارد نمایید',
                showConfirmButton: false,
                showCloseButton: true
            });
        }
    }, 1);
}
