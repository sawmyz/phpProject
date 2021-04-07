<?
session_start();

?>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <meta name="description" content=""/>
    <meta name="keywords" content="web design, inspiration, search, ui, effect, javascript, animation"/>
    <meta name="author" content=""/>

    <link href="https://fonts.googleapis.com/css?family=Inconsolata:400,700|VT323" rel="stylesheet">

    <!--[if IE]>
    <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script>document.documentElement.className = 'js';</script>
</head>
<style>
    *,
    *::after,
    *::before {
        box-sizing: border-box;
    }

    .terminal {
        overflow-y: scroll;
        margin-top: 0;
        margin-bottom: 3em;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    body {
        font-family: 'Inconsolata', 'Monaco', monospace;
        overflow: hidden;
        margin: 0;
        font-size: 1.2em;
        color: #a0a2ae;
        background: #000;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .main-wrap {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        height: 100vh;
        background-color: #000;

        background-repeat: no-repeat;
        background-position: 50% 10em;
        background-size: 75% auto;
    }


    /* Buttons */

    .btn {
        margin: 0;
        padding: 0;
        cursor: pointer;
        border: none;
        background: none;
    }

    .btn:focus {
        outline: none;
    }

    .btn--search {
        font-size: 1.5em;
    }

    .btn--hidden {
        pointer-events: none;
        opacity: 0;
    }

    .span___test {
        display: inline-block;
        position: relative;
    }

    /* Reset Search Input */

    .search__input {
        width: 90%;
        border: 0;
        background: transparent;
        border-radius: 0;
        -webkit-appearance: none;
    }

    .search__input:focus {
        outline: none;
    }


    /* Links */

    a,
    .btn {
        text-decoration: none;
        color: #d17c78;
        outline: none;
    }

    .hidden {
        position: absolute;
        overflow: hidden;
        width: 0;
        height: 0;
        pointer-events: none;
    }


    /* Icons */

    .icon {
        display: block;
        width: 1.5em;
        height: 1.5em;
        margin: 0 auto;
        fill: currentColor;
    }


    /* Deco lines */

    .decolines {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        pointer-events: none;
    }

    .decoline {
        position: absolute;
        width: 1px;
        height: 100%;
        background: #ddd;
    }

    .decoline:first-child {
        right: 88em;
    }

    .decoline:nth-child(2) {
        right: 68em;
    }

    .decoline:nth-child(3) {
        right: 48em;
    }

    .decoline:nth-child(4) {
        right: 28em;
    }

    .decoline:nth-child(5) {
        right: 8em;
    }

    .demo-11 {
        color: #fff;
        background-color: #000;
    }

    .demo-11 main {
        background-color: transparent;
    }

    .demo-11 a, .demo-11 .btn {
        color: #34fc47;
    }


    /* Layout for search container */
    .search {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 3em;
    }

    span.green {
        color: #34fc47;
    }

    .js .search {
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
    }

    .btn--search-close {
        font-size: 2em;
        position: absolute;
        top: 1.25em;
        right: 1.25em;
        display: none;
    }

    .js .btn--search-close {
        display: block;
    }

    .terminal__line {
        line-height: 1.25;
        width: 100%;
        margin: 0;
        margin-top: 2em;
    }

    .search__form::before {
        content: '>';
    }

    .search__input {
        font-family: inherit;
        line-height: 1;
        display: inline-block;
        box-sizing: border-box;
        padding: 0.05em 0;
        color: #fff;
    }

    .search__form::before,
    .terminal__line,
    .search__input {
        font-family: 'VT323', monospace;
        font-size: 1.25em;
    }

    .search__input::-webkit-input-placeholder {
        /* WebKit, Blink, Edge */
        color: #4a319e;
    }

    .search__input::-moz-placeholder {
        opacity: 1;
        /* Mozilla Firefox 19+ */
        color: #4a319e;
    }

    .search__input:-ms-input-placeholder {
        /* Internet Explorer 10-11 */
        color: #4a319e;
    }

    .search__input::-webkit-search-cancel-button,
    .search__input::-webkit-search-decoration {
        -webkit-appearance: none;
    }

    .search__input::-ms-clear {
        display: none;
    }

    /************************/
    /* Transitions 			*/
    /************************/

    .js .main-wrap {
        transition: opacity 0.3s;
    }

    .js .main-wrap--hide {
        pointer-events: none;
        opacity: 0;
    }

    .js .main-wrap--move .btn--search {
        pointer-events: none;
        opacity: 0;
    }

    .js .search {
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .js .search--open {
        pointer-events: auto;
        opacity: 1;
    }

    /*    .js .search--open .terminal.binding .terminal__line {*/
    /*width: 200ch;*/
    /*    }*/

    /*    .js .search--open .terminal__line:first-child {*/
    /*width: 200ch;*/
    /*    }*/

    /*    .js .search--open .terminal__line:nth-chil$d(2),*/
    /*    .js .search--open .terminal__line:nth-child(3) {*/
    /*        width: 27ch;*/
    /*    }*/

    /*    .js .search--open .terminal__line:nth-child(4) {*/
    /*        width: 28ch;*/
    /*    }*/

    /*    .js .search--open .terminal__line:nth-child(5) {*/
    /*        width: 7ch;*/
    /*    }*/

    /*    .js .search--open .terminal__line:nth-child(6) {*/
    /*        width: 16ch;*/
    /*    }*/

    /*    .js .search--open .terminal__line:nth-child(7) {*/
    /*        width: 14ch;*/
    /*    }*/

    /*    .js .search--open .terminal__line:nth-child(8) {*/
    /*        width: 19ch;*/
    /*    }*/

    /*    .js .search--open .terminal__line:nth-child(9) {*/
    /*        width: 10ch;*/
    /*    }*/

    /*    .js .search--open .terminal__line:nth-child(10) {*/
    /*        width: 13ch;*/
    /*    }*/

    /*    .js .search--open .terminal__line:nth-child(11) {*/
    /*        width: 12ch;*/
    /*    }*/

    /*    .js .search--open .terminal__line:nth-child(12) {*/
    /*        width: 45ch;*/
    /*    }*/

    /*    .js .search--open .terminal__line:nth-child(13) {*/
    /*        width: 145ch;*/
    /*    }*/


    /*.js .search--open .terminal__line {*/
    /*    animation: typing 1s steps(30, end), scaleUp 0.1s forwards;*/
    /*}*/

    /*.js .search--open .terminal__line:first-child {*/
    /*    animation-timing-function: steps(20, end), ease;*/
    /*}*/

    /*.js .search--open .terminal__line:nth-child(2) {*/
    /*    animation-delay: 0.01s;*/
    /*}*/

    /*.js .search--open .terminal__line:nth-child(3) {*/
    /*    animation-delay: 0.02s;*/
    /*}*/

    /*.js .search--open .terminal__line:nth-child(2),*/
    /*.js .search--open .terminal__line:nth-child(3) {*/
    /*    animation-duration: 1.35s, 0.1s;*/
    /*    animation-timing-function: steps(27, end), ease;*/
    /*}*/

    /*.js .search--open .terminal__line:nth-child(4) {*/
    /*    animation-duration: 1.4s, 0.1s;*/
    /*    animation-timing-function: steps(28, end), ease;*/
    /*    animation-delay: 0.03s;*/
    /*}*/

    /*.js .search--open .terminal__line:nth-child(5) {*/
    /*    animation-duration: 0.35s, 0.1s;*/
    /*    animation-timing-function: steps(7, end), ease;*/
    /*    animation-delay: 0.9s;*/
    /*}*/

    /*.js .search--open .terminal__line:nth-child(6) {*/
    /*    animation-duration: 0.8s, 0.1s;*/
    /*    animation-timing-function: steps(16, end), ease;*/
    /*    animation-delay: 1s;*/
    /*}*/

    /*.js .search--open .terminal__line:nth-child(7) {*/
    /*    animation-duration: 0.7s, 0.1s;*/
    /*    animation-timing-function: steps(14, end), ease;*/
    /*    animation-delay: 1s;*/
    /*}*/

    /*.js .search--open .terminal__line:nth-child(8) {*/
    /*    animation-duration: 0.95s, 0.1s;*/
    /*    animation-timing-function: steps(19, end), ease;*/
    /*    animation-delay: 1s;*/
    /*}*/

    /*.js .search--open .terminal__line:nth-child(9) {*/
    /*    animation-duration: 0.5s, 0.1s;*/
    /*    animation-timing-function: steps(10, end), ease;*/
    /*    animation-delay: 1s;*/
    /*}*/

    /*.js .search--open .terminal__line:nth-child(10) {*/
    /*    animation-duration: 0.65s, 0.1s;*/
    /*    animation-timing-function: steps(13, end), ease;*/
    /*    animation-delay: 1s;*/
    /*}*/

    /*.js .search--open .terminal__line:nth-child(11) {*/
    /*    animation-duration: 0.6s, 0.1s;*/
    /*    animation-timing-function: steps(12, end), ease;*/
    /*    animation-delay: 1s;*/
    /*}*/

    /*.js .search--open .terminal__line:nth-child(12) {*/
    /*    animation-duration: 0.6s, 0.1s;*/
    /*    animation-timing-function: steps(12, end), ease;*/
    /*    animation-delay: 0s;*/
    /*}*/

    /*.js .search--open .terminal__line:nth-child(13) {*/
    /*    animation-duration: 3s, 0.1s;*/
    /*    animation-timing-function: steps(190, end), ease;*/
    /*    animation-delay: 0s;*/
    /*}*/

    .connecting-dots {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        background-size: cover;
        background-position: center center;
        position: relative;
        margin: 0 auto;
    }

    canvas {
        position: absolute;
        z-index: 1
    }

    .home {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #000;
        z-index: 9999;
        -webkit-animation: move 1s; /* Safari 4+ */
        -moz-animation: move 1s; /* Fx 5+ */
        -o-animation: move 1s; /* Opera 12+ */
        animation: move 1s; /* IE 10+, Fx 29+ */
    }

    .home_container {
        animation-delay: 0s;
        -webkit-animation: show 1s; /* Safari 4+ */
        -moz-animation: show 1s; /* Fx 5+ */
        -o-animation: show 1s; /* Opera 12+ */
        animation: show 1s; /* IE 10+, Fx 29+ */
    }

    .close_home {
        padding: 1px 10px 6px 10px;
        position: absolute;
        top: 70px;
        right: 80px;
        font-size: 30px;
        border: 1px solid;
        cursor: pointer;
    }

    .home_container h2 {
        position: absolute;
        top: 35%;
        left: 0;
        right: 0;
        text-align: center;
        font-size: 3em;
    }

    .home_container p {
        position: absolute;
        top: 45%;
        left: 0;
        right: 0;
        text-align: center;
        font-size: 2em;
    }

    @keyframes move {
        0% {
            right: 5000px;
        }
        30% {
            right: 2000px;
        }
        100% {
            right: 0;
        }
    }

    @keyframes move {
        0% {
            opacity: 0;
        }
        30% {
            opacity: 0.5;
        }
        100% {
            opacity: 1;
        }
    }


    /* Type animation by Lea Verou http://lea.verou.me/2012/02/simpler-css-typing-animation-with-the-ch-unit/ */
    @keyframes typing {
        from {
            width: 0;
        }
    }

    @keyframes scaleUp {
        from {
            height: 0;
        }
        to {
            height: 1.5em;
        }
    }

    /* Close button */
    .btn--search-close {
        opacity: 0;
        transition: opacity 0.5s;
    }

    .search--open .btn--search-close {
        opacity: 1;
    }

    /* Search form with input and description */

    .js .search__form {
        opacity: 0;
    }

    .js .search--open .search__form {
        opacity: 1;
        transition: opacity 0.3s 3.35s;
    }

    @media screen and (max-width: 40em) {
        .btn--search-close {
            font-size: 1.25em;
        }

        .search {
            padding: 0.5em;
        }
    }

    @media screen and (max-width: 40em) {
        .search-wrap {
            font-size: 0.85em;
            position: absolute;
            top: 2.15em;
            right: 2em;
        }

        .bottom-nav {
            padding: 0.5em;
        }

        .codrops-demos {
            text-align: center;
        }

        .codrops-demos a {
            margin-bottom: 1em;
        }

        .codrops-demos span {
            display: block;
            margin: 0 auto 1em;
            text-align: center;
        }
    }

</style>
<body class="demo-11">

<div id="connecting-dots" class="connecting-dots">
    <canvas id="canvas"></canvas>
</div>

<div class="search search--open">

    <div class="terminal">
        <p class="terminal__line">Panel interface completed.</p>
        <p class="terminal__line">Navigation portals fetched:</p>
    </div>
    <form class="search__form" action="">
        <input class="search__input" id="search__input" name="search" placeholder="Command Line" autocomplete="off"
               autocorrect="off" autocapitalize="off" spellcheck="false"></input>
    </form>
</div><!-- /search -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/easing/EasePack.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenLite.min.js"></script>
<script>
    let width, height, container, canvas, ctx, points, target, animateHeader = true;
    let terminal_div = document.getElementsByClassName('terminal');
    terminal_div = terminal_div[0];
    terminal_div.scrollTop = terminal_div.scrollHeight;

    function init() {
        initHeader();
        initAnimation();
        addListeners();
    }

    function initHeader() {
        width = window.innerWidth;
        height = window.innerHeight;
        target = {
            x: width / 2,
            y: height / 2
        };

        container = document.getElementById('connecting-dots');
        container.style.height = height + 'px';

        canvas = document.getElementById('canvas');
        canvas.width = width;
        canvas.height = height;
        ctx = canvas.getContext('2d');

        // create points
        points = [];
        for (let x = 0; x < width; x = x + width / 20) {
            for (let y = 0; y < height; y = y + height / 20) {
                let px = x + Math.random() * width / 100;
                let py = y + Math.random() * height / 100;
                let p = {
                    x: px,
                    originX: px,
                    y: py,
                    originY: py
                };
                points.push(p);
            }
        }

        // for each point find the 5 closest points
        for (let i = 0; i < points.length; i++) {
            let closest = [];
            let p1 = points[i];
            for (let j = 0; j < points.length; j++) {
                let p2 = points[j];
                if (!(p1 == p2)) {
                    let placed = false;
                    for (let k = 0; k < 5; k++) {
                        if (!placed) {
                            if (closest[k] == undefined) {
                                closest[k] = p2;
                                placed = true;
                            }
                        }
                    }

                    for (let k = 0; k < 5; k++) {
                        if (!placed) {
                            if (getDistance(p1, p2) < getDistance(p1, closest[k])) {
                                closest[k] = p2;
                                placed = true;
                            }
                        }
                    }
                }
            }
            p1.closest = closest;
        }

        // assign a circle to each point
        for (let i in points) {
            let c = new Circle(points[i], 2 + Math.random() * 2, 'rgba(255,255,255,0.9)');
            points[i].circle = c;
        }
    }

    // Event handling
    function addListeners() {
        if (!('ontouchstart' in window)) {
            //  window.addEventListener("mousemove", mouseMove);
        }
        window.addEventListener("resize", resize, true);
        window.addEventListener("scroll", scrollCheck);
    }

    function mouseMove(e) {
        let posx = posy = 0;
        if (e.pageX || e.pageY) {
            posx = e.pageX;
            posy = e.pageY;
        } else if (e.clientX || e.clientY) {
            posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
            posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
        }
        target.x = posx;
        target.y = posy;
    }

    function scrollCheck() {
        if (document.body.scrollTop > height) animateHeader = false;
        else animateHeader = true;
    }

    function resize() {
        width = window.innerWidth;
        height = window.innerHeight;
        container.style.height = height + 'px';
        ctx.canvas.width = width;
        ctx.canvas.height = height;
    }

    // animation
    function initAnimation() {
        animate();
        for (let i in points) {
            shiftPoint(points[i]);
        }
    }

    function animate() {
        if (animateHeader) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (let i in points) {
                // detect points in range
                if (Math.abs(getDistance(target, points[i])) < 4000) {
                    points[i].active = 0.3;
                    points[i].circle.active = 0.6;
                } else if (Math.abs(getDistance(target, points[i])) < 20000) {
                    points[i].active = 0.1;
                    points[i].circle.active = 0.3;
                } else if (Math.abs(getDistance(target, points[i])) < 40000) {
                    points[i].active = 0.02;
                    points[i].circle.active = 0.1;
                } else {
                    points[i].active = 0;
                    points[i].circle.active = 0;
                }

                drawLines(points[i]);
                points[i].circle.draw();
            }
        }
        requestAnimationFrame(animate);
    }

    function shiftPoint(p) {
        TweenLite.to(p, 1 + 1 * Math.random(), {
            x: p.originX - 50 + Math.random() * 100,
            y: p.originY - 50 + Math.random() * 100,
            ease: Circ.easeInOut,
            onComplete: function () {
                shiftPoint(p);
            }
        });
    }

    // Canvas manipulation
    function drawLines(p) {
        if (!p.active) return;
        for (let i in p.closest) {
            ctx.beginPath();
            ctx.moveTo(p.x, p.y);
            ctx.lineTo(p.closest[i].x, p.closest[i].y);
            ctx.strokeStyle = 'rgba(255,255,255,' + p.active + ')';
            ctx.stroke();
        }
    }

    function Circle(pos, rad, color) {
        let _this = this;

        // constructor
        (function () {
            _this.pos = pos || null;
            _this.radius = rad || null;
            _this.color = color || null;
        })();

        this.draw = function () {
            if (!_this.active) return;
            ctx.beginPath();
            ctx.arc(_this.pos.x, _this.pos.y, _this.radius, 0, 2 * Math.PI, false);
            ctx.fillStyle = 'rgba(255,255,255,' + _this.active + ')';
            ctx.fill();
        };
    }

    // Util
    function getDistance(p1, p2) {
        return Math.pow(p1.x - p2.x, 2) + Math.pow(p1.y - p2.y, 2);
    }

    init();

    $.ajaxSetup({'cache': false});
    ;(function (window) {

        'use strict';

        let search_form = document.getElementsByClassName('search__form');
        console.log(search_form);


        $(search_form).submit(function (event) {
            event.preventDefault();
            let binder = $('input').val();
            if (binder === '')
                return;
            switch (binder) {
                case 'clear':
                    $(".terminal").html('');
                    $("input").val('');
                    break;
                default:
                    $('.terminal').addClass("binding");
                    $('.search__form input').attr('disabled', true);
                    $.ajax({
                        url: 'processor.php',
                        cache: !1, async: !0,
                        data: {
                            sessionId: '<?=session_id()?>',
                            command: binder
                        },
                        type: "POST",
                        success: res => {

                            $('.search__form input').attr('disabled', false).focus();
                            try {

                                if (res === '') return;
                                let data = JSON.parse(res);
                                binder = data.data;
                                let commands = document.createElement('div');
                                commands.innerHTML = ("user$/terminal " + data.dir + ": " +
                                    binder);
                                commands.setAttribute('class', 'terminal__line');
                                let terminal_div = document.getElementsByClassName('terminal');
                                terminal_div = terminal_div[0];
                                $(commands).appendTo(terminal_div);
                                terminal_div.scrollTop = terminal_div.scrollHeight;
                                $("input").val('');
                            } catch (e) {
                                let commands = document.createElement('div');
                                commands.innerHTML = ("user$/terminal ~: " +
                                    '<span style=\'color: red\'>error</span>');
                                commands.setAttribute('class', 'terminal__line');
                                let terminal_div = document.getElementsByClassName('terminal');
                                terminal_div = terminal_div[0];
                                $(commands).appendTo(terminal_div);
                                terminal_div.scrollTop = terminal_div.scrollHeight;
                                $("input").val('');
                                $('.search__form input').attr('disabled', false).focus();
                            }
                        },
                        error: res => {
                            let commands = document.createElement('div');
                            commands.innerHTML = ("user$/terminal ~: " +
                                '<span style=\'color: red\'>error</span>');
                            commands.setAttribute('class', 'terminal__line');
                            let terminal_div = document.getElementsByClassName('terminal');
                            terminal_div = terminal_div[0];
                            $(commands).appendTo(terminal_div);
                            terminal_div.scrollTop = terminal_div.scrollHeight;
                            $("input").val('');
                            $('.search__form input').attr('disabled', false).focus();
                        }
                    });
            }


        });


    })(window);
    $(function () {
        let i = 0;
        $(window).on('keyup', event => {
            if (event.key == "ArrowUp") {
                i++;
                let list = document.getElementsByClassName('terminal__line');
                let array = [];
                for (let item of list) {
                    if (item.tagName == 'DIV')
                        array.push(item)
                }
                if (array.length >= i) {
                    let lastItem = array[array.length - i];
                    if (lastItem && lastItem.tagName == 'DIV') {
                        let text = $(lastItem).find('.last_command').html();
                        $('input').val(text)
                    }
                } else {
                    i--;
                }
            } else if (event.key == 'ArrowDown' && i > 0) {
                i--;
                let array = document.getElementsByClassName('terminal__line');
                let lastItem = (array[array.length - i]);
                if (lastItem && lastItem.tagName == 'DIV') {
                    let text = $(lastItem).find('.last_command').html();
                    $('input').val(text)
                } else {
                    $("input").val('');
                }
            }
        })
    })
</script>

</body>
</html>
