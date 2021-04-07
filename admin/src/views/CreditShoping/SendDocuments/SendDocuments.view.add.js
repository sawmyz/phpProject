

$('#send_guarantee_documents_date').persianDatepicker();

$("#guarantee_birth_certificate_id ,#guarantee_national_card_id ,#guarantee_certificate_rights_id ,#guarantee_contract_id,#guarantee_check_id,#guarantee_promissory_id,#guarantee_guarantor_check_id,#guarantee_Identity_id,#guarantee_guarantor_rights_certificate_id").val(0);


$("#guarantee_birth_certificate_id ,#guarantee_national_card_id ,#guarantee_certificate_rights_id ,#guarantee_contract_id,#guarantee_check_id,#guarantee_promissory_id,#guarantee_guarantor_check_id,#guarantee_Identity_id,#guarantee_guarantor_rights_certificate_id").on('ifChecked', function () {
    $(this).val(1);
});
$("#guarantee_birth_certificate_id ,#guarantee_national_card_id ,#guarantee_certificate_rights_id ,#guarantee_contract_id,#guarantee_check_id,#guarantee_promissory_id,#guarantee_guarantor_check_id,#guarantee_Identity_id,#guarantee_guarantor_rights_certificate_id").on('ifUnchecked', function () {
    $(this).val(0);
});


