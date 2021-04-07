$(function () {
    $("#credit_file_payment_amount").attr('readonly', true);
    $("#credit_file_guaranteed_check").attr('readonly', true);

    $("#payment").hide();
    $("#check").hide();
    $("#p").hide();
    $("#credit_file_filenumber").hide();

    function calculation() {
        let requested_credit = parseFloat($("#credit_file_requested_credit").val().replace(/,/g, '')); //x
        let refund = parseFloat($("#credit_file_refund").val().replace(/,/g, '')); //y
        let monthly_profit = parseFloat($("#credit_file_monthly_profit").val().replace(/,/g, '')); //z
        let num = (requested_credit * refund * monthly_profit / 100) + requested_credit;
        let chequeAmount = num * 1.3;
        let monthlyPayment = num / refund;

        $("#credit_file_guaranteed_check").val(number_format(chequeAmount));
        $("#credit_file_payment_amount").val(number_format(monthlyPayment));
    }

    $("#button").on('click', function () {
        if (($("#credit_file_requested_credit").val() == '') || ($("#credit_file_refund").val() == '') || ($("#credit_file_monthly_profit").val() == '')) {
            $("#p").show();
        } else {
            $("#payment").show(400);
            $("#check").show(400);
            calculation();
        }
    })

// $("#credit_file_monthly_profit").on('input', function () {
//     if(monthly_profit<0){
//         parseInt($("#credit_file_monthly_profit").val(0))
//
//     }
//     if(monthly_profit>=100){
//         parseInt($("#credit_file_monthly_profit").val(99))
//     }
//     calculation();
// });
// $("#credit_file_requested_credit").on('input', function () {
//
//     calculation();
// });
// $("#credit_file_refund").on('input', function () {
//
//         calculation();
// });

})
$('#credit_file_monthly_profit').keypress(function (event) {
    return isNumber(event, this)
});

function isNumber(evt, element) {

    let charCode = (evt.which) ? evt.which : event.keyCode

    return !((charCode != 45 || $(element).val().indexOf('-') != -1) &&      // Check minus and only once.
        (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // Check dot and only once.
        (charCode < 48 || charCode > 57));


}

$("#credit_file_monthly_profit").on('keydown keyup', function (e) {
    let min = 0;
    let max = 100;
    if (parseFloat($("#credit_file_monthly_profit").val()) < min) {
        $("#credit_file_monthly_profit").val(0);
    }

    if (parseFloat($("#credit_file_monthly_profit").val()) >= max) {
        $("#credit_file_monthly_profit").val(99);
    }

});


