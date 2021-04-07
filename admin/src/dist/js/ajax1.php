<?php
define('__SOURCE__', substr(__DIR__, 0, strpos(__DIR__, 'src') + 3) . DIRECTORY_SEPARATOR);
$allFiles = [];
$views = [];
$controllers = [];
foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'views/')), '/\.php$/') as $phpFile) {
    $fileName = $phpFile->getFileName();
    $views[] = (true ? str_replace('.php', '', str_replace(__SOURCE__, '', $phpFile->getRealPath())) : str_replace(__SOURCE__, '', $phpFile->getRealPath()));
    $allFiles[] = (true ? str_replace('.php', '', $fileName) : $fileName);
}
foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'controllers/')), '/\.php$/') as $phpFile) {
    $controllers[] = (true ? str_replace('.php', '', str_replace(__SOURCE__, '', $phpFile->getRealPath())) : str_replace(__SOURCE__, '', $phpFile->getRealPath()));
}
$host = $_SERVER['HTTP_HOST'];
?>
<script>
    $(window).on('keydown', function (e) {
        if (e.key == 'F5') {
            e.preventDefault();
            $("#fw_refresh_btn").click()
        }
    });
    window.onpopstate = history.onpushstate = function () {
        if (fw_referrer) {
            GoToUrl(fw_referrer, null, <?=json_encode($allFiles)?>, <?=json_encode($views)?>, <?=json_encode($controllers)?>);
            return;
        }
        let allViews = <?=json_encode($controllers)?>;
        let host = '<?=$_SERVER["HTTP_HOST"] . "/"?>';
        let location = window.location.toString();
        location = location.replace('https://', '');
        location = location.replace('http://', '');
        location = location.replace(host, '');
        allViews.forEach(val => {
            let arr = val.split('/');
            let last = (arr.pop());
            if (location.includes('add')) {
                val = val.replace(new RegExp(last + '$'), 'add' + last);
            }
            val = val.replace('controllers/', '');
            if (location.includes(last)) {
                GoToUrl(val, null, <?=json_encode($allFiles)?>, <?=json_encode($views)?>, <?=json_encode($controllers)?>);
                return false;
            }
        });
    };

    function startTime() {
        let today = new Date();
        let h = today.getHours();
        let m = today.getMinutes();
        let s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        let res =
            h + ":" + m + ":" + s;
        document.getElementById('txt').innerHTML = res.toFa();
        let t = setTimeout(startTime, 500);
    }

    startTime();

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }
        // add zero in front of numbers < 10
        return i;
    }

    let fw_referrer = 'undefined';
    $.Ajax = function (json_pages = <?=json_encode($allFiles)?>, allViews = <?=json_encode($views)?>, allControllers = <?=json_encode($controllers)?>) {
        $('.ajax').click(function (e) {
            e.preventDefault();

            if ($(this).attr('rel').includes('.fwTools')) {
                if (Swal.isVisible()) {
                    Swal.close();
                }
                $('.modal').modal("hide");
                $.loader();
                e.preventDefault();
                for (let i = 1; i < 99999; i++) {
                    window.clearInterval(i);
                }
                startTime();
                let myUrl, controller, view;
                myUrl = $(this).attr('rel');
                if (myUrl == 'undefined' || !myUrl) {
                    $.loader();
                    Swal.fire({
                        icon: 'info',
                        title: 'صفحه ی مورد نظر در حال طراحی است!',
                        confirmButtonText: 'تایید'
                    });
                    return false;
                }
                myUrl = myUrl.replace('.php', '');
                let currentFile = $("#fw_lastAjaxCallView").val();
                let isRefresh = currentFile == myUrl;
                let isUndefined = myUrl == 'undefined';
                let isBackBtn = $(this).attr("id") == 'fw_back_btn';
                if (!isBackBtn && !isRefresh && !isUndefined) {
                    fw_referrer = currentFile;
                }
                let date = new Date();
                let array = json_pages;
                let controller_type = '';
                let fileExists = false, isViewValid = false, isControllerValid = true;
                if (!myUrl.includes('.fwTools')) {
                    array = array.filter(file => myUrl.includes(file));
                    array.forEach(function (val, index) {
                        let url_end = myUrl.includes('/') ? (myUrl.split('/')) : myUrl;
                        url_end = myUrl.includes('/') ? url_end[url_end.length - 1] : url_end;
                        url_end = (url_end.includes('?') ? url_end.split('?')[0] : url_end);
                        if (url_end == val) {
                            fileExists = true;
                            if (myUrl.includes('edit')) {
                                controller = "controllers/" + myUrl.replace('edit', '');
                                controller_type = 'get';
                            } else if (myUrl.toLowerCase().includes('view')) {
                                controller = "controllers/" + myUrl.replace('view', '');
                                controller_type = 'get';
                            } else if (myUrl.includes('delete')) {
                                controller = "controllers/" + myUrl.replace('delete', '');
                                controller_type = 'get';
                            } else if (myUrl.includes('add')) {
                                controller = "controllers/" + myUrl.replace('add', '')
                            } else {
                                let newArray = myUrl.split('/');
                                let fileName = newArray[newArray.length - 1].includes('?') ? newArray[newArray.length - 1].split('?')[0] : newArray[newArray.length - 1];
                                controller_type = fileName.replace(val, '');
                                // let things = controller_type[1].split('&');
                                // things.forEach(function (val, index) {
                                //     let array = val.split('=');
                                //     $("form[fw-id=target-form-target-fw]").append('<input type="hidden" value="' + array[1] + '" name="' + array[0] + '">');
                                // });
                                controller = "controllers/" + myUrl.replace(controller_type, '');
                            }
                        }

                    });
                    view = "views/" + myUrl;
                    if (controller) {
                        let tmpController = (controller.includes('?') ? (controller.split('?')[0]) : controller);
                        isControllerValid = (allControllers.includes(tmpController));
                    } else {
                        fileExists = false;
                    }
                    if (view) {
                        let tmpView = (view.includes('?') ? (view.split('?')[0]) : view);
                        isViewValid = (allViews.includes(tmpView));
                    } else {
                        fileExists = false;
                    }
                } else {
                    isControllerValid = true;
                    isViewValid = true;
                    fileExists = true;
                    myUrl = myUrl.replace('.fwTools', '');
                    controller = "controller/" + myUrl;
                    if (myUrl.includes('edit')) {
                        controller = "controller/" + myUrl.replace('edit', '');
                        controller_type = 'get';
                    } else if (myUrl.toLowerCase().includes('view')) {
                        controller = "controller/" + myUrl.replace('view', '');
                        controller_type = 'get';
                    } else if (myUrl.includes('delete')) {
                        controller = "controller/" + myUrl.replace('delete', '');
                        controller_type = 'get';
                    } else if (myUrl.includes('add')) {
                        controller = "controller/" + myUrl.replace('add', '')
                    }
                    controller = 'fwTools/' + controller;
                    view = "fwTools/view/" + myUrl
                }
                let controller_data = controller_type != '' ? {
                    ajax_type: 'internal',
                    controllerPathToInclude: controller,
                    controller_type: controller_type,
                } : {
                    controllerPathToInclude: controller,
                    ajax_type: 'internal'
                };
                $.ajax({
                    data: controller_data,
                    type: "POST",
                    url: false ? 'dist/php/ControllerLoader' : controller, success: rt => {
                        try {
                            let json = JSON.parse(rt);
                            if (json.code == 403) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'دسترسی به این بخش صادر نشد!',
                                    text: 'شما به بخش مورد نظر دسترسی ندارید، درصورت بروز اشتباه با مدیر سیستم تماس بگیرید',
                                    showConfirmButton: false,
                                    showCloseButton: true,
                                    onAfterClose: () => {
                                        location.replace('https://<?=$host?>/');
                                    }
                                });
                                return false;
                            }
                        } catch (e) {
                            let key = rt.split('||||||')[0];
                            $.ajax({
                                url: view,
                                data: {
                                    data: rt.split('||||||')[1],
                                    fw_referrer: fw_referrer,
                                    controller_key: key,
                                    controller: controller,
                                    timeStampForAjaxRequest: date.getTime()
                                },
                                type: "POST",
                                success: page => {
                                    if ($(this).hasClass('nav-link')) {
                                        $('.nav-link').removeClass('active');
                                        $(this).addClass('active');
                                    }
                                    view = view.split('/');
                                    view = view[view.length - 1];
                                    view = (view.includes('?') ? view.split('?')[0] : view);
                                    let location = window.location.toString();
                                    let last = location.split('/').pop();
                                    if (last != view)
                                        window.history.pushState('page2', 'Title', view);
                                    let title = document.title;
                                    title = (title.includes('/') ? title.split('/')[0] : title);
                                    $('#fw-content').empty();
                                    $('#fw-content').html(page);
                                    document.title = ($("#fw_current_page_title").val() ? title + ' / ' + $("#fw_current_page_title").val() : title);
                                    $(".tooltip").hide();
                                    $("#fw-preloader").addClass('loaded');
                                },
                                error: error => {
                                    if (error.status == 403 || error.status == 404) {
                                        $.loader();
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'صفحه ی مورد نظر در حال طراحی است!',
                                            confirmButtonText: 'تایید'
                                        })
                                    } else {
                                        let timerInterval;
                                        $.loader();
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'خطای ناشناخته!',
                                            html: 'شما در <b></b> میلی ثانیه به صفحه ی اصلی منتقل میشوید',
                                            timer: 3000,
                                            timerProgressBar: !0,
                                            onBeforeOpen: () => {
                                                Swal.showLoading();
                                                timerInterval = setInterval(() => {
                                                    Swal.getContent().querySelector('b').textContent = Swal.getTimerLeft()
                                                }, 100)
                                            },
                                            onClose: () => {
                                                clearInterval(timerInterval)
                                            }
                                        }).then((result) => {
                                            if (result.dismiss === Swal.DismissReason.timer)
                                                location.reload()
                                        })
                                    }
                                }
                            })
                        }
                    },
                    cache: !1, async: !0
                });
                return;
            }
            GoToUrl($(this).attr('rel'), $(this), json_pages, allViews, allControllers);
            e.stopImmediatePropagation();
            return !1;
        });
    };
    $.Ajax();

    /**
     * @return {boolean}
     */
    function GoToUrl(u, $this = null, json_pages = <?=json_encode($allFiles)?>, allViews = <?=json_encode($views)?>, allControllers = <?=json_encode($controllers)?>) {
        if (Swal.isVisible()) {
            Swal.close();
        }
        $('.modal').modal("hide");
        $.loader();
        for (let i = 1; i < 99999; i++) {
            window.clearInterval(i);
        }
        startTime();
        let myUrl, controller, view;
        myUrl = u;
        if (myUrl == 'undefined' || !myUrl) {
            $.loader();
            Swal.fire({
                icon: 'info',
                title: 'صفحه ی مورد نظر در حال طراحی است!',
                confirmButtonText: 'تایید'
            });
            return false;
        }
        myUrl = myUrl.replace('.php', '');
        let currentFile = $("#fw_lastAjaxCallView").val();
        let isRefresh = currentFile == myUrl;
        let isUndefined = myUrl == 'undefined';
        let isBackBtn = $($this).attr("id") == 'fw_back_btn';
        if (!isBackBtn && !isRefresh && !isUndefined && (typeof currentFile != 'undefined')) {
            fw_referrer = currentFile;
        }
        let array = allControllers;
        let controller_type = '';
        let fileExists = false, isViewValid = false, isControllerValid = true;
        if (!myUrl.includes('.fwTools')) {
            let url_end = myUrl.split('/').pop();
            array.forEach(file => {
                let last = file.split('/').pop();
                if (url_end.includes(last) && url_end.length >= last.length){
                    controller = file;
                    fileExists = true;
                    controller_type = (url_end.replace(last,'')).split('?')[0];
                    switch (controller_type) {
                        case "edit":
                            controller_type = 'editIndex';
                            break;
                        case "view":
                            controller_type= 'viewIndex';
                            break;
                        case "delete":
                            controller_type= 'deleteIndex';
                            break;
                        case "add":
                            controller_type= 'addIndex';
                            break;

                    }
                    isViewValid = true;
                    view = file.replace('controllers','views');
                    if ((url_end.replace(last,'')).split('?')[1]){
                        let params = (url_end.replace(last,'')).split('?')[1];
                        controller = controller+'?'+params;


                    }
                }
            });
        }
        if (!controller){
            controller = myUrl;
        }
        let controllerPathToInclude = controller.split('?')[0];

        let controller_data = controller_type != '' ? {
            ajax_type: 'internal',
            controllerPathToInclude: controllerPathToInclude,
            view: view,
            fw_referrer: fw_referrer,
            controller_type: controller_type,
        } : {
            view: view,
            fw_referrer: fw_referrer,
            controllerPathToInclude: controllerPathToInclude,
            ajax_type: 'internal'
        };

        $.ajax({
            url: controller,
            data: controller_data,
            type: "POST",
            success: res => {
                let current_page = getCookie('current_page') || 0;
                if ($($this).hasClass('nav-link')) {
                    $('.nav-link').removeClass('active');
                    $($this).addClass('active');
                }
                $('#fw-content').empty();
                $('#fw-content').html(res);
                setTimeout(() => {
                    $("table").each(function (e) {
                        if ($.fn.DataTable.isDataTable($(this))) {
                            let table = $(this).DataTable();
                            table.page(parseInt(current_page)).draw('page')
                        }
                    });
                },1)
                let v = $("#fw_current_page_url_new").val();
                v = (v ? v : '')
                v = v.replace('main','');
                let location = window.location.toString();
                let last = location.split('/').pop();
                if (last != v)
                    window.history.pushState('page2', 'Title', v);
                let title = document.title;
                title = (title.includes('/') ? title.split('/')[0] : title);
                document.title = ($("#fw_current_page_title").val() ? title + ' / ' + $("#fw_current_page_title").val() : title);
                $(".tooltip").hide();
                $("#fw-preloader").addClass('loaded');
            }
        });
    }

    $(window).on('load', () => {
        let allViews = <?=json_encode($controllers)?>;
        let host = '<?=$_SERVER["HTTP_HOST"] . "/"?>';
        let location = window.location.toString();
        location = location.replace('https://', '');
        location = location.replace('http://', '');
        location = location.replace(host, '');
        allViews.forEach(val => {
            let arr = val.split('/');
            let last = (arr.pop());
            if (location.includes('add')) {
                val = val.replace(new RegExp(last + '$'), 'add' + last);
            }
            val = val.replace('controllers/', '');
            if (location.includes(last)) {
                GoToUrl(val, null, <?=json_encode($allFiles)?>, <?=json_encode($views)?>, <?=json_encode($controllers)?>);
                return false;
            }
        });
        $("#fw-preloader").addClass('loaded');
    })
</script>
