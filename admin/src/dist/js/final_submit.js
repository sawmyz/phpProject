$(function () {
    $("#final_submit_edit").on('click', function () {
        $(this).parents('.card').find('form').submit();
    });
})
$(function () {
    class QuickAdd {
        setSelect(name){
            this.name = name;
        }
        getSelect(){
            return this.name;
        }
    }
    const Instance = new QuickAdd();
    $('.quickAddBtn').on('click', function () {
        let target = $(this).data('modal');
        let targetModal = $("#" + target);

        if ($(this).data('wait') && $(this).data('wait').toString().length > 0) {
            if ($("#" + $(this).data('wait').toString()).val() == null) {
                let name = $(this).data('before_name') || "مورد قبلی";
                Swal.fire({
                    icon: 'warning',
                    title: 'هشدار!',
                    text: `لطفا ابتدا ${name} را انتخاب کنید`,
                    showConfirmButton: false,
                    showCloseButton: true
                })
                return;
            } else {
                let waitFor = $(this).data('wait').toString();
                let element = $(targetModal).find("select#" + waitFor).parents('div.form-group')[0];
                $(element).after('<input type="hidden" name="' + waitFor + '" value="' + $("#" + $(this).data('wait').toString()).val() + '">')
                $(element).remove();
            }
        }
        let select = $($($(this).parents('.form-group')[0]).find("select")[[0]]);
        Instance.setSelect(select);
        Instance.targetModal = targetModal;
        console.log(target)
        $(targetModal).modal("show")
    });
    $(".quick-add-submit_button").on('click', function () {
        let form = $(this).parents('form.quickAddForm');
        submitForm(form.get(0), false,'addQuick',(res) => {

            let json = JSON.parse(res);
            if (json.isDone === true){
                Swal.fire({
                    icon: 'success',
                    title: 'ثبت با موفقیت انجام شد',
                        text: `ثبت ردیف با موفقیت انجام شد٬ کد مورد ثبت شده: ${json.id}`,
                    showConfirmButton: false,
                    showCloseButton: true
                })
                let name = Instance.getSelect();
                $(name).select2('destroy');
                $(name).append(json.option);
                $(name).select2();
                $(name).trigger('change');
                $(Instance.targetModal).modal('hide');
                $(name).attr("disabled", false);
            } else {
                Swal.fire({
                    icon: 'danger',
                    title: 'خطایی رخ داد',
                    text: `ثبت ردیف مورد نظر با خطا مواجه شد`,
                    showConfirmButton: false,
                    showCloseButton: true
                })
            }
        });
    });
})
