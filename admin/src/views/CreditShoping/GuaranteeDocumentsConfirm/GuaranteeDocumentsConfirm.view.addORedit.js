$(function () {

    $('.mySubmit').html('ابتدا وضعیت مدارک را تایید کنید').attr('disabled','disabled');

    ////hide and show sections ////

    $('.birthArea').toggle(1);
    $('.nationalCardArea').toggle(1);
    $('.certificateRightArea').toggle(1);
    $('.contractArea').toggle(1);
    $('.checkArea').toggle(1);
    $('.promissoryArea').toggle(1);
    $('.guarantorCheckArea').toggle(1);
    $('.IdentityArea').toggle(1);
    $('.guarantorRightsArea').toggle(1);


    $('#birthBTN').hide();
    $('#nationalCardBTN').hide();
    $('#certificateRightBTN').hide();
    $('#contractBTN').hide();
    $('#checkBTN').hide();
    $('#promissoryBTN').hide();
    $('#guarantorCheckBTN').hide();
    $('#IdentityBTN').hide();
    $('#guarantorRightBTN').hide();

    $('#guarantee_documents_id').on('change', function () {

        $('#birthBTN').show(100);
        $('#nationalCardBTN').show(100);
        $('#certificateRightBTN').show(100);
        $('#contractBTN').show(100);
        $('#checkBTN').show(100);
        $('#promissoryBTN').show(100);
        $('#guarantorCheckBTN').show(100);
        $('#IdentityBTN').show(100);
        $('#guarantorRightBTN').show(100);

    })


    $('#birthBTN').click(function () {
        $('.birthArea').toggle(300);
        $('#birthArea').hide(200);
    });
    $('#nationalCardBTN').click(function () {
        $('.nationalCardArea').toggle(300);
        $('#nationalCardArea').hide(200);
    });
    $('#certificateRightBTN').click(function () {
        $('.certificateRightArea').toggle(300);
        $('#certificateRightArea').hide(200);
    });
    $('#contractBTN').click(function () {
        $('.contractArea').toggle(300);
        $('#contractArea').hide(200);
    });
    $('#checkBTN').click(function () {
        $('.checkArea').toggle(300);
        $('#checkArea').hide(200);
    });
    $('#promissoryBTN').click(function () {
        $('.promissoryArea').toggle(300);
        $('#promissoryArea').hide(200);
    });
    $('#guarantorCheckBTN').click(function () {
        $('.guarantorCheckArea').toggle(300);
        $('#guarantorCheckArea').hide(200);
    });
    $('#IdentityBTN').click(function () {
        $('.IdentityArea').toggle(300);
        $('#IdentityArea').hide(200);
    });
    $('#guarantorRightBTN').click(function () {
        $('.guarantorRightsArea').toggle(300);
        $('#guarantorRightsArea').hide(200);
    });


    ////filter table rows /////

    $('#guarantee_documents_id').on('change', function () {
        let value = $(this).val();
        $('.filterBirth').filter(function () {
            $(this).toggle($(this).data('documentid').toString() === value.toString());
        })
        $('.filterNationalCard').filter(function () {
            $(this).toggle($(this).data('documentid').toString() === value.toString());
        })
        $('.filterCertificateRights').filter(function () {
            $(this).toggle($(this).data('documentid').toString() === value.toString());
        })
        $('.filterContract').filter(function () {
            $(this).toggle($(this).data('documentid').toString() === value.toString());
        })
        $('.filterCheck').filter(function () {
            $(this).toggle($(this).data('documentid').toString() === value.toString());
        })
        $('.filterPromissory').filter(function () {
            $(this).toggle($(this).data('documentid').toString() === value.toString());
        })
        $('.filterGuarantorChecks').filter(function () {
            $(this).toggle($(this).data('documentid').toString() === value.toString());
        })
        $('.filterIdentitys').filter(function () {
            $(this).toggle($(this).data('documentid').toString() === value.toString());
        })
        $('.filterGuarantorRightsCertificate').filter(function () {
            $(this).toggle($(this).data('documentid').toString() === value.toString());
        })
    })


    //// national_card status  /////
    $('.national_card_check').on('click', function () {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'تعیین وضعیت مدرک',
            text: "علت رد مدرک",
            // input: 'textarea',
            html:
                '<textarea id="national_card_description" name="national_card_description" class="swal2-input"  placeholder="جهت رد مدرک دلایل را وارد کنید">',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: 'تایید مدرک',
            cancelButtonText: 'رد مدرک',
            cancelButtonColor: "#ff0b0b",
            confirmButtonColor: "#20a200",
            preConfirm: res => {
                $(this).removeClass("btn-warning");
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-success");
                $('#national_card_status').val(2);
                Swal.fire({
                    icon: 'success',
                    title: 'تایید مدرک با موفقیت انجام شد!',
                    showConfirmButton: false,
                })
                checkRequire();
            },
        }).then((result) => {
            if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                if ($('#national_card_description').val() !== '') {
                    $(this).removeClass("btn-warning");
                    $(this).removeClass("btn-success");
                    $(this).addClass("btn-danger");
                    $('#national_card_status').val(1);
                    $('#national_card_desc').val($('#national_card_description').val());
                    Swal.fire({
                        icon: 'success',
                        title: 'رد مدرک با موفقیت انجام شد!',
                        showConfirmButton: false,
                    })
                    checkRequire();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'عملیات انجام نشد!',
                        text: "ذکر علت جهت رد قرارداد الزامی میباشد",
                        showConfirmButton: false,
                    })
                }
            }
        })
    })

    //// birth_certificate status  /////
    $('.birth_certificate_check').on('click', function () {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'تعیین وضعیت مدرک',
            text: "علت رد مدرک",
            // input: 'textarea',
            html:
                '<textarea id="birth_certificate_description" name="birth_certificate_description" class="swal2-input" placeholder="جهت رد مدرک دلایل را وارد کنید">',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: 'تایید مدرک',
            cancelButtonText: 'رد مدرک',
            cancelButtonColor: "#ff0b0b",
            confirmButtonColor: "#20a200",
            preConfirm: res => {
                $(this).removeClass("btn-warning");
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-success");
                $('#birth_certificate_status').val(2);
                Swal.fire({
                    icon: 'success',
                    title: 'تایید مدرک با موفقیت انجام شد!',
                    showConfirmButton: false,
                })
                checkRequire();
            },
        }).then((result) => {
            if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                if ($('#birth_certificate_description').val() !== '') {
                    $(this).removeClass("btn-warning");
                    $(this).removeClass("btn-success");
                    $(this).addClass("btn-danger");
                    $('#birth_certificate_status').val(1);
                    $('#birth_certificate_desc').val($('#birth_certificate_description').val());
                    Swal.fire({
                        icon: 'success',
                        title: 'رد مدرک با موفقیت انجام شد!',
                        showConfirmButton: false,
                    })
                    checkRequire();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'عملیات انجام نشد!',
                        text: "ذکر علت جهت رد قرارداد الزامی میباشد",
                        showConfirmButton: false,
                    })
                }
            }
        })
    })

    //// certificate_rights status  /////
    $('.certificate_rights_check').on('click', function () {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'تعیین وضعیت مدرک',
            text: "علت رد مدرک",
            // input: 'textarea',
            html:
                '<textarea id="certificate_rights_description" name="certificate_rights_description" class="swal2-input"  placeholder="جهت رد مدرک دلایل را وارد کنید">',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: 'تایید مدرک',
            cancelButtonText: 'رد مدرک',
            cancelButtonColor: "#ff0b0b",
            confirmButtonColor: "#20a200",
            preConfirm: res => {
                $(this).removeClass("btn-warning");
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-success");
                $('#certificate_rights_status').val(2);
                Swal.fire({
                    icon: 'success',
                    title: 'تایید مدرک با موفقیت انجام شد!',
                    showConfirmButton: false,
                })
                checkRequire();
            },
        }).then((result) => {
            if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                if ($('#certificate_rights_description').val() !== '') {
                    $(this).removeClass("btn-warning");
                    $(this).removeClass("btn-success");
                    $(this).addClass("btn-danger");
                    $('#certificate_rights_status').val(1);
                    $('#certificate_rights_desc').val($('#certificate_rights_description').val());
                    Swal.fire({
                        icon: 'success',
                        title: 'رد مدرک با موفقیت انجام شد!',
                        showConfirmButton: false,
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'عملیات انجام نشد!',
                        text: "ذکر علت جهت رد قرارداد الزامی میباشد",
                        showConfirmButton: false,
                    })
                    checkRequire();
                }
            }
        })
    })

    //// contract status  /////
    $('.contract_check').on('click', function () {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'تعیین وضعیت مدرک',
            text: "علت رد مدرک",
            // input: 'textarea',
            html:
                '<textarea id="contract_description" name="contract_description" class="swal2-input"  placeholder="جهت رد مدرک دلایل را وارد کنید">',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: 'تایید مدرک',
            cancelButtonText: 'رد مدرک',
            cancelButtonColor: "#ff0b0b",
            confirmButtonColor: "#20a200",
            preConfirm: res => {
                $(this).removeClass("btn-warning");
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-success");
                $('#contract_status').val(2);
                Swal.fire({
                    icon: 'success',
                    title: 'تایید مدرک با موفقیت انجام شد!',
                    showConfirmButton: false,
                })
                checkRequire();
            },
        }).then((result) => {
            if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                if ($('#contract_description').val() !== '') {
                    $(this).removeClass("btn-warning");
                    $(this).removeClass("btn-success");
                    $(this).addClass("btn-danger");
                    $('#contract_status').val(1);
                    $('#contract_desc').val($('#contract_description').val());
                    Swal.fire({
                        icon: 'success',
                        title: 'رد مدرک با موفقیت انجام شد!',
                        showConfirmButton: false,
                    })
                    checkRequire();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'عملیات انجام نشد!',
                        text: "ذکر علت جهت رد قرارداد الزامی میباشد",
                        showConfirmButton: false,
                    })
                }
            }
        })
    })

     //// check status  /////
    $('.check_check').on('click', function () {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'تعیین وضعیت مدرک',
            text: "علت رد مدرک",
            // input: 'textarea',
            html:
                '<textarea id="check_description" name="check_description" class="swal2-input"  placeholder="جهت رد مدرک دلایل را وارد کنید">',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: 'تایید مدرک',
            cancelButtonText: 'رد مدرک',
            cancelButtonColor: "#ff0b0b",
            confirmButtonColor: "#20a200",
            preConfirm: res => {
                $(this).removeClass("btn-warning");
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-success");
                $('#check_status').val(2);
                Swal.fire({
                    icon: 'success',
                    title: 'تایید مدرک با موفقیت انجام شد!',
                    showConfirmButton: false,
                })
                checkRequire();
            },
        }).then((result) => {
            if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                if ($('#check_description').val() !== '') {
                    $(this).removeClass("btn-warning");
                    $(this).removeClass("btn-success");
                    $(this).addClass("btn-danger");
                    $('#check_status').val(1);
                    $('#check_desc').val($('#check_description').val());
                    Swal.fire({
                        icon: 'success',
                        title: 'رد مدرک با موفقیت انجام شد!',
                        showConfirmButton: false,
                    })
                    checkRequire();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'عملیات انجام نشد!',
                        text: "ذکر علت جهت رد قرارداد الزامی میباشد",
                        showConfirmButton: false,
                    })
                }
            }
        })
    })

    //// promissory status  /////
    $('.promissory_check').on('click', function () {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'تعیین وضعیت مدرک',
            text: "علت رد مدرک",
            // input: 'textarea',
            html:
                '<textarea id="promissory_description" name="promissory_description" class="swal2-input"  placeholder="جهت رد مدرک دلایل را وارد کنید">',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: 'تایید مدرک',
            cancelButtonText: 'رد مدرک',
            cancelButtonColor: "#ff0b0b",
            confirmButtonColor: "#20a200",
            preConfirm: res => {
                $(this).removeClass("btn-warning");
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-success");
                $('#promissory_status').val(2);
                Swal.fire({
                    icon: 'success',
                    title: 'تایید مدرک با موفقیت انجام شد!',
                    showConfirmButton: false,
                })
                checkRequire();
            },
        }).then((result) => {
            if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                if ($('#promissory_description').val() !== '') {
                    $(this).removeClass("btn-warning");
                    $(this).removeClass("btn-success");
                    $(this).addClass("btn-danger");
                    $('#promissory_status').val(1);
                    $('#promissory_desc').val($('#promissory_description').val());
                    Swal.fire({
                        icon: 'success',
                        title: 'رد مدرک با موفقیت انجام شد!',
                        showConfirmButton: false,
                    })
                    checkRequire();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'عملیات انجام نشد!',
                        text: "ذکر علت جهت رد قرارداد الزامی میباشد",
                        showConfirmButton: false,
                    })
                }
            }
        })
    })

     //// guarantor_check status  /////
    $('.guarantor_check_check').on('click', function () {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'تعیین وضعیت مدرک',
            text: "علت رد مدرک",
            // input: 'textarea',
            html:
                '<textarea id="guarantor_check_description" name="guarantor_check_description" class="swal2-input"  placeholder="جهت رد مدرک دلایل را وارد کنید">',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: 'تایید مدرک',
            cancelButtonText: 'رد مدرک',
            cancelButtonColor: "#ff0b0b",
            confirmButtonColor: "#20a200",
            preConfirm: res => {
                $(this).removeClass("btn-warning");
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-success");
                $('#guarantor_check_status').val(2);
                Swal.fire({
                    icon: 'success',
                    title: 'تایید مدرک با موفقیت انجام شد!',
                    showConfirmButton: false,
                })
                checkRequire();
            },
        }).then((result) => {
            if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                if ($('#guarantor_check_description').val() !== '') {
                    $(this).removeClass("btn-warning");
                    $(this).removeClass("btn-success");
                    $(this).addClass("btn-danger");
                    $('#guarantor_check_status').val(1);
                    $('#guarantor_check_desc').val($('#guarantor_check_description').val());
                    Swal.fire({
                        icon: 'success',
                        title: 'رد مدرک با موفقیت انجام شد!',
                        showConfirmButton: false,
                    })
                    checkRequire();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'عملیات انجام نشد!',
                        text: "ذکر علت جهت رد قرارداد الزامی میباشد",
                        showConfirmButton: false,
                    })
                }
            }
        })
    })

     //// Identity status  /////
    $('.Identity_check').on('click', function () {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'تعیین وضعیت مدرک',
            text: "علت رد مدرک",
            // input: 'textarea',
            html:
                '<textarea id="Identity_description" name="Identity_description" class="swal2-input" placeholder="جهت رد مدرک دلایل را وارد کنید">',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: 'تایید مدرک',
            cancelButtonText: 'رد مدرک',
            cancelButtonColor: "#ff0b0b",
            confirmButtonColor: "#20a200",
            preConfirm: res => {
                $(this).removeClass("btn-warning");
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-success");
                $('#Identity_status').val(2);
                Swal.fire({
                    icon: 'success',
                    title: 'تایید مدرک با موفقیت انجام شد!',
                    showConfirmButton: false,
                })
                checkRequire();
            },
        }).then((result) => {
            if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                if ($('#Identity_description').val() !== '') {
                    $(this).removeClass("btn-warning");
                    $(this).removeClass("btn-success");
                    $(this).addClass("btn-danger");
                    $('#Identity_status').val(1);
                    $('#Identity_desc').val($('#Identity_description').val());
                    Swal.fire({
                        icon: 'success',
                        title: 'رد مدرک با موفقیت انجام شد!',
                        showConfirmButton: false,
                    })
                    checkRequire();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'عملیات انجام نشد!',
                        text: "ذکر علت جهت رد قرارداد الزامی میباشد",
                        showConfirmButton: false,
                    })
                }
            }
        })
    })

      //// guarantor_rights_certificate status  /////
    $('.guarantor_rights_certificate_check').on('click', function () {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'تعیین وضعیت مدرک',
            text: "علت رد مدرک",
            // input: 'textarea',
            html:
                '<textarea id="guarantor_rights_certificate_description" name="guarantor_rights_certificate_description" class="swal2-input"  placeholder="جهت رد مدرک دلایل را وارد کنید">',
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: 'تایید مدرک',
            cancelButtonText: 'رد مدرک',
            cancelButtonColor: "#ff0b0b",
            confirmButtonColor: "#20a200",
            preConfirm: res => {
                $(this).removeClass("btn-warning");
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-success");
                $('#guarantor_rights_certificate_status').val(2);
                Swal.fire({
                    icon: 'success',
                    title: 'تایید مدرک با موفقیت انجام شد!',
                    showConfirmButton: false,
                })
                checkRequire();
            },
        }).then((result) => {
            if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                if ($('#guarantor_rights_certificate_description').val() !== '') {
                    $(this).removeClass("btn-warning");
                    $(this).removeClass("btn-success");
                    $(this).addClass("btn-danger");
                    $('#guarantor_rights_certificate_status').val(1);
                    $('#guarantor_rights_certificate_desc').val($('#guarantor_rights_certificate_description').val());
                    Swal.fire({
                        icon: 'success',
                        title: 'رد مدرک با موفقیت انجام شد!',
                        showConfirmButton: false,
                    })
                    checkRequire();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'عملیات انجام نشد!',
                        text: "ذکر علت جهت رد قرارداد الزامی میباشد",
                        showConfirmButton: false,
                    })
                }
            }
        })
    })


    function checkRequire(){
        if ($('#birth_certificate_status').val() !== '0' &&
            $('#certificate_rights_status').val() !== '0' &&
            $('#national_card_status').val() !== '0' &&
            $('#contract_status').val() !== '0' &&
            $('#check_status').val() !== '0' &&
            $('#promissory_status').val() !== '0' &&
            $('#guarantor_check_status').val() !== '0' &&
            $('#Identity_status').val() !== '0' &&
            $('#guarantor_rights_certificate_status').val() !== '0'
        ){
            $('.mySubmit').attr('disabled',false).html('ثبت نهایی وضعیت پرونده');
        };
    };

    // $(".BirthCertificateCheckBox ,.NationalCardCheckBox ,.CertificateRightCheckBox ,.ContractCheckBox,.CheckCheckBox,.PromissoryCheckBox,.GuarantorChecksCheckBox,.IdentitysCheckBox,.GuarantorRightsCertificateCheckBox").val(2);
    // $(".BirthCertificateCheckBox ,.NationalCardCheckBox ,.CertificateRightCheckBox ,.ContractCheckBox,.CheckCheckBox,.PromissoryCheckBox,.GuarantorChecksCheckBox,.IdentitysCheckBox,.GuarantorRightsCertificateCheckBox").on('ifChecked', function () {
    //     $(this).val(1);
    // });
    // $(".BirthCertificateCheckBox ,.NationalCardCheckBox ,.CertificateRightCheckBox ,.ContractCheckBox,.CheckCheckBox,.PromissoryCheckBox,.GuarantorChecksCheckBox,.IdentitysCheckBox,.GuarantorRightsCertificateCheckBox").on('ifUnchecked', function () {
    //     $(this).val(2);
    // });
    // $('#birthArea').hide(200);
    // $('#nationalCardArea').hide(200);
    // $('#certificateRightArea').hide(200);
    // $('#contractArea').hide(200);
    // $('#promissoryArea').hide(200);
    // $('#guarantorCheckArea').hide(200);
    // $('#checkArea').hide(200);
    // $('#IdentityArea').hide(200);
    // $('#guarantorRightsArea').hide(200);
    //
    // $(".BirthCertificateCheckBox").on('ifChecked', function () {
    //     $('#birthArea').show(200);
    // });
    // $(".BirthCertificateCheckBox ").on('ifUnchecked', function () {
    //     $('#birthArea').hide(200);
    //     $('#birth_certificate_desc').val('');
    // });
    // $(".NationalCardCheckBox").on('ifChecked', function () {
    //     $('#nationalCardArea').show(200);
    // });
    // $(".NationalCardCheckBox ").on('ifUnchecked', function () {
    //     $('#nationalCardArea').hide(200);
    //     $('#national_card_desc').val('');
    // });
    // $(".CertificateRightCheckBox").on('ifChecked', function () {
    //     $('#certificateRightArea').show(200);
    // });
    // $(".CertificateRightCheckBox ").on('ifUnchecked', function () {
    //     $('#certificateRightArea').hide(200);
    //     $('#certificate_rights_desc').val('');
    // });
    // $(".ContractCheckBox").on('ifChecked', function () {
    //     $('#contractArea').show(200);
    // });
    // $(".ContractCheckBox ").on('ifUnchecked', function () {
    //     $('#contractArea').hide(200);
    //     $('#contract_desc').val('');
    // });
    // $(".PromissoryCheckBox").on('ifChecked', function () {
    //     $('#promissoryArea').show(200);
    // });
    // $(".PromissoryCheckBox ").on('ifUnchecked', function () {
    //     $('#promissoryArea').hide(200);
    //     $('#promissory_desc').val('');
    // });
    // $(".GuarantorChecksCheckBox").on('ifChecked', function () {
    //     $('#guarantorCheckArea').show(200);
    // });
    // $(".GuarantorChecksCheckBox ").on('ifUnchecked', function () {
    //     $('#guarantorCheckArea').hide(200);
    //     $('#guarantorCheckArea').val('');
    // });
    // $(".CheckCheckBox").on('ifChecked', function () {
    //     $('#checkArea').show(200);
    // });
    // $(".CheckCheckBox ").on('ifUnchecked', function () {
    //     $('#checkArea').hide(200);
    //     $('#check_desc').val('');
    // });
    // $(".IdentitysCheckBox").on('ifChecked', function () {
    //     $('#IdentityArea').show(200);
    // });
    // $(".IdentitysCheckBox ").on('ifUnchecked', function () {
    //     $('#IdentityArea').hide(200);
    //     $('#Identity_dsec').val('');
    // });
    // $(".GuarantorRightsCertificateCheckBox").on('ifChecked', function () {
    //     $('#guarantorRightsArea').show(200);
    // });
    // $(".GuarantorRightsCertificateCheckBox ").on('ifUnchecked', function () {
    //     $('#guarantorRightsArea').hide(200);
    //     $('#guarantor_rights_certificate_desc').val('');
    // });


    //// get customer file details ////

    $('#credit_file_requested_credit,#credit_file_refund,#credit_file_monthly_profit,#credit_file_payment_amount,#credit_file_guaranteed_check,#credit_file_filenumber').attr('readonly', true);
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
                $('#credit_file_refund').val(data.refund);
                $('#credit_file_monthly_profit').val(data.monthly);
                $('#credit_file_payment_amount').val(data.amount);
                $('#credit_file_guaranteed_check').val(data.check);
                $('#credit_file_filenumber').val(data.filenumber);

            },
        })
    })

    // Get the modal///
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

    $('.birthImg').on('click', function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    })
    $('.nationalImg').on('click', function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    })
    $('.RightsImg').on('click', function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    })
    $('.contractImg').on('click', function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    })
    $('.checksImg').on('click', function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    })
    $('.promissoryImg').on('click', function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    })
    $('.guarantorCheckImg').on('click', function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    })
    $('.identityImg').on('click', function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    })
    $('.guarantorRightImg').on('click', function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    })

    var span = document.getElementById("closeModel");
    span.onclick = function () {
        modal.style.display = "none";
    }
})


