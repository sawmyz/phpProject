$(function () {

    $(".workHourCheckbox").on('ifChecked', function () {
        let tr = $(this).parents('tr'), value = $(this).val();
        $(tr).find(`input.form-control[data-shift=${value}]`).attr('disabled', false).attr('required', true)
    });
    $(".workHourCheckbox").on('ifUnchecked', function () {
        let tr = $(this).parents('tr'), value = $(this).val();
        $(tr).find(`input.form-control[data-shift=${value}]`).attr('disabled', true).attr('required', false)
    });
    $("#provider_branch_has_auth_yes_no").on('change', function () {
        if ($("#provider_branch_has_auth_yes_no").val() == 1) {
            $("#provider_branch_auth_number").show()
            $("#lable").show()
        }
        if ($("#provider_branch_has_auth_yes_no").val() == 2) {
            $("#provider_branch_auth_number").hide()
            $("#lable").hide()
        }
    });

    $(".socialMediaCheckBox").on('ifChecked', function () {
        $(this).parents('tr').find('input.form-control').attr('disabled', false).attr('required', true);
    });
    $(".socialMediaCheckBox").on('ifUnchecked', function () {
        $(this).parents('tr').find('input.form-control').attr('disabled', true).attr('required', false);
    });
    $("#provider_branch_post_code").checkPostCode();    
    $("#provider_branch_post_code").checkNumber();


    $("#country_id").getOptions({
        url: 'controllers/BaseTables/Locations/States/States',
        target: 'state_id',
        controller_type: 'getStateInCountry',
        rest: {
            request: 'options'
        }
    });

    $("#state_id").getOptions({
        url: 'controllers/BaseTables/Locations/Cities/Cities',
        target: 'city_id',
        controller_type: 'getCityInState',
        rest: {
            request: 'options'
        }
    });

    $("#city_id").getOptions({
        url: 'controllers/BaseTables/Locations/Districts/Districts',
        target: 'district_id',
        controller_type: 'getDistrictInCity',
        rest: {
            request: 'options'
        }
    });

    $("#district_id").getOptions({
        url: 'controllers/BaseTables/Locations/Ranges/Ranges',
        target: 'range_id',
        controller_type: 'getRangeInDistrict',
        rest: {
            request: 'options'
        }
    });
    $("#provider_id").getOptions({
        url: 'controllers/Providers/ProviderBranches/ProviderBranches',
        target: 'provider_branch_id',
        controller_type: 'getProviderBranchesInProvider',
        rest: {
            request: 'options'
        }
    });
    $("#country_id").trigger('change',500)


})