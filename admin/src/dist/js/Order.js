class Order {
    setId(id) {
        this.id = id;
    }

    showModal(id) {
        if ($.fn.DataTable.isDataTable($("#orderTable"))) {
            $("#orderTable").DataTable().destroy();

        }
        $.loader();
        $("#chooseDeliveryButtonOnModal").html($(`tr[data-id=${this.id}]`).find('.selectDeliveryButton').clone());
        let that = this;
        $("#chooseDeliveryButtonOnModal").find(".selectDeliveryButton").on('click',function () {
            $(`tr[data-id=${that.id}]`).find('.selectDeliveryButton').click();
        });
        this.setId(id);
        $("#orderCode").text(id);
        this.ajax(res => {

            for (let itemKey in res) {
                $("#order" + itemKey).html(res[itemKey]);
            }
            setTimeout(() => {

                let table = $('#orderTable').DataTable({
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

            }, 100);

            $("#orderInfoModal").modal('show');
            $.loader();
        });


    }

    ajax(successCallback) {
        $.ajax({
            url: "controllers/Orders/Orders/Orders",
            type: "POST",
            data: {
                controller_type: "getOrderInfoModal",
                orderShiftId: this.id,
            },
            success: successCallback
        });
    }
}

const OrderInstance = new Order();
