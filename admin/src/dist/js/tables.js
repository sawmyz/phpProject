$.table = function (count = true, doFooter = true, inputs = true) {

    setTimeout(() => {
        $('table').each(function () {
            let $this = $(this);
            if ($.fn.DataTable.isDataTable($(this))) {
                $(this).DataTable().destroy();

            }
            let table = $($this);
            if (count === true) {
                let i = 0;
                $(table).find("tbody > tr").each(function () {
                    i++;
                    $(this).find('td:first-child').html(i);
                });
            }
            if (doFooter) {
                if ($(table).find('tfoot tr').length === 0) {
                    let thead = $(table).find('thead').html();
                    $(table).append('<tfoot>' + thead + '</tfoot>')
                }
            }
            let thCount = $(this).find('thead tr th').length, tdCount = $(this).find('tbody tr:first-child td').length;
            if (thCount === tdCount) {
                let table = $(this).DataTable({
                    "ordering": true,
                    "columnDefs": [{
                        "targets": 'no-sort',
                        "orderable": false,
                    }],
                    "language": {
                        "zeroRecords": "هیچ موردی یافت نشد",
                        "lengthMenu": "نمایش _MENU_ داده",
                        "loadingRecords": "درحال بارگزاری...",
                        "processing": "در حال پردازش...",
                        "search": "جستجو:",
                        "info": "در حال نمایش _PAGE_ صفحه از _PAGES_ صفحه",
                        "infoEmpty": "هیچ موردی وجود ندارد!",
                        "infoFiltered": "(از _MAX_ داده فیلتر شده)",
                        "paginate": {
                            "next": "بعدی",
                            "previous": "قبلی",
                        },
                    },
                });
                $(this).on('draw.dt', function (e) {
                    let myPage = table.page.info().page;
                    setCookie('current_page', myPage, '1')
                });
                $("th:contains('عملیات')").attr('style', 'width: 200px;display: block')
                if (inputs) {
                    if (window.screen.width > 900) {

                        $('table thead th').each(function () {
                            if (!$(this).hasClass('no-sort')) {
                                let title = $(this).text();
                                if (title != 'عکس' && title != 'تصویر' && title != 'آیکون' && title != 'آیکون' && title != 'ردیف' && title != 'عملیات') {
                                    $(this).text('');
                                    $(this).attr("width", 75);
                                    $(this).append('' +
                                        '<div class="custom-tooltip">' +
                                        '  <span class="custom-tooltiptext">' + title + '</span>' +
                                        '<input class="form-control" type="text" placeholder="' + title + '" />' +
                                        '</div>');

                                }
                            }
                        });
                        setTimeout(() => {
                            table.columns().every(function () {
                                let that = this;
                                $('input', this.header()).on('keyup change clear', function () {
                                    if (that.search() !== this.value) {
                                        that
                                            .search(this.value)
                                            .draw();
                                    }
                                });
                            });
                        },500)

                    }
                }
            }
        });
    },0)
};

