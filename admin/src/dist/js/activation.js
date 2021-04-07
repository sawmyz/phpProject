$(document).on('click', ".status-change", function (e) {
    e.preventDefault();
    let action = $(this).attr('action');
    let _this = $(this);
    let type = action == 'deactivate' ? 'غیر فعال سازی' : 'فعال سازی';
    Swal.fire({
        icon: 'info',
        title: 'آیا مطمئن هستید؟',
        html: 'شما در حال ' + type + ' این مورد می باشید!',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'تایید',
        cancelButtonText: 'منصرف شدم!',
        confirmButtonColor: '#00aa21',
        reverseButtons: true,
        cancelButtonColor: 'rgba(199,0,8,0.88)',
        preConfirm: () => {
            $.ajax({
                url: 'conf/Activate',
                data: {
                    action: action,
                    item_id: $(this).attr("item_id"),
                    table_name: $(this).attr("table_name")
                },
                type: "POST",
                success: res => {
                    if (res > 0) {
                        let list;
                        if (res == 1) {
                            list = '<span class="badge badge-success m-1">لیست موارد فعال</span>';
                        } else {
                            list = '<span class="badge badge-danger m-1">لیست موارد غیرفعال</span>';
                        }
                        Swal.fire({
                            icon: 'success',
                            title: 'عملیات مورد نظر با موفقیت انجام شد!',
                            html: 'شما با موفقیت مورد انتخابی خود را به' + list + ' انتقال داید',
                            showConfirmButton: false,
                            showCloseButton: true,
                            timer: 1500,
                            timerProgressBar: true,

                            onAfterClose: () => {
                                if (res == 1) {
                                    $(_this).removeClass('btn-danger').addClass('btn-success');
                                    $(_this).attr('action', 'deactivate').attr('title', 'غیر فعال سازی')
                                    $(_this).find('i.fa').removeClass('fa-minus').addClass('fa-check')
                                    $(_this).tooltip('dispose').tooltip();
                                } else {
                                    $(_this).removeClass('btn-success').addClass('btn-danger');
                                    $(_this).attr('action', 'activate').attr('title', 'فعال سازی')
                                    $(_this).tooltip('dispose').tooltip();
                                    $(_this).find('i.fa').removeClass('fa-check').addClass('fa-minus')
                                }
                            }
                        })
                    }
                }
            })
        }
    });
});
$(document).on('click', ".softDelete", function (e) {
    e.preventDefault();
    let _this = $(this), id = $(_this).attr("item_id"), table = $(_this).attr("table_name"), text = $(_this).attr("title");
    Swal.fire({
        icon: 'info',
        title: 'آیا مطمئن هستید؟',
        html: `شما در حال ${text} برای سفارش کد ${id.toFa()} هستید`,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'تایید',
        cancelButtonText: 'منصرف شدم!',
        confirmButtonColor: '#00aa21',
        reverseButtons: true,
        cancelButtonColor: 'rgba(199,0,8,0.88)',
        preConfirm: res => {
            $.ajax({
                url: "softDelete",
                type: "POST",
                data: {
                    item_id: id,
                    table_name: table,
                },
                success: res => {

                    if (res.status){
                        Swal.fire({
                            icon: 'success',
                            title: 'عملیات مورد نظر با موفقیت انجام شد!',
                            html: `شما برای سفارش کد ${id} اعلام کنسلی کردید!`,
                            showConfirmButton: false,
                            showCloseButton: true,
                            timer: 1500,
                            timerProgressBar: true,
                        })
                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'خطایی رخ داد',
                            html: `اعلام کنسلی برای سفارش ${id} با خطا مواجه شد`,
                            showConfirmButton: false,
                            showCloseButton: true,
                            timer: 1500,
                            timerProgressBar: true,
                        })
                    }
                }
            });
        }
    });
})
