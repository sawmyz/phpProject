

alert('hi');
$(function () {

// $('.supervisorConfirm').on('click', function () {
//
//
//     let status = $(this).data("status");
//     let id = $(this).attr('id');
//     let role = '<?= $role ?>';
//     if (role === 'SupervisorsRole'){
//         const swalWithBootstrapButtons = Swal.mixin({
//             customClass: {
//                 confirmButton: 'btn btn-success',
//                 cancelButton: 'btn btn-danger'
//             },
//             buttonsStyling: false
//         })
//         swalWithBootstrapButtons.fire({
//             title: 'تعیین وضعیت قرارداد',
//             text: "علت رد قرارداد",
//             input: 'textarea',
//             showCancelButton: true,
//             showConfirmButton: true,
//             confirmButtonText: 'تایید قرارداد',
//             cancelButtonText: 'رد قرارداد',
//             cancelButtonColor: "#ff0b0b",
//             confirmButtonColor: "#20a200",
//             preConfirm: res => {
//                 $.ajax({
//                     url: "controllers/Persons/Providers/Providers",
//                     type: "POST",
//                     data: {
//                         controller_type: 'providerStatus',
//                         status: 1,
//                         id: id,
//                     },
//                     success: res => {
//                         $('.supervisorConfirm').removeClass("btn-warning");
//                         $('.supervisorConfirm').removeClass("btn-danger");
//                         $('.supervisorConfirm').addClass("btn-success");
//                         $('.supervisorConfirm p').html("قرارداد تایید شده");
//
//                         console.log(res);
//                         Swal.fire({
//                             icon: 'success',
//                             title: 'تایید قرارداد با موفقیت انجام شد!',
//                             showConfirmButton: false,
//                         })
//                     }
//                 });
//             },
//         }).then((result) => {
//             if (
//                 result.dismiss === Swal.DismissReason.cancel
//             ) {
//                 if ($('.swal2-textarea').val() !== '') {
//
//                     $.ajax({
//                         url: "controllers/Persons/Providers/Providers",
//                         type: "POST",
//                         data: {
//                             controller_type: 'providerStatus',
//                             status: -1,
//                             id: id,
//                             desc: 'رد قرارداد توسط سرپرست به دلیل : ' + $('.swal2-textarea').val(),
//                         },
//                         success: res => {
//
//                             $('.supervisorConfirm').removeClass("btn-warning");
//                             $('.supervisorConfirm').removeClass("btn-success");
//                             $('.supervisorConfirm').addClass("btn-danger");
//                             $('.supervisorConfirm p').html("قرارداد رد شده");
//
//                             console.log(res);
//                             Swal.fire({
//                                 icon: 'success',
//                                 title: 'رد قرارداد با موفقیت انجام شد!',
//                                 showConfirmButton: false,
//                             })
//                         }
//                     });
//                 } else {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'عملیات انجام نشد!',
//                         text: "ذکر علت جهت رد قرارداد الزامی میباشد",
//                         showConfirmButton: false,
//                     })
//
//                 }
//
//             }
//         })
//     }else if (role === 'AdminRole') {
//         const swalWithBootstrapButtons = Swal.mixin({
//             customClass: {
//                 confirmButton: 'btn btn-success',
//                 cancelButton: 'btn btn-danger'
//             },
//             buttonsStyling: false
//         })
//         swalWithBootstrapButtons.fire({
//             title: 'تعیین وضعیت قرارداد',
//             text: "علت رد قرارداد",
//             input: 'textarea',
//             showCancelButton: true,
//             showConfirmButton: true,
//             confirmButtonText: 'تایید قرارداد',
//             cancelButtonText: 'رد قرارداد',
//             cancelButtonColor: "#ff0b0b",
//             confirmButtonColor: "#20a200",
//             preConfirm: res => {
//                 $.ajax({
//                     url: "controllers/Persons/Providers/Providers",
//                     type: "POST",
//                     data: {
//                         controller_type: 'providerStatus',
//                         status: 3,
//                         id: id,
//                     },
//                     success: res => {
//                         $('.supervisorConfirm').removeClass("btn-warning");
//                         $('.supervisorConfirm').removeClass("btn-danger");
//                         $('.supervisorConfirm').addClass("btn-success");
//                         $('.supervisorConfirm p').html("قرارداد تایید شده");
//
//                         console.log(res);
//                         Swal.fire({
//                             icon: 'success',
//                             title: 'تایید قرارداد با موفقیت انجام شد!',
//                             showConfirmButton: false,
//                         })
//                     }
//                 });
//             },
//         }).then((result) => {
//             if (
//                 result.dismiss === Swal.DismissReason.cancel
//             ) {
//                 if ($('.swal2-textarea').val() !== '') {
//
//                     $.ajax({
//                         url: "controllers/Persons/Providers/Providers",
//                         type: "POST",
//                         data: {
//                             controller_type: 'providerStatus',
//                             status: 2,
//                             id: id,
//                             desc:'رد قرارداد توسط مدیریت به دلیل : ' + $('.swal2-textarea').val(),
//                         },
//                         success: res => {
//
//                             $('.supervisorConfirm').removeClass("btn-warning");
//                             $('.supervisorConfirm').removeClass("btn-success");
//                             $('.supervisorConfirm').addClass("btn-danger");
//                             $('.supervisorConfirm p').html("قرارداد رد شده");
//
//                             console.log(res);
//                             Swal.fire({
//                                 icon: 'success',
//                                 title: 'رد قرارداد با موفقیت انجام شد!',
//                                 showConfirmButton: false,
//                             })
//                         }
//                     });
//                 } else {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'عملیات انجام نشد!',
//                         text: "ذکر علت جهت رد قرارداد الزامی میباشد",
//                         showConfirmButton: false,
//                     })
//
//                 }
//
//             }
//         })
//     }
//
// });


})