

$(function () {


    $("#workgroup_id").getOptions({
        url: 'controllers/BaseTables/Info/Castes/Castes',
        target: 'caste_id',
        controller_type: 'getCaseInWorkGroup',
        rest: {
            request: 'options'
        }
    });
    $(".socialMediaCheckBox").on('ifChecked', function () {
        $(this).parents('tr').find('input.form-control').attr('disabled', false).attr('required', true);
    });
    $(".socialMediaCheckBox").on('ifUnchecked', function () {
        $(this).parents('tr').find('input.form-control').attr('disabled', true).attr('required', false);
    });

    $('#provider_start_date').persianDatepicker();
    $('#provider_end_date').persianDatepicker();
    $('#provider_cash_discount_div').hide();
    $('#provider_credit_discount_div').hide();
    $('#provider_month_settlement_div').hide();
    $('#contracttype_id').on('change', function () {
        let value = $(this).val();

        switch (value) {
            case '1':
                $('#provider_cash_discount_div').show();
                $('#provider_cash_discount').prop('required', true);
                $('#provider_credit_discount_div').hide();
                $('#provider_credit_discount').prop('required', false);
                $('#provider_month_settlement_div').hide();
                $('#provider_month_settlement').prop('required', false);

                break;
            case '2':
                $('#provider_cash_discount_div').hide();
                $('#provider_cash_discount').prop('required', false);
                $('#provider_credit_discount_div').show();
                $('#provider_credit_discount').prop('required', true);
                $('#provider_month_settlement_div').show();
                $('#provider_month_settlement').prop('required', true);

                break;
            case '3':
                $('#provider_cash_discount_div').show();
                $('#provider_month_settlement').prop('required', true);
                $('#provider_credit_discount_div').show();
                $('#provider_credit_discount').prop('required', true);
                $('#provider_month_settlement_div').show();
                $('#provider_month_settlement').prop('required', true);

                break;
        }


    });
})