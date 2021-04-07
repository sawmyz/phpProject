
$('#customer_credit_account_number').checkShebaNum();


$('#inquiry').on('click',function () {

    Swal.fire({
        icon: 'error',
        title: 'خطایی رخ داد',
        text: 'خطا در ارتباط با سرور بانک!',
        showConfirmButton: false,
        showCloseButton: true
    });
})

//// get customer file details ////

$('#credit_file_requested_credit,#credit_file_refund,#credit_file_monthly_profit,#credit_file_payment_amount,#credit_file_guaranteed_check,#credit_file_filenumber,#grant_purchase_credit_price').attr('readonly', true);

$('#guarantee_documents_id').on('change', function () {

    let value = $(this).val();
    $.ajax({
        url: 'controllers/CreditShoping/GuaranteeDocuments/GuaranteeDocuments',
        type: 'post',
        data: {
            controller_type: 'getFileDetails',
            documentId: value,
        },
        success: res => {

            let data = JSON.parse(res);
            $('#credit_file_requested_credit').val(data.requested);
            $('#grant_purchase_credit_price').val(data.requested);
            $('#credit_file_refund').val(data.refund);
            $('#credit_file_monthly_profit').val(data.monthly);
            $('#credit_file_payment_amount').val(data.amount);
            $('#credit_file_guaranteed_check').val(data.check);
            $('#credit_file_filenumber').val(data.filenumber);

        },
    })
})