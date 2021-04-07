$('#sheba_number').checkShebaNum();


$('#inquiry').on('click',function () {

    Swal.fire({
        icon: 'error',
        title: 'خطایی رخ داد',
        text: 'خطا در ارتباط با سرور بانک!',
        showConfirmButton: false,
        showCloseButton: true
    });
})