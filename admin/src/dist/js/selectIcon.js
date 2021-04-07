if ($("select#icon_id").length != 0) {
    if ($("#icon_id").data("select2")) {
        $("#icon_id").select2("destroy")
    }

    $("#icon_id").select2({
        templateResult: addUserPic,
    });
    $("#icon_id").on('select2:open', function () {
        setTimeout(() => {
            $("li.select2-results__option").each(function () {
                let $img = $(this).find('img');
                $($img).after('<span>' + $($img).data("title") + '</span>');
            })
        }, 1)

    });

    function addUserPic(opt) {

        let optimage = $(opt.element).data('image');
        if (!optimage) {
            return opt.text;
        } else {
            return $(
                '<span><img class="ml-2" data-title="' + opt.text.toString() + '" style="width: 10%" src="' + optimage + '" /> ' + $(opt).text() + '</span>'
            );
        }
    }
}


