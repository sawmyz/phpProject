
$('#guarantee_documents_id').on('change', function () {


    let value = $(this).val();
    $.ajax({
        url: 'controllers/CreditShoping/CreditFile/CreditFile',
        type: 'post',
        data: {
            controller_type: 'getFileDetails',
            fileId: value,
        },
        success: res => {

            console.log(res);
            let data = JSON.parse(res);
            $('#credit_file_requested_credit').val(data.requested).attr('readonly',true);
            $('#credit_file_refund').val(data.refund).attr('readonly',true);
            $('#credit_file_monthly_profit').val(data.monthly).attr('readonly',true);
            $('#credit_file_payment_amount').val(data.amount).attr('readonly',true);
            $('#credit_file_guaranteed_check').val(data.check).attr('readonly',true);
            $('#credit_file_filenumber').val(data.filenumber).attr('readonly',true);

        },
    })
})