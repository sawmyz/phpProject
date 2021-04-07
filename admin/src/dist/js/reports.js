class ReportsClass {
    constructor() {
        this.setControllerType('getReport');
        this.setFiltersFieldName('filters');
        this.jsonData = [];
    }

    setUrl(url) {
        this.url = url;
    }

    setControllerType(controller_type) {
        this.controller_type = controller_type;
    }

    setFiltersFieldName(filter_field_name) {
        this.filter_field_name = filter_field_name;
    }

    submit() {
        let object = {};
        $("[name^=fw_report_]").each(function () {
            if (this.tagName.toString() === 'SELECT') {
                if ($(this).find('option:selected').length > 0) {
                    object[this.name.toString().replace('fw_report_', '')] = $(this).find('option:selected').val();


                }
            } else {
                if (this.value != '') {
                    switch ($(this).attr('type')) {
                        case "radio":
                        case "checkbox":
                            if ($(this).is(':checked')) {
                                object[this.name.toString().replace('fw_report_', '')] = $(this).val();
                            }
                            break;
                        default:
                            object[this.name.toString().replace('fw_report_', '')] = $(this).val();
                            break;
                    }
                }
            }
        })
        let data = {
            controller_type: this.controller_type,
        };
        data[this.filter_field_name] = object;
        $.ajax({
            url: this.url,
            data: data,
            type: 'post',
            success: res => {

                $("#submit_btn").find('i').attr('class', 'fa fa-edit m-2');
                $("#submit_btn").find('span').text('ویرایش');
                try {
                    let json = JSON.parse(res);
                    if (json.status == true) {
                        this.jsonData = json.data;
                        console.log(this.jsonData);
                        $("#res").html(json.html)
                        $.count();
                        // $.table(true, this.doFooter, false);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'خطایی رخ داد!',
                            text: 'در بارگزاری اطلاعات خطایی رخ داد',
                            showConfirmButton: false,
                            showCloseButton: true
                        })
                    }
                } catch (e) {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطایی رخ داد!',
                        text: 'در بارگزاری اطلاعات خطایی رخ داد',
                        showConfirmButton: false,
                        showCloseButton: true
                    })
                }
            }
        });
    }

    init(doFooter = true) {
        this.doFooter = doFooter;
        let instance = this;
        $("[id$=date_from]").on('focus', function () {
            $(this).persianDatepicker({
                onSelect: date => {
                    instance.start_date = date;
                }
            })
        });
        $("[id^=simple_date_fw_report_]").each(function () {
            $(this).persianDatepicker()
        });
        $("[id$=date_to]").on('focus', function () {

            if (instance.start_date && !$(this).val()) {
                $(this).persianDatepicker({
                    minDate: new Date(instance.start_date)
                })
            } else if (!instance.isSet) {
                $(this).persianDatepicker()
            }
            instance.isSet = true;

        });
        $("[id*=date]").attr('readonly', true);
        $('#submit_btn').on('click', function (e) {

            // alert('hoi')
            let element = $("#formDiv");
            if ($(element).is(":visible")) {
                $("#submit_btn").find('i').attr('class', 'fa fa-spin fa-spinner m-2');
                $("#submit_btn").find('span').text('درحال پردازش');
                $("#print_report").removeClass('disabled');
                Reports.submit();
                $(element).slideUp();
            } else {
                $("#submit_btn").find('i').attr('class', 'fa fa-download m-2');
                $("#submit_btn").find('span').text('دریافت گزارش');
                $(element).slideDown();
                $("#print_report").addClass('disabled');
                $("#res").empty();
            }
        });
        $("#percent").checkNumber({
            maxNum: '2'
        });
        let reportsClassLocalInstance = this;
        $("#print_report").on('click', function () {
            let html = $("#res").html();
            printDiv($("#res").find('table')[0])
        });
        $(".btn-danger[type=reset]").on('click', function () {
            setTimeout(() => {
                $("select").each(function () {
                    if ($(this).data('select2')) {
                        $(this).select2('destroy');
                        $(this).select2();
                    }
                })
            }, 1);
        });
    }

}

const Reports = new ReportsClass();

function printDiv(elem) {
    renderMe($('<div/>').append($(elem).clone()).html());
}

function renderMe(data) {
    let inputs = $("#fw-content").find('input[id*=date]');

    let title = 'گزارش ' + document.title.split('/').pop();
    if (inputs.length === 1){
        title += " - "+$(inputs).val();
    } else if (inputs.length === 2){
        let dateText = '';
        let i =0;
        $(inputs).each(function () {
            i++;
            if ($(this).val().length > 0){
                if (i === 1){
                    dateText += " از "+$(this).val();
                } else if (i === 2){
                    dateText += " تا "+$(this).val();
                }
            }
        });
        if (dateText !== '') {
            dateText = " - " + dateText;
        }
        title += dateText;
    }
    let shiftId = $("#fw_report_sending_time_id").val();
    $("#fw_report_sending_time_id").find("option").each(function () {
        if ($(this).attr('value') == shiftId){
            title += " - شیفت "+$(this).text();
        }
    });
    if ($("#fw_report_customer_id").val()){
        title += " - "+$("#fw_report_customer_id").find("option:selected").text();
    }
    let open = window.open('',  title,'height=1000,width=1000');
    // let table = $("#res").find('table');
    // $(table).each(function () {
    //     if ($(this).attr('id').includes("DataTables_Table")) {
    //         $(this).DataTable().destroy();
    //     }
    // });

    setTimeout(() => {

        open.document.write('<html lang="fa"><head><title>'+title+'</title>');
        open.document.write('<link rel="stylesheet" media="all" href="/admin/src/dist/css/bootstrap-rtl.min.css" type="text/css" />');
        open.document.write('<link rel="stylesheet" media="all" href="/admin/src/dist/css/custom-style.css" type="text/css" />');
        open.document.write('</head><body>');
        open.document.write(`<div style="margin-bottom: 1em;text-align: center;border: 1px black solid;border-radius: 10px">
<h4>${title}<br><br> تاریخ تهیه گزارش:  ${new persianDate().format()}</h4>
</div>`);
        open.document.write(data);
        open.document.write('</body></html>');
        setTimeout(() => {
            $(open.document).find('table').addClass('rotate')
           open.print()
            // open.close()
        }, 100);
    }, 500);


    // setTimeout(() => {
    //     $(table).each(function () {
    //         $(this).DataTable({
    //             "ordering": true,
    //             "columnDefs": [{
    //                 "targets": 'no-sort',
    //                 "orderable": false,
    //             }],
    //             "language": {
    //                 "zeroRecords": "هیچ موردی یافت نشد",
    //                 "lengthMenu": "نمایش _MENU_ داده",
    //                 "loadingRecords": "درحال بارگزاری...",
    //                 "processing": "در حال پردازش...",
    //                 "search": "جستجو:",
    //                 "info": "در حال نمایش _PAGE_ صفحه از _PAGES_ صفحه",
    //                 "infoEmpty": "هیچ موردی وجود ندارد!",
    //                 "infoFiltered": "(از _MAX_ داده فیلتر شده)",
    //                 "paginate": {
    //                     "next": "بعدی",
    //                     "previous": "قبلی",
    //                 },
    //             },
    //         });
    //     });
    // }, 500);


    return true;
}
