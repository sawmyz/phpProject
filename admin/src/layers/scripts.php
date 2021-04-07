<script src="https://negarine.com/cdn/jQuery/jquery.min.js"></script>
<script src="https://negarine.com/cdn/ui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://negarine.com/cdn/bala.IconPicker/css/bala.IconPicker.jquery.css">
<script type="text/javascript" src="https://negarine.com/cdn/bala.IconPicker/js/bala.IconPicker.jquery.js"></script>
<!-- Bootstrap -->
<script src="https://negarine.com/cdn/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="src/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="src/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>-->
<!-- SparkLine -->
<script src="https://negarine.com/cdn/sparkline/jquery.sparkline.min.js"></script>
<!-- jVectorMap -->
<script src="https://negarine.com/cdn/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="https://negarine.com/cdn/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="https://negarine.com/cdn/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.2 -->
<script src="https://negarine.com/cdn/chartjs-old/Chart.min.js"></script>
<script src="https://negarine.com/cdn/datepicker/bootstrap-datepicker.js"></script>

<!-- PAGE SCRIPTS -->
<script src="src/dist/js/pages/dashboard2.js"></script>
<script src="https://negarine.com/cdn/leaflet/leaflet.js"></script>
<script src="https://negarine.com/cdn/leaflet/Leaflet.draw.js"></script>
<script src="https://negarine.com/cdn/leaflet/Control.Draw.js"></script>
<!-- Bootstrap 4 -->
<script src="https://negarine.com/cdn/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<!--DataTAbled-->
<!-- DataTables -->
<script src="https://negarine.com/cdn/datatables/jquery.dataTables.js"></script>
<script src="https://negarine.com/cdn/datatables/dataTables.bootstrap4.js"></script>

<script src="https://negarine.com/cdn/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="https://negarine.com/cdn/input-mask/jquery.inputmask.js"></script>
<script src="https://negarine.com/cdn/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="https://negarine.com/cdn/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="src/dist/js/moment/moment.min.js"></script>
<script src="https://negarine.com/cdn/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="https://negarine.com/cdn/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="https://negarine.com/cdn/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="https://negarine.com/cdn/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="https://negarine.com/cdn/fastclick/fastclick.js"></script>
<script src="https://negarine.com/cdn/pace/pace.min.js"></script>
<!-- Persian Data Picker -->
<script src="src/dist/js/persian-date.min.js"></script>
<script src="src/dist/js/tables.js"></script>
<script src="src/dist/js/submit.js"></script>
<script src="https://negarine.com/cdn/Trumbowyg/trumbowyg.min.js"></script>
<script src="https://negarine.com/cdn/timedropper/timedropper.min.js"></script>
<script src="https://negarine.com/cdn/jquery-mask/jquery.mask.js"></script>
<script type="text/javascript" src="https://negarine.com/cdn/Trumbowyg/langs/fa.min.js"></script>
<script type="text/javascript" src="https://negarine.com/cdn/bootstrap-toggle/bs-toggle.js"></script>
<script src="src/dist/js/autocomplete.js"></script>
<script src="src/dist/js/fw_tags/src/funcs.js"></script>
<script src="src/dist/js/fw_tags/fw_tags.js"></script>
<script src="src/dist/js/fw_js.js"></script>
<?require_once __SOURCE__.'dist/js/ajax1.php';?>
<?//require_once __SOURCE__.'dist/js/ajax.php';?>
<script src="src/dist/js/check.js"></script>
<script src="src/dist/js/persian-date.min.js"></script>
<script src="src/dist/js/persian-datepicker.min.js"></script>
<script src="src/dist/js/Shortcuts/Shortcuts.js"></script>
<script>


    if ($("#cleanSideBar").length > 0) {
        cleanSideBar();
    }
    $('[data-toggle="tooltip"]').tooltip();
    $.ajaxSetup({'cache': false});
    $('textarea').trumbowyg();
    $(".dataTable").DataTable({
        "ordering": true,
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }],
        "language": {
            "zeroRecords": "هیچ موردی یافت نشد",
            "lengthMenu": "نمایش _MENU_ داده",
            "loadingRecords": "درحال بارگزاری...",
            "processing": "در حال پردازش...",
            "search": "جستجو:",
            "info": "در حال نمایش _PAGE_ صفحه از _PAGES_ صفحه",
            "infoEmpty": "هیچ موردی وجود ندارد!",
            "infoFiltered": "(از _MAX_ داده فیلتر شده)",
            "paginate": {
                "next": "بعدی",
                "previous": "قبلی",
            },
        },
    });
    // let ShortCut = new Shortcuts();
    // ShortCut.add('test',() => {
    //     console.log('here')
    // })
</script>
