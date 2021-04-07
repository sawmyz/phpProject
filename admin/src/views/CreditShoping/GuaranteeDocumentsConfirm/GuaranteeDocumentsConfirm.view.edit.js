$(function () {

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

    //// deny check box  /////


    $(".BirthCertificateCheckBox ,.NationalCardCheckBox ,.CertificateRightCheckBox ,.ContractCheckBox,.CheckCheckBox,.PromissoryCheckBox,.GuarantorChecksCheckBox,.IdentitysCheckBox,.GuarantorRightsCertificateCheckBox").val(2);
    $(".BirthCertificateCheckBox ,.NationalCardCheckBox ,.CertificateRightCheckBox ,.ContractCheckBox,.CheckCheckBox,.PromissoryCheckBox,.GuarantorChecksCheckBox,.IdentitysCheckBox,.GuarantorRightsCertificateCheckBox").on('ifChecked', function () {
        $(this).val(1);
    });
    $(".BirthCertificateCheckBox ,.NationalCardCheckBox ,.CertificateRightCheckBox ,.ContractCheckBox,.CheckCheckBox,.PromissoryCheckBox,.GuarantorChecksCheckBox,.IdentitysCheckBox,.GuarantorRightsCertificateCheckBox").on('ifUnchecked', function () {
        $(this).val(2);
    });
    $('#birthArea').hide(200);
    $('#nationalCardArea').hide(200);
    $('#certificateRightArea').hide(200);
    $('#contractArea').hide(200);
    $('#promissoryArea').hide(200);
    $('#guarantorCheckArea').hide(200);
    $('#checkArea').hide(200);
    $('#IdentityArea').hide(200);
    $('#guarantorRightsArea').hide(200);


    $(".BirthCertificateCheckBox").on('ifChecked', function () {
        $('#birthArea').show(200);
    });
    $(".BirthCertificateCheckBox ").on('ifUnchecked', function () {
        $('#birthArea').hide(200);
    });


    $(".NationalCardCheckBox").on('ifChecked', function () {
        $('#nationalCardArea').show(200);
    });
    $(".NationalCardCheckBox ").on('ifUnchecked', function () {
        $('#nationalCardArea').hide(200);
    });



    $(".CertificateRightCheckBox").on('ifChecked', function () {
        $('#certificateRightArea').show(200);
    });
    $(".CertificateRightCheckBox ").on('ifUnchecked', function () {
        $('#certificateRightArea').hide(200);
    });



    $(".ContractCheckBox").on('ifChecked', function () {
        $('#contractArea').show(200);
    });
    $(".ContractCheckBox ").on('ifUnchecked', function () {
        $('#contractArea').hide(200);
    });



    $(".PromissoryCheckBox").on('ifChecked', function () {
        $('#promissoryArea').show(200);
    });
    $(".PromissoryCheckBox ").on('ifUnchecked', function () {
        $('#promissoryArea').hide(200);
    });



    $(".GuarantorChecksCheckBox").on('ifChecked', function () {
        $('#guarantorCheckArea').show(200);
    });
    $(".GuarantorChecksCheckBox ").on('ifUnchecked', function () {
        $('#guarantorCheckArea').hide(200);
    });



    $(".CheckCheckBox").on('ifChecked', function () {
        $('#checkArea').show(200);
    });
    $(".CheckCheckBox ").on('ifUnchecked', function () {
        $('#checkArea').hide(200);
    });



    $(".IdentitysCheckBox").on('ifChecked', function () {
        $('#IdentityArea').show(200);
    });
    $(".IdentitysCheckBox ").on('ifUnchecked', function () {
        $('#IdentityArea').hide(200);
    });



    $(".GuarantorRightsCertificateCheckBox").on('ifChecked', function () {
        $('#guarantorRightsArea').show(200);
    });
    $(".GuarantorRightsCertificateCheckBox ").on('ifUnchecked', function () {
        $('#guarantorRightsArea').hide(200);
    });


    //// get customer file details ////

    $('#credit_file_requested_credit,#credit_file_refund,#credit_file_monthly_profit,#credit_file_payment_amount,#credit_file_guaranteed_check,#credit_file_filenumber').attr('readonly', true);

    $('#guarantee_documents_id').on('change', function () {
alert('hi');
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



    // function openModal() {
    //     document.getElementById("myModal").style.display = "block";
    // }
    //
    // function closeModal() {
    //     document.getElementById("myModal").style.display = "none";
    // }
    //
    // var slideIndex = 1;
    // showSlides(slideIndex);
    //
    // function plusSlides(n) {
    //     showSlides(slideIndex += n);
    // }
    //
    // function currentSlide(n) {
    //     showSlides(slideIndex = n);
    // }
    //
    // function showSlides(n) {
    //     var i;
    //     var src = document.getElementById("birthImage").attr('src');
    //     var slides = document.getElementsByClassName("mySlides");
    //     var dots = document.getElementsByClassName("demo");
    //     var captionText = document.getElementById("caption");
    //     if (n > slides.length) {slideIndex = 1}
    //     if (n < 1) {slideIndex = slides.length}
    //     for (i = 0; i < slides.length; i++) {
    //         slides[i].style.display = "none";
    //     }
    //     for (i = 0; i < dots.length; i++) {
    //         dots[i].className = dots[i].className.replace(" active", "");
    //     }
    //     slides[slideIndex-1].style.display = "block";
    //     dots[slideIndex-1].className += " active";
    //     captionText.innerHTML = dots[slideIndex-1].alt;
    // }





    // Get the modal///
    var modal = document.getElementById("myModal");

// // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

// // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

})

