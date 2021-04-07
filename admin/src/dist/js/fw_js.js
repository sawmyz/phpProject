$.loader = function () {
    $("#fw-preloader").toggleClass('loaded');
};
String.prototype.toFa = function () {
    return this.replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹'[d])
};
$.fn.getOptions = function (options = {}) {
    let url = options.url, target = options.target, controller_type = options.controller_type || 'ajax',
        id = options.this || $(this).attr('id') || $(this).attr('name') || 'value',
        rest = options.rest || {};
    if (options.onInit !== false) {
        let targetElem = $('#' + target);
        let value = $(targetElem).find('option:selected').val();
        $(targetElem).attr("disabled", true);
        if (value && value.toString() !== '') {
            const object3 = {
                ...{
                    controller_type: controller_type,
                    [id]: $(this).val()
                }, ...rest
            };
            $.ajax({
                url: url,
                data: object3,
                type: "post",
                success: res => {
                    $(targetElem).html(res);
                    $(targetElem).attr("disabled", false);
                    $(targetElem).find('option').each(function () {
                        if ($(this).val() == value) {
                            $(this).prop('selected', true).attr('selected', true);
                        }
                    });
                }
            });
        }
    }
    setTimeout(() => {
        if ($(this).find('option').length === 1) {
            $(this).trigger('change');
        }
    }, 1)
    $(this).on('change', () => {
        const object3 = {
            ...{
                controller_type: controller_type,
                [id]: $(this).val()
            }, ...rest
        };
        $.ajax({
            url: url,
            data: object3,
            type: "post",
            success: res => {
                $('#' + target).html(res);
                $('#' + target).attr("disabled", false);
                $('#' + target).trigger("change");
            }
        })
    });
};
$.fw_ajax = function (options = {}) {
    let myData = {
        controller_type: options.controller_type
    };
    const object3 = {...myData, ...options.data};
    $.ajax({
        url: options.path ? options.path : '',
        data: object3,
        async: false,
        cache: false,
        success: options.onSuccess,
        error: options.onError
    });
};

function cleanSideBar() {
    $('.nav.nav-pills.nav-sidebar.flex-column').children('li').each(function () {
        rec($(this), 0);
        remove($(this), 0)
    });

    function rec($this, level) {
        if ($($this).hasClass('has-treeview') || $($this).hasClass('nav-treeview')) {
            $($this).children().each(function () {
                if ($(this).hasClass('nav-item')) {
                    if (!$(this).hasClass('has-treeview')) {
                        $(this).addClass('pr-' + (level - 1));
                    } else {
                        $(this).removeClass('pr-0');
                        $(this).addClass('pr-' + level);
                    }
                }
                rec($(this), level + 1);
            })
        }
    }

    function remove($this, level) {
        if ($($this).hasClass('has-treeview')) {
            if ($($this).find('ul.nav-treeview')) {

                let uls = $($this).find('ul.nav-treeview');
                $(uls).each(function () {
                    if ($(this).html() == '') {
                        $($this).remove();
                    } else {
                        remove($(this), level++);
                    }
                });
            } else if ($(this).text() == '') {
                $(this).remove();
            }
        }
    }
}

String.prototype.toFa = function () {
    return this.replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹'[d])
};
$.initMap = function (object = {}) {
    let view = (!object.view ? [36.565877, 53.058600] : object.view);
    let polygon = (!object.polygon ? null : object.polygon);
    let listen = (!object.listen ? null : object.listen);
    let disable = object.disable;
    let map = L.map('map').setView(view, 6);
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYW1pcjc1OTYiLCJhIjoiY2pqcXFyZTU4MTR1YjN3bW02aXN3b3o2dSJ9.t13qJLhSWuq0bSOje1BBCA', {
        maxZoom: 18,
    }).addTo(map);
    if (polygon) {
        L.polygon(polygon).addTo(map)
    }
    let editableLayers = new L.FeatureGroup();
    map.addLayer(editableLayers);

    let drawPluginOptions = {
        position: 'topright',
        draw: {
            polygon: {
                allowIntersection: true, // Restricts shapes to simple polygons
                drawError: {
                    color: '#e1e100', // Color the shape will turn when intersects
                    message: 'این شکل قابل رسم نیست!!' // Message that will show when intersect
                },
                shapeOptions: {
                    color: '#97009c'
                }
            },
            // disable toolbar item by setting it to false
            polyline: false,
            circle: false, // Turns off this drawing tool
            rectangle: false,
            marker: false,
        },
        edit: {
            featureGroup: editableLayers, //REQUIRED!!
            remove: false
        }
    };

    if (!disable) {
        // Initialise the draw control and pass it the FeatureGroup of editable layers
        let drawControl = new L.Control.Draw(drawPluginOptions);
        map.addControl(drawControl);

        map.on('draw:created', function (e) {
            let type = e.layerType,
                layer = e.layer;
            let points = e.layer._latlngs;
            let len = points[0].length;
            let lats = "";
            for (let i = 0; i < len; i++) {
                lats += "(" + points[0][i].lat + "," + points[0][i].lng + ")";
            }
            $("#map-coords").val(lats);
            editableLayers.addLayer(layer);
        });
    }
    if (listen) {
        $("#" + listen).on('change', function () {
            let latitude = $(this).find('option:selected').attr('lat');
            let longitude = $(this).find('option:selected').attr('long');
            map.setView([latitude, longitude], 13);
        });
    }
};

function arrayCompare(a1, a2) {
    if (a1.length !== a2.length) return false;
    let length = a2.length;
    for (let i = 0; i < length; i++) {
        if (a1[i] !== a2[i]) return false;
    }
    return true;
}

function inArray(needle, haystack) {
    let length = haystack.length;
    for (let i = 0; i < length; i++) {
        if (typeof haystack[i] == 'object') {
            if (arrayCompare(haystack[i], needle)) return true;
        } else {
            if (haystack[i] == needle) return true;
        }
    }
    return false;
}


function setCookie(name, value, days) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function eraseCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

const CurrentPathForController = '';
function togglePage(i) {
    alert(i)
}
